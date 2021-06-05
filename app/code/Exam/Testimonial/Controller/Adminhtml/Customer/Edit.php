<?php

namespace Exam\Testimonial\Controller\Adminhtml\Customer;


class Edit extends \Magento\Backend\App\Action
{
    protected $_resultPageFactory;
    protected $_customerFactory;
    protected $_messageManager;
    protected $_coreRegistry;

    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\App\Action\Context $context,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\Registry $coreRegistry
    )
    {
        $this->_messageManager = $messageManager;
        $this->_customerFactory = $customerFactory;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_coreRegistry= $coreRegistry;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $model = $this->_customerFactory->create();
        $modelId = $this->getRequest()->getParam('id');
        $model->load($modelId);
        $this->_coreRegistry->register('customer',$model);
        if (empty($model->getData())) {
            $resultPage->getConfig()->getTitle()->prepend((__('Create New Customer')));
        }elseif($model->getData()){
            $resultPage->getConfig()->getTitle()->prepend((__('Customer '. $model->getData('code'))));
        }
        $resultPage->setActiveMenu('Exam_Testimonial::TestimonialCustomer');
        return $resultPage;
    }
}
