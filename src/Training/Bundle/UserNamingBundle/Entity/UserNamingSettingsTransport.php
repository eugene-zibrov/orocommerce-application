<?php

namespace Training\Bundle\UserNamingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\IntegrationBundle\Entity\Transport;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * @ORM\Entity()
 * @Config()
 */
class UserNamingSettingsTransport extends Transport
{
    /**
     * @ORM\Column(name="training_user_naming_url", type="string", length=255, nullable=true)
     */
    private string $url;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return ParameterBag
     */
    public function getSettingsBag(): ParameterBag
    {
        return new ParameterBag([
            'url' => $this->getUrl()
        ]);
    }

    public function __toString(): string
    {
        return 'User Naming';
    }
}
