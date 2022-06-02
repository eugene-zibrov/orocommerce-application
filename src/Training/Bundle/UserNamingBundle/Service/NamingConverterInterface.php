<?php

namespace Training\Bundle\UserNamingBundle\Service;

use Oro\Bundle\UserBundle\Entity\User;

interface NamingConverterInterface
{
    const PREFIX = 'PREFIX';
    const FIRST  = 'FIRST';
    const MIDDLE = 'MIDDLE';
    const LAST   = 'LAST';
    const SUFFIX = 'SUFFIX';

    public function getNameFor(User $user): string;
}
