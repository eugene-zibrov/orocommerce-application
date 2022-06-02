<?php

namespace Training\Bundle\UserNamingBundle\Provider;

use Oro\Bundle\EntityBundle\Provider\EntityNameProviderInterface;
use Oro\Bundle\UserBundle\Entity\User;
use Training\Bundle\UserNamingBundle\Service\NamingConverterInterface;

class UserNamingProviderDecorator implements EntityNameProviderInterface
{
    /**
     * @param EntityNameProviderInterface $originalProvider
     */
    public function __construct(
        private EntityNameProviderInterface $originalProvider,
        private NamingConverterInterface $namingConverter
    ) {
    }

    /**
     * @param $format
     * @param $locale
     * @param User $entity
     * @return string|void
     */
    public function getName($format, $locale, $entity): string
    {
        /** @var User $entity */
        if ($this->supports($entity)) {
            return $this->namingConverter->getNameFor($entity);
        }
        return $this->originalProvider->getName($format, $locale, $entity);
    }

    /**
     * @param $format
     * @param $locale
     * @param $className
     * @param $alias
     * @return string
     */
    public function getNameDQL($format, $locale, $className, $alias): string
    {
        return $this->originalProvider->getNameDQL($format, $locale, $className, $alias);
    }

    /**
     * @param $entity
     * @return bool
     */
    public function supports($entity): bool
    {
        return $entity instanceof User;
    }
}
