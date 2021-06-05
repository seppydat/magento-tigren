<?php
namespace Exam\Discount\Model\DiscountProduct;

use Magento\Framework\Model\AbstractModel;

class DiscountProduct extends AbstractModel{
    public function _construct(){
        $this->_init("Exam\Discount\Model\DiscountProduct\ResourceModel\DiscountProduct");
    }
}
