<?php
namespace Exam\Discount\Model\CustomerGroup\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CustomerGroup extends AbstractDb{
    public function _construct(){
        $this->_init('discount_for_customer_group', 'id');
    }
}
