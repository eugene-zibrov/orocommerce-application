<?php

namespace Training\Bundle\UserNamingBundle\Migrations\Schema\v1_4;

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class UserNamingBundle implements Migration
{

    public function up(Schema $schema, QueryBag $queries)
    {
        $schema
            ->getTable('user_naming_type')
            ->dropColumn('enabled');
    }
}
