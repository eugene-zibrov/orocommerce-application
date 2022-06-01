<?php

namespace Training\Bundle\UserNamingBundle\Integration\Connector;

use Oro\Bundle\EntityBundle\ORM\DoctrineHelper;
use Oro\Bundle\IntegrationBundle\Provider\ConnectorInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Training\Bundle\UserNamingBundle\Entity\UserNamingSettingsTransport;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;
use Training\Bundle\UserNamingBundle\Service\TrainingNamingConverterExample;

class TrainingUserNamingTypeImportConnector implements ContainerAwareInterface, ConnectorInterface
{
    private ContainerInterface $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getLabel(): string
    {
        return 'training.usernaming.transport_label';
    }

    public function getImportJobName()
    {
        return 'app_task_import';
    }

    public function getType()
    {
        return 'task';
    }

    public function getImportEntityFQCN()
    {
        return UserNamingSettingsTransport::class;
    }

    public function importUserNamingTypes()
    {
        $logger     = $this->container->get('logger');
        /** @var DoctrineHelper $doctrine */
        $doctrine   = $this->container->get('oro_entity.doctrine_helper');
        $converterExample = $this->container->get('training.usernaming.example.format');
        $transports = $doctrine
            ->getEntityRepository(UserNamingSettingsTransport::class)
            ->findAll();
        $it = new \ArrayIterator($transports);

        while ($transport = $it->current()) {
            $url = $transport->getUrl();
            $fiber = $this->createJobFiber();
            $fiber->start($url, $doctrine, $converterExample, $logger);
            $it->next();
        }
    }

    private function createJobFiber(): \Fiber
    {
        return new \Fiber(
            function (
                string $url,
                DoctrineHelper $doctrine,
                TrainingNamingConverterExample $converter,
                LoggerInterface $log
            ) {
                $content = file_get_contents($url);
                $data    = json_decode($content);
                $manager = $doctrine->getManager();
                $repository = $manager->getRepository(UserNamingType::class);
                foreach ($data as $userNaming) {
                    $existingNamingType = $repository->findOneBy(['format' => $userNaming?->format]);
                    if (!is_null($existingNamingType)) {
                        continue;
                    }
                    $userNamingType = new UserNamingType();
                    $userNamingType
                        ->setTitle($userNaming?->title)
                        ->setFormat($userNaming?->format)
                        ->setExample($converter->getExample($userNaming?->format))
                        ->setEnabled('1');
                    $log->info('UserNamingTypeImport', (array)$userNaming);
                    $manager->persist($userNamingType);
                }
                $manager->flush();
            }
        );
    }
}
