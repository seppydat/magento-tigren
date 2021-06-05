<?php
namespace Exam\Discount\Model\DiscountProduct\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class DiscountProduct extends AbstractDb{
    public function _construct(){
        $this->_init('discount_for_products', 'id');
    }
}
