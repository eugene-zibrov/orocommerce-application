<?php

namespace Training\Bundle\UserNamingBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;

class LoadUserNamingTypes extends AbstractFixture implements OrderedFixtureInterface
{
    private array $data = [
        'Official'         => [
            'PREFIX FIRST MIDDLE LAST SUFFIX',
            'Mr John Artur Doe Jr'
        ],
        'Unofficial'       => [
            'FIRST LAST',
            'John Doe'
        ],
        'First name only'  => [
            'FIRST',
            'John'
        ]
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
        foreach ($this->data as $title => $data) {
            $userNamingType = new UserNamingType();
            $userNamingType
                ->setTitle($title)
                ->setFormat($data[0])
                ->setExample($data[1]);

            $manager->persist($userNamingType);
        }

        $manager->flush();
    }
}
