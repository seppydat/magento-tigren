<?php
namespace Exam\Discount\Controller\Adminhtml\Discount;


class Delete extends \Magento\Backend\App\Action
{
    protected $_resultPageFactory;
    protected $_discountFactory;
    protected $_messageManager;
    protected $_coreRegistry;

    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\App\Action\Context $context,
        \Exam\Discount\Model\Discount\DiscountFactory $discountFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager
    )
    {
        $this->_messageManager = $messageManager;
        $this->_discountFactory = $discountFactory;
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $model = $this->_discountFactory->create();
        $modelId = $this->getRequest()->getParam('id');

//        die("deleting");
        if($model->load($modelId)) {
            $model->delete();
            $message = 'Đã xoá thành công';
            $this->_messageManager->addSuccessMessage($message);
            return $this->_redirect('discount_admin/discount/view', [$resultPage]);
        }else{
            $message = 'Xoá không được';
            $this->_messageManager->addErrorMessage($message);
            return $this->_redirect('discount_admin/discount/view', [$resultPage]);
        }
    }
}
