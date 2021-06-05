<?php

namespace Exam\Discount\Observer;

use Exam\Discount\Model\DiscountProduct\ResourceModel\DiscountProduct\Collection as discountProduct;
use Magento\Customer\Model\Session;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CustomPrice implements ObserverInterface
{
    protected $_customerSession;
    protected $_discountProduct;
    public function __construct(
        discountProduct $discountProductCollection,
        Session $customerSession
    )
    {
        $this->_customerSession = $customerSession;
        $this->_discountProduct = $discountProductCollection;
    }

    public function execute(Observer $observer) {
        $item = $observer->getEvent()->getData('quote_item');
        $item = ( $item->getParentItem() ? $item->getParentItem() : $item );

        $idProduct = $item->getProductId();
        $idCustomerGroup = $this->_customerSession->getCustomerGroupId();

        $discount = $this->_discountProduct->getDiscountOfProduct($idCustomerGroup, $idProduct);
        $discountAmount = (empty($discount)) ? 0 : $discount['discount_amount'];

        $oldPrice = $item->getProduct()->getPrice();
        $price = $oldPrice*(1-$discountAmount/100);
        $item->setCustomPrice($price);
        $item->setOriginalCustomPrice($price);
        $item->getProduct()->setIsSuperMode(true);

    }

}
