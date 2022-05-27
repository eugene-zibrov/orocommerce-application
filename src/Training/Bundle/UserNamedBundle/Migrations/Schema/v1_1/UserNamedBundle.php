<?php

namespace Training\Bundle\UserNamedBundle\Migrations\Schema\v1_1;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class UserNamedBundle implements Migration, ExtendExtensionAwareInterface
{
    /** @var ExtendExtension */
    private ExtendExtension $extendExtension;

    /**
     * {@inheritdoc}
     */
    public function setExtendExtension(ExtendExtension $extendExtension)
    {
        $this->extendExtension = $extendExtension;
    }

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        /** Foreign keys generation **/
        $this->addRelationsToUser($schema);
    }

    private function addRelationsToUser(Schema $schema)
    {
        $this->extendExtension->addManyToOneRelation(
            $schema,
            'oro_user', // owning side table
            'namingType', // owning side field name
            'user_naming_type', // inverse side table
            'title', // column name is used to show related entity
            [
                'extend' => [
                    'owner' => ExtendScope::OWNER_CUSTOM
                ]
            ]
        );
    }
}
