<?php

namespace Training\Bundle\UserNamedBundle\Twig\Extension;

use Oro\Bundle\UserBundle\Entity\User;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class UserNameExtension extends AbstractExtension
{
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
}
