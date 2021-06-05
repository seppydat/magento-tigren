<?php
namespace Exam\Discount\Model\CustomerGroup;

use Magento\Framework\Model\AbstractModel;

class CustomerGroup extends AbstractModel{
    public function _construct(){
        $this->_init("Exam\Discount\Model\CustomerGroup\ResourceModel\CustomerGroup");
    }
}
