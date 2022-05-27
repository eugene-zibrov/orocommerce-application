<?php

namespace Training\Bundle\UserNamedBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Training\Bundle\UserNamedBundle\Entity\UserNamingType;

class LoadUserNamingTypes extends AbstractFixture implements OrderedFixtureInterface
{
    private array $data = [
        'Official'         => 'PREFIX FIRST MIDDLE LAST SUFFIX',
        'Unofficial'       => 'FIRST LAST',
        'First name only'  => 'FIRST'
    ];

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
        foreach ($this->data as $title => $format) {
            $userNamingType = new UserNamingType();
            $userNamingType
                ->setTitle($title)
                ->setFormat($format);

            $manager->persist($userNamingType);
        }

        $manager->flush();
    }
}
