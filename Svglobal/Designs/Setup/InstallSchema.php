<?php

namespace Svglobal\Designs\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $table_svglobal_events = $setup->getConnection()->newTable($setup->getTable('svglobal_events'));

        $table_svglobal_events->addColumn(
            'event_id',
            Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'nullable' => false,
                'primary' => true,
                'unsigned' => true,
            ],
            'Entity ID'
        );

        $table_svglobal_events->addColumn(
            'eventname',
            Table::TYPE_TEXT,
            null,
            [],
            'eventname'
        );
		
		$table_svglobal_events->addColumn(
            'description',
            Table::TYPE_TEXT,
            null,
            [],
            'description'
        );
        
        $table_svglobal_events->addColumn(
            'image',
            Table::TYPE_TEXT,
            null,
            [],
            'image'
        );

		$table_svglobal_events->addColumn(
            'eventdate',
            Table::TYPE_TEXT,
            null,
            [],
            'eventdate'
        );
		
        $table_svglobal_events->addColumn(
            'sortorder',
            Table::TYPE_INTEGER,
            null,
            [],
            'sortorder'
        );
        
        $table_svglobal_events->addColumn(
            'status',
            Table::TYPE_BOOLEAN,
            null,
            [],
            'status'
        );
        $setup->getConnection()->createTable($table_svglobal_events);
        $setup->endSetup();
    }
}
