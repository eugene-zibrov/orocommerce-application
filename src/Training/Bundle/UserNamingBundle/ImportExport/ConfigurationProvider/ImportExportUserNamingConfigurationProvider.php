<?php

namespace Training\Bundle\UserNamingBundle\ImportExport\ConfigurationProvider;

use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfiguration;
use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfigurationInterface;
use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfigurationProviderInterface;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;

class ImportExportUserNamingConfigurationProvider implements ImportExportConfigurationProviderInterface
{

    public function get(): ImportExportConfigurationInterface
    {
        return new ImportExportConfiguration([
            ImportExportConfiguration::FIELD_ENTITY_CLASS                    =>
                UserNamingType::class,
            ImportExportConfiguration::FIELD_EXPORT_PROCESSOR_ALIAS          =>
                'training_uisernaming_type_export',
            ImportExportConfiguration::FIELD_EXPORT_TEMPLATE_PROCESSOR_ALIAS =>
                'training_uisernaming_type_export',
            ImportExportConfiguration::FIELD_IMPORT_PROCESSOR_ALIAS          =>
                'training_uisernaming_type_import_with_strategy_add_or_replace'
        ]);
    }
}
