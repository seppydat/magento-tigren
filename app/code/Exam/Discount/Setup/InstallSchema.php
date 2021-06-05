<?php
namespace Exam\Discount\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (!$installer->tableExists('discounts')) {

            $tableContent = $installer->getConnection()->newTable(
                $installer->getTable('discounts')
            )->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity'  => true,
                    'primary' => true,
                    'nullable' => false,
                    'unsigned' => true
                ],
                'id discounts'
            )->addColumn(
                'discount_amount',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                16,
                [
                    'nullable' => false
                ],
                'amount discount'
            )->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'name discount'
            )->addColumn(
                'active',
                \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
                10,
                ['nullable' => false],
                'active discount'
            )->addColumn(
                'priority',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                1,
                ['nullable' => false],
                'priority discount'
            )->addColumn(
                'start_time',
                \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
                null,
                [
                    'nullable' => false
                ],
                'start time discount'
            )->addColumn(
                'end_time',
                \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
                null,
                [
                    'nullable' => false
                ],
                'end time discount'
            )->addColumn(
                'create_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
                255,
                [
                    'nullable' => false
                ],
                'create at discount'
            )->setComment('discount table');

            $installer->getConnection()->createTable($tableContent);
        }

        if (!$installer->tableExists('discount_for_customer_group')) {
            $tableContent = $installer->getConnection()->newTable(
                $installer->getTable('discount_for_customer_group')
            )->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'primary' => true,
                    'nullable' => false,
                    'unsigned' => true
                ],
                'id discounts for customer group'
            )->addColumn(
                'id_discount',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                1,
                [
                    'nullable' => false,
                    'unsigned' => true
                ],
                'id discount'
            )->addColumn(
                'id_customer_group',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                1,
                ['nullable' => false],
                'id customer group'
            )->addColumn(
                'create_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
                255,
                [
                    'nullable' => false
                ],
                'create at discount for customer group'
            )->addForeignKey(
                $installer->getFkName('discount_for_customer_group','id_discount','discounts','id'),
                'id_discount',
                $installer->getTable('discounts'),
                'id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )->setComment('discount for customer group table');

            $installer->getConnection()->createTable($tableContent);
        }

        if (!$installer->tableExists('discount_for_products')) {
            $tableContent = $installer->getConnection()->newTable(
                $installer->getTable('discount_for_products')
            )->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'primary' => true,
                    'nullable' => false,
                    'unsigned' => true
                ],
                'id discounts for product'
            )->addColumn(
                'id_discount',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                1,
                [
                    'nullable' => false,
                    'unsigned' => true
                ],
                'id discount'
            )->addColumn(
                'id_product',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                1,
                ['nullable' => false],
                'id product'
            )->addColumn(
                'create_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
                255,
                [
                    'nullable' => false
                ],
                'create at discount for product'
            )->addForeignKey(
                $installer->getFkName('discount_for_products','id_discount','discounts','id'),
                'id_discount',
                $installer->getTable('discounts'),
                'id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )->setComment('discount for product table');

            $installer->getConnection()->createTable($tableContent);
        }

        $installer->endSetup();
    }
}
