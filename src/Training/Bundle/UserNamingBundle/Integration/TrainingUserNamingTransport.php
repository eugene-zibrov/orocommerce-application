<?php

namespace Training\Bundle\UserNamingBundle\Integration;

use Oro\Bundle\IntegrationBundle\Entity\Transport;
use Oro\Bundle\IntegrationBundle\Provider\TransportInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\ParameterBag;
use Training\Bundle\UserNamingBundle\Entity\UserNamingSettingsTransport;

class TrainingUserNamingTransport implements TransportInterface
{
    const USER_NAMING_TRANSPORT_LABEL = 'training.usernaming.transport_label';

    /**
     * @var ParameterBag $settings
     */
    protected ParameterBag $settings;

    /**
     * @param Transport $transportEntity
     * @return void
     */
    public function init(Transport $transportEntity): void
    {
        $this->settings = $transportEntity->getSettingsBag();
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return self::USER_NAMING_TRANSPORT_LABEL;
    }

    /**
     * @return string
     */
    public function getSettingsFormType(): string
    {
        return TextType::class;
    }

    /**
     * @return string
     */
    public function getSettingsEntityFQCN(): string
    {
        return UserNamingSettingsTransport::class;
    }
}
