<?php
namespace Exam\Testimonial\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (!$installer->tableExists('testimonial_content')) {
            $tableContent = $installer->getConnection()->newTable(
                $installer->getTable('testimonial_content')
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
                'testimonial id content'
            )->addColumn(
                'id_customer',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                16,
                [
                    'nullable' => false
                ],
                'testimonial id customer'
            )->addColumn(
                'content',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'testimonial content'
            )->addColumn(
                'rating',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                10,
                ['nullable' => false],
                'testimonial rating'
            )->addColumn(
                'status',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                1,
                ['nullable' => false],
                'testimonial status'
            )->addColumn(
                'create_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
                null,
                [
                    'nullable' => false
                ],
                'customer create_at'
            )->addColumn(
                'update_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
                null,
                [
                    'nullable' => false
                ],
                'customer update_at'
            )->addColumn(
                'profile_img',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [
                    'nullable' => false
                ],
                'customer img'
            )->setComment('testimonial content table');

            $installer->getConnection()->createTable($tableContent);
        }


//        $table = $installer->getConnection()->newTable(
//            $setup->getTable('customer_entity')
//            )->addColumn(
//            'profile_img',
//            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
//            255,
//            ['identity' => true, 'nullable' => true]
//            );
//
//        $setup->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
