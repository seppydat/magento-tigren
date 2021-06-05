<?php
namespace Exam\Discount\Controller\Adminhtml\Discount;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Exam\Discount\Model\DiscountProduct\DiscountProductFactory;
class MassSelect extends \Magento\Backend\App\Action
{
    protected $_discountProduct;
    protected $filter;
    protected $collectionFactory;
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        DiscountProductFactory $discountProduct
    )
    {
        $this->_discountProduct = $discountProduct;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());

        $idDiscount = $_SESSION['id_discount'];

        $countSuccess = 0;
        $countError = 0;

        $today = date('Y/m/d h:i:s');
        foreach ($collection as $item) {
            try {
                $modelDiscountProduct = $this->_discountProduct->create();
                $data =
                    [
                        'id_discount' => $idDiscount,
                        'id_product' => $item->getId(),
                        'create_at' => $today
                    ];
                $modelDiscountProduct->addData($data)->save();
                $countSuccess++;
            } catch (\Exception $e){
                $countError++;
            }
        }
        unset($_SESSION['id_discount']);
        if ($countSuccess) {
            $this->messageManager->addSuccessMessage(__('%1 Sản phẩm đã được thêm discount.', $countSuccess));
        }

        if ($countError) {
            $this->messageManager->addErrorMessage(__('%1 Sản phẩm đã có discount này.', $countError));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('discount_admin/discount/view');
    }
}
