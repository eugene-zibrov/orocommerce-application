<?php

namespace Training\Bundle\UserNamingBundle\ImportExport\TemplateFixture;

use Oro\Bundle\ImportExportBundle\TemplateFixture\AbstractTemplateRepository;
use Oro\Bundle\ImportExportBundle\TemplateFixture\TemplateFixtureInterface;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;
use Training\Bundle\UserNamingBundle\Service\NamingConverterInterface;

class UserNamingFixture extends AbstractTemplateRepository implements TemplateFixtureInterface
{

    protected function createEntity($key)
    {
        return new UserNamingType();
    }

    public function getEntityClass()
    {
        return UserNamingType::class;
    }

    /**
     * @param string $key
     * @param UserNamingType $entity
     * @return void
     */
    public function fillEntityData($key, $entity)
    {
        $entity
            ->setId(1)
            ->setTitle('Test title')
            ->setExample('Test example string')
            ->setFormat(
                sprintf(
                    '%s %s %s %s %s',
                    NamingConverterInterface::PREFIX,
                    NamingConverterInterface::FIRST,
                    NamingConverterInterface::MIDDLE,
                    NamingConverterInterface::LAST,
                    NamingConverterInterface::SUFFIX
                )
            )
            ->setEnabled('1');
    }

    public function getData()
    {
        return $this->getEntityData('example-usernaming');
    }
}
