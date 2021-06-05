<?php
namespace Exam\Testimonial\Controller\Adminhtml\Customer;


class Delete extends \Magento\Backend\App\Action
{
    protected $_resultPageFactory;
    protected $_CustomerFactory;
    protected $_messageManager;
    protected $_coreRegistry;

    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\App\Action\Context $context,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager
    )
    {
        $this->_messageManager = $messageManager;
        $this->_CustomerFactory = $customerFactory;
        $this->_resultPageFactory = $resultPageFactory;
        die('dsiuhdias');
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $model = $this->_CustomerFactory->create();
        $modelId = $this->getRequest()->getParam('id');


        if($model->load($modelId)) {
            $model->delete();
            $message = 'Đã xoá thành công';
            $this->_messageManager->addSuccessMessage($message);
            return $this->_redirect('testimonial_admin/customer/view', [$resultPage]);
        }else{
            $message = 'Xoá không được';
            $this->_messageManager->addSuccessMessage($message);
            return $this->_redirect('testimonial_admin/customer/edit', [$resultPage]);
        }
    }
}
