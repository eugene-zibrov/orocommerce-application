<?php

namespace Acme\Bundle\TrainingBundle\Provider;

use Oro\Bundle\EntityBundle\Provider\EntityNameProviderInterface;
use Oro\Bundle\UserBundle\Entity\User;

class TrainingUserNameProviderDecorator implements EntityNameProviderInterface
{
    /**
     * @param EntityNameProviderInterface $originalProvider
     */
    public function __construct(private EntityNameProviderInterface $originalProvider)
    {
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
            return implode(' ', [$entity->getLastName(), $entity->getFirstName(), $entity->getMiddleName()]);
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
