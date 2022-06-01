<?php

namespace Training\Bundle\UserNamingBundle\Migrations\Schema\v1_3;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class UserNamingBundle implements Migration
{

    public function up(Schema $schema, QueryBag $queries)
    {
        $schema
            ->getTable('oro_integration_transport')
            ->addColumn('training_user_naming_url', 'string', ['notnull' => false]);
    }
}
