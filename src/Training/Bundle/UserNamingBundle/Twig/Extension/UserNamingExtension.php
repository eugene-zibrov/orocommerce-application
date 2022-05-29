<?php

namespace Training\Bundle\UserNamingBundle\Twig\Extension;

use Oro\Bundle\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class UserNamingExtension extends AbstractExtension implements ContainerAwareInterface
{
    private ContainerInterface $container;
    /**
     * @return iterable
     */
    public function getFilters(): iterable
    {
        yield new TwigFilter('oro_format_full_name', [$this, 'formatFullName']);
    }

    /**
     * @param User $user
     * @return string
     */
    public function formatFullName(User $user): string
    {
        return sprintf(
            '%s %s %s',
            ucfirst($user->getFirstName()),
            ucfirst($user->getMiddleName()),
            ucfirst($user->getLastName())
        );
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
