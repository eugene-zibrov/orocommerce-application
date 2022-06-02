<?php

namespace Training\Bundle\UserNamingBundle;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Training\Bundle\UserNamingBundle\DependencyInjection\UserNamingBundleExtension;

class UserNamingBundle extends Bundle
{
    public function getContainerExtension(): ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new UserNamingBundleExtension();
        }
        return $this->extension;
    }
}
