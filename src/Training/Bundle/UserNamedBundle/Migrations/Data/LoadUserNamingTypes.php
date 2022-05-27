<?php

namespace Training\Bundle\UserNamedBundle\Migrations\Data;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Oro\Bundle\OrganizationBundle\Entity\BusinessUnit;
use Oro\Bundle\OrganizationBundle\Entity\Organization;

class LoadUserNamingTypes extends AbstractFixture implements OrderedFixtureInterface
{
    const MAIN_ORGANIZATION  = 'default';
    const MAIN_BUSINESS_UNIT = 'Main';
    const REFERENCE_DEFAULT_ORGANIZATION = 'default_organization';

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        /*
         * This fixture has high priority because many other fixtures depends on it, so there is case when ordered
         * fixture needs to be executed also after this one
         */
        return -240;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        // load default organization
        $defaultOrganization = new Organization();
        $defaultOrganization
            ->setName(self::MAIN_ORGANIZATION)
            ->setEnabled(true);
        $this->addReference(self::REFERENCE_DEFAULT_ORGANIZATION, $defaultOrganization);
        $manager->persist($defaultOrganization);

        // load default business unit
        $defaultBusinessUnit = new BusinessUnit();
        $defaultBusinessUnit
            ->setName(self::MAIN_BUSINESS_UNIT)
            ->setOrganization($defaultOrganization);
        $this->addReference('default_business_unit', $defaultBusinessUnit);
        $manager->persist($defaultBusinessUnit);

        $manager->flush();
    }
}
