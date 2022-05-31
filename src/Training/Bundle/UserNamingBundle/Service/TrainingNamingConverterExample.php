<?php

namespace Training\Bundle\UserNamingBundle\Service;

use Oro\Bundle\UserBundle\Entity\User;

class TrainingNamingConverterExample
{
    const EXAMPLE_USER_NAME        = 'John';
    const EXAMPLE_USER_MIDDLE_NAME = 'Artur';
    const EXAMPLE_USER_LAST_NAME   = 'Doe';
    const EXAMPLE_USER_PREFIX      = 'Mr';
    const EXAMPLE_USER_SUFFIX      = 'Jr';

    private array $replacements = [
        NamingConverterInterface::FIRST  => self::EXAMPLE_USER_NAME,
        NamingConverterInterface::LAST   => self::EXAMPLE_USER_LAST_NAME,
        NamingConverterInterface::MIDDLE => self::EXAMPLE_USER_MIDDLE_NAME,
        NamingConverterInterface::PREFIX => self::EXAMPLE_USER_PREFIX,
        NamingConverterInterface::SUFFIX => self::EXAMPLE_USER_SUFFIX
    ];

    public function getExample(string $format): string
    {
        return str_replace(
            array_keys($this->replacements),
            array_values($this->replacements),
            $format
        );
    }
}
