<?php
namespace Exam\Discount\Model\CustomerGroup\ResourceModel\CustomerGroup;

use Exam\Discount\Model\CustomerGroup\ResourceModel\CustomerGroup;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection{

    public function _construct(){
        $this->_init(\Exam\Discount\Model\CustomerGroup\CustomerGroup::class, CustomerGroup::class);
    }

    public function getDataCustomerGroup($id_discount) {
        $this->getSelect()->where('id_discount='.$id_discount);

        return $this->getColumnValues('id_customer_group');
    }

     public function getIdByDiscount($id_discount) {
        $this->getSelect()->where('id_discount='.$id_discount);

        return $this->getColumnValues('id');
    }
}
