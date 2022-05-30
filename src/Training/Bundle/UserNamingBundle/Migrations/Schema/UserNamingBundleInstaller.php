<?php

namespace Training\Bundle\UserNamingBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityBundle\EntityConfig\DatagridScope;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\EntityExtendBundle\Extend\RelationType;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
use Oro\Bundle\FormBundle\Form\Type\OroResizeableRichTextType;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 */
class UserNamingBundleInstaller implements Installation, ExtendExtensionAwareInterface
{
    private ExtendExtension $extendExtension;
    /**
     * {@inheritdoc}
     */
    public function getMigrationVersion(): string
    {
        return 'v1_1';
    }

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        /** Tables generation **/
        $this->createUserNamingTypeTable($schema);
        /** Foreign keys generation **/
        $this->addRelationsToUser($schema);
    }

    /**
     * Create oro_organization table
     */
    protected function createUserNamingTypeTable(Schema $schema)
    {
        $table = $schema->createTable('user_naming_type');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('title', 'string', ['length' => 255]);
        $table->addColumn('format', 'string', ['length' => 255]);
        $table->addColumn('enabled', 'boolean', ['default' => '1']);
        $table->addUniqueIndex(['title'], 'uniq_628fc0a231749');
        $table->setPrimaryKey(['id']);
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

    public function setExtendExtension(ExtendExtension $extendExtension)
    {
        $this->extendExtension = $extendExtension;
    }
}
