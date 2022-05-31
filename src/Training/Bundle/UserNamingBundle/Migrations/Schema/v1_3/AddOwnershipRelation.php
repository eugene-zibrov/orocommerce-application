<?php

namespace Training\Bundle\UserNamingBundle\Migrations\Schema\v1_3;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityBundle\EntityConfig\DatagridScope;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\EntityExtendBundle\Extend\RelationType;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
use Oro\Bundle\FormBundle\Form\Type\OroResizeableRichTextType;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 */
class AddOwnershipRelation implements Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        /** Foreign keys generation **/
        $this->addOwnershipFieldsAndConstaraints($schema);
    }

    /**
     * Create oro_organization table
     */
    protected function addOwnershipFieldsAndConstaraints(Schema $schema)
    {
        $table = $schema->getTable('user_naming_type');
//        $table->addColumn('user_owner_id', 'integer', ['notnull' => false]);
//        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
//        $table->addForeignKeyConstraint('oro_user', ['user_owner_id'], ['id']);
//        $table->addForeignKeyConstraint('oro_organization', ['organization_id'], ['id']);
    }
}
