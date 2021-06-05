<?php
namespace Exam\Discount\Model\Discount;

use Magento\Framework\Model\AbstractModel;

class Discount extends AbstractModel{
    public function _construct(){
        $this->_init("Exam\Discount\Model\Discount\ResourceModel\Discount");
    }
}
