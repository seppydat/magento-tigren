<?php
namespace Exam\Discount\Model\DiscountProduct\ResourceModel\DiscountProduct;

use Exam\Discount\Model\DiscountProduct\ResourceModel\DiscountProduct;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection{
    public function _construct(){

        $this->_init(\Exam\Discount\Model\DiscountProduct\DiscountProduct::class, DiscountProduct::class);
    }

    public function getListIdProductOfDiscount($idDiscount) {

        $this->getSelect()->where('main_table.id_discount = '.$idDiscount);

        return $this->getData();
    }

    public function getDiscountOfProduct (
        $CustomerGroup,
        $idProduct
    ) {
        $discount = null;

        $obj = \Magento\Framework\App\ObjectManager::getInstance();
        $discountFactory = $obj->get('Exam\Discount\Model\Discount\ResourceModel\Discount\CollectionFactory');
        $discountCollection = $discountFactory->create();

        $dataListDiscount = $discountCollection->getListDiscount($CustomerGroup);

        if (count($dataListDiscount) != 0) {
            $listIdDiscount = '(';
            foreach ($dataListDiscount as $index => $value) {
                if (($index+1) == count($dataListDiscount)) {
                    $listIdDiscount .= $value['id_discount'] . ')';
                } else {
                    $listIdDiscount .= $value['id_discount'] . ',';
                }
            }

            $this->getSelect()->join(
                ['discount' => 'discounts'],
                'discount.id = main_table.id_discount'
            )->where('main_table.id_product = '.$idProduct
            )->where('main_table.id_discount in '.$listIdDiscount);

            $listDiscountCanUse = $this->getData();

            if (!empty($listDiscountCanUse)) {
                $priorityMax = -1;

                foreach ($listDiscountCanUse as $value) {
                    if ($value['priority'] > $priorityMax) {
                        $priorityMax = $value['priority'];
                    }
                }
                $discountPriorityMax = array();
                foreach ($listDiscountCanUse as $index => $value) {
                    if ($value['priority'] == $priorityMax) {
                        $discountPriorityMax[$index] = $value;
                    }
                }

                $discount = $discountPriorityMax[0];
                for ($i = 1; $i < count($discountPriorityMax); $i++) {
                    if ($discountPriorityMax[$i]['discount_amount'] > $discount['discount_amount']) {
                        $discount = $discountPriorityMax[$i];
                    }
                }

                return $discount;
            } else {
                return $discount;
            }
        } else {
            return $discount;
        }

    }
}
