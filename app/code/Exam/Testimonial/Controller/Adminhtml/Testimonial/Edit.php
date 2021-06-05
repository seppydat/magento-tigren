<?php

namespace Exam\Testimonial\Controller\Adminhtml\Testimonial;


class Edit extends \Magento\Backend\App\Action
{
    protected $_resultPageFactory;
    protected $_contentFactory;
    protected $_messageManager;
    protected $_coreRegistry;

    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\App\Action\Context $context,
        \Exam\Testimonial\Model\TestimonialContentFactory $contentFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\Registry $coreRegistry
    )
    {
        $this->_messageManager = $messageManager;
        $this->_contentFactory = $contentFactory;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_coreRegistry= $coreRegistry;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $model = $this->_contentFactory->create();
        $modelId = $this->getRequest()->getParam('id');
        $model->load($modelId);
        $this->_coreRegistry->register('content',$model);
//        if (empty($model->getData())) {
//            $resultPage->getConfig()->getTitle()->prepend((__('Create Content')));
//        }elseif($model->getData()){
//            $resultPage->getConfig()->getTitle()->prepend((__('Customer '. $model->getData('code'))));
//        }

        $resultPage->getConfig()->getTitle()->prepend(__("Edit Content"));
        $resultPage->setActiveMenu('Exam_Testimonial::TestimonialContent');
        return $resultPage;
    }
}
