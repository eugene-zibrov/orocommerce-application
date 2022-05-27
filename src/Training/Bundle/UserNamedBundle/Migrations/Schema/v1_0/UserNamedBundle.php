<?php

namespace Training\Bundle\UserNamedBundle\Migrations\Schema\v1_0;

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
    public function getMigrationVersion(): string
    {
        return 'v1_0';
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
        $table->addColumn('format', 'string', ['notnull' => false]);
        $table->addColumn('enabled', 'boolean', ['default' => '1']);
        $table->addUniqueIndex(['title'], 'uniq_628fc0a231749');
        $table->setPrimaryKey(['id']);
    }

    private function addRelationsToUser(Schema $schema)
    {
        $this->extendExtension->addManyToOneRelation(
            $schema,
            'oro_user', // owning side table
            'naming_type', // owning side field name
            'user_naming_type', // inverse side table
            'id', // column name is used to show related entity
            [
                'extend' => [
                    'owner' => ExtendScope::OWNER_CUSTOM
                ]
            ]
        );
    }
}
