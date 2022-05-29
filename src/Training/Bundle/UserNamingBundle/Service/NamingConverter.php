<?php

namespace Training\Bundle\UserNamingBundle\Service;

use Oro\Bundle\UserBundle\Entity\User;

class NamingConverter implements NamingConverterInterface
{
    const DEFAULT_NAMING = self::FIRST.' '.self::LAST;

    /**
     * @param User $user
     * @return array
     */
    private function getConvertingMap(User $user): array
    {
        return [
            self::FIRST  => $user->getFirstName(),
            self::LAST   => $user->getLastName(),
            self::MIDDLE => $user->getMiddleName(),
            self::PREFIX => $user->getNamePrefix(),
            self::SUFFIX => $user->getNameSuffix()
        ];
    }

    /**
     * @param User $user
     * @return string
     */
    public function getNameFor(User $user): string
    {
        $map    = $this->getConvertingMap($user);
        $naming = $user->getNamingType()?->getFormat();
        if (!$naming) {
            $naming = self::DEFAULT_NAMING;
        }
        return trim(str_replace(array_keys($map), array_values($map), $naming));
    }
}
