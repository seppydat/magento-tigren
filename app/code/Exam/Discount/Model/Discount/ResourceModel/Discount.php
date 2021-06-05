<?php
namespace Exam\Discount\Model\Discount\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Discount extends AbstractDb{
    public function _construct(){
        $this->_init('discounts', 'id');
    }
}
