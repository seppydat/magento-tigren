<?php
namespace Exam\Testimonial\Controller\Adminhtml\Testimonial;
use Magento\Backend\App\Action;
use Exam\Testimonial\Model\ResourceModel\TestimonialContent as Content;

class NewAction extends \Magento\Backend\App\Action
{
    /**
     * Edit A Contact Page
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();

        $contactDatas = $this->getRequest()->getParam('content');
        if(is_array($contactDatas)) {
            $contact = $this->_objectManager->create(Content::class);
            $contact->setData($contactDatas)->save();
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index');
        }
    }
}
