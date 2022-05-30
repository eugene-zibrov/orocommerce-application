<?php

namespace Training\Bundle\UserNamingBundle\Twig\Extension;

use Oro\Bundle\UserBundle\Entity\User;
use Training\Bundle\UserNamingBundle\Service\NamingConverterInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class UserNamingExtension extends AbstractExtension
{

    public function __construct(private NamingConverterInterface $formatter)
    {
    }

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
        return $this->formatter->getNameFor($user);
    }
}
