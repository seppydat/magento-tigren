<?php

namespace Exam\Discount\Controller\Adminhtml\Discount;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Product extends Action
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
        $idDiscount = $this->getRequest()->getParam('id');
        $_SESSION['id_discount'] = $idDiscount;

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Exam_Discount::Parent');
        $resultPage->getConfig()->getTitle()->prepend(__('Discount For Product'));
        return $resultPage;
    }
}
