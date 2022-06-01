<?php

namespace Training\Bundle\UserNamingBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Oro\Component\MessageQueue\Client\MessageProducerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Training\Bundle\UserNamingBundle\Async\Topic;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;

class UserNamingTypeChangeFormatListener implements ContainerAwareInterface
{
    private ContainerInterface $container;

    /**
     * @param UserNamingType $namingType
     * @param LifecycleEventArgs $event
     */
    public function postPersist(UserNamingType $namingType, LifecycleEventArgs $event)
    {
        $this->sendMessage($namingType);
    }

    /**
     * @param UserNamingType $namingType
     * @param PreUpdateEventArgs $event
     */
    public function preUpdate(UserNamingType $namingType, PreUpdateEventArgs $event)
    {
        if ($event->hasChangedField('format')) {
            $this->sendMessage($namingType);
        }
    }

    public function sendMessage(UserNamingType $entity)
    {
        $log             = $this->container->get('logger');
        $messageProducer = $this->container->get(MessageProducerInterface::class);
        $data            = [
            'id'     => $entity->getId(),
            'format' => $entity->getFormat()
        ];
        $messageProducer->send(
            Topic::USER_NAMING_REGENERATE_EXAMPLE,
            $data
        );
        $log->info('UserNamingTypeFormatChanged', $data);
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
