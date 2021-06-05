<?php
namespace Exam\Discount\Block\Adminhtml\Discount;

use Magento\Framework\View\Element\Template;
use Exam\Discount\Model\DiscountProduct\ResourceModel\DiscountProduct\Collection as discountProductCollection;
class ProductOfDiscount extends Template
{
    protected $_discountProductCollection;
    protected $_resource;
    protected $_productFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\ResourceConnection $Resource,
        discountProductCollection $DiscountProductCollection,
        \Magento\Catalog\Model\ProductFactory $productFactory
    )
    {
        $this->_productFactory = $productFactory;
        $this->_resource = $Resource;
        $this->_discountProductCollection = $DiscountProductCollection;
        parent::__construct($context);
    }

    public function getAllDataProducts()
    {
        $id_discount = $this->getData('id_discount');
        $listDiscountForProduct = $this->_discountProductCollection->getListIdProductOfDiscount($id_discount);

        $listIdProduct = array();
        foreach ($listDiscountForProduct as $index => $value) {
            $listIdProduct[$index] = $value['id_product'];
        }

        $dataProduct = array();
        foreach ($listIdProduct as $index => $idProduct) {
            $dataProduct[$index] = $this->_productFactory->create()->load($idProduct);
        }

        return $dataProduct;
    }
}
