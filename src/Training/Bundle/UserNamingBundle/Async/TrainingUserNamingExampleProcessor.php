<?php

namespace Training\Bundle\UserNamingBundle\Async;

use Oro\Bundle\EntityBundle\ORM\DoctrineHelper;
use Oro\Component\MessageQueue\Client\TopicSubscriberInterface;
use Oro\Component\MessageQueue\Consumption\MessageProcessorInterface;
use Oro\Component\MessageQueue\Transport\MessageInterface;
use Oro\Component\MessageQueue\Transport\SessionInterface;
use Oro\Component\MessageQueue\Util\JSON;
use Psr\Log\LoggerInterface;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;
use Training\Bundle\UserNamingBundle\Service\TrainingNamingConverterExample;

class TrainingUserNamingExampleProcessor implements TopicSubscriberInterface, MessageProcessorInterface
{
    public function __construct(
        private DoctrineHelper $doctrine,
        private TrainingNamingConverterExample $converter,
        private LoggerInterface $logger
    ) {
    }

    public function process(MessageInterface $message, SessionInterface $session)
    {
        $data    = JSON::decode($message->getBody());
        $id      = $data['id'];
        $format  = $data['format'];

        if (!$id) {
            return self::REJECT;
        }

        $example = $this->converter->getExample($format);
        $em      = $this->doctrine->getEntityManager(UserNamingType::class);

        /** @var UserNamingType $userNamingType */
        $userNamingType = $this->doctrine->getEntity(UserNamingType::class, $id);

        if ($userNamingType) {
            $userNamingType->setExample($example);
            $em->flush();
        }

        $this->logger->info(
            sprintf('%s %s', Topic::USER_NAMING_REGENERATE_EXAMPLE, 'proceed'),
            $data
        );

        return self::ACK;
    }

    public static function getSubscribedTopics()
    {
        return [Topic::USER_NAMING_REGENERATE_EXAMPLE];
    }
}
