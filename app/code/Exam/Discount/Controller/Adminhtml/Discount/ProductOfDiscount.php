<?php

namespace Exam\Discount\Controller\Adminhtml\Discount;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class ProductOfDiscount extends Action
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

        $resultPage = $this->resultPageFactory->create();

        $block = $resultPage->getLayout()->getBlock('product_of_discount');

        $block->setData('id_discount', $idDiscount);

        $resultPage->setActiveMenu('Exam_Discount::Parent');
        $resultPage->getConfig()->getTitle()->prepend(__('Products Of Discount'));
        return $resultPage;
    }
}
