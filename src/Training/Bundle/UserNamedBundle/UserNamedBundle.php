<?php

namespace Training\Bundle\UserNamedBundle;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Training\Bundle\UserNamedBundle\DependencyInjection\UserNamedBundleExtension;

class UserNamedBundle extends Bundle
{
    public function getContainerExtension(): ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new UserNamedBundleExtension();
        }
        return $this->extension;
    }
}
