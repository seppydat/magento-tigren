<?php
namespace Exam\Discount\Controller\Adminhtml\Discount;


class RemoveProduct extends \Magento\Backend\App\Action
{
    protected $_resultPageFactory;
    protected $_discountProductFactory;
    protected $_messageManager;
    protected $_coreRegistry;

    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\App\Action\Context $context,
        \Exam\Discount\Model\DiscountProduct\DiscountProductFactory $discountProductFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager
    )
    {
        $this->_messageManager = $messageManager;
        $this->_discountProductFactory = $discountProductFactory;
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $model = $this->_discountProductFactory->create();
        $modelId = $this->getRequest()->getParam('id');

        $id_discount = $this->getRequest()->getParam('id_discount');

//        echo $modelId .' - '.$id_discount;
//        die();
        if($model->load($modelId)) {
            $model->delete();
            $message = 'Đã xoá thành công';
            $this->_messageManager->addSuccessMessage($message);
            return $this->_redirect('discount_admin/discount/productOfDiscount/id/'.$id_discount, [$resultPage]);
        }else{
            $message = 'Xoá không được';
            $this->_messageManager->addErrorMessage($message);
            return $this->_redirect('discount_admin/discount/productOfDiscount/id/'.$id_discount, [$resultPage]);
        }
    }
}
