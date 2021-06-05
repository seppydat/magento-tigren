<?php

namespace Exam\Testimonial\Controller\Adminhtml\Testimonial;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class View extends Action
{
    protected $resultPageFactory = false;
    public function __construct(
         Context $context,
         PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Exam_Testimonial::ParentTestimonial');
        $resultPage->getConfig()->getTitle()->prepend(__('Testimonial Content'));
        return $resultPage;
    }
}
