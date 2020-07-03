<?php
/**
 * Copyright © 2015 Excellence. All rights reserved.
 */

namespace Excellence\ShippingNew\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
	
        $installer = $setup;

        $installer->startSetup();

		/**
         * Create table 'shippingnew_ship'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('shippingnew_ship')
        )
		->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'shippingnew_ship'
        )
		->addColumn(
            'shipping_price',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            [],
            'shipping_price'
        )
		->addColumn(
            'country',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            [],
            'country'
        )
		->addColumn(
            'zip_codes',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            [],
            'zip_codes'
        )
		->addColumn(
            'max_allowed_price',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            [],
            'max_allowed_price'
        )
		/*{{CedAddTableColumn}}}*/
		
		
        ->setComment(
            'Excellence ShippingNew shippingnew_ship'
        );
		
		$installer->getConnection()->createTable($table);
		/*{{CedAddTable}}*/

        $installer->endSetup();

    }
}
