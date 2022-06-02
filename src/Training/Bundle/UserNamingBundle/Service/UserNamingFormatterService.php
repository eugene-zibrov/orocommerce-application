<?php

namespace Training\Bundle\UserNamingBundle\Service;

use Oro\Bundle\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserNamingFormatterService implements ContainerAwareInterface
{
    private ContainerInterface $container;

    public function formatByExtension(User $user)
    {
        $doctrine = $this->container->get('doctrine');
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
