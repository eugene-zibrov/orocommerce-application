<?php

namespace Training\Bundle\UserNamingBundle\Integration;

use Oro\Bundle\IntegrationBundle\Provider\ChannelInterface;
use Oro\Bundle\IntegrationBundle\Provider\IconAwareIntegrationInterface;

class TrainingUserNamingChannelType implements ChannelInterface, IconAwareIntegrationInterface
{
    const TYPE                       = 'usernaming';
    const USERNAMINING_CHANNEL_LABEL = 'training.usernaming.entity_plural_label';
    const USERNAMINING_ICON          = 'img/user_naming.png';

    public function getLabel()
    {
        return self::USERNAMINING_CHANNEL_LABEL;
    }

    public function getIcon()
    {
        return self::USERNAMINING_ICON;
    }
}
