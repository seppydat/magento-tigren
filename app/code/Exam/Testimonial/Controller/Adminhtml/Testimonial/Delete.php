<?php
namespace Exam\Testimonial\Controller\Adminhtml\Testimonial;

use Exam\Testimonial\Model\TestimonialContent as Content;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;

class Delete extends Action implements HttpGetActionInterface
{
    public function __construct(Context $context)
    {
        parent::__construct($context);

        die("hduisada");
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        if (!($contact = $this->_objectManager->create(Content::class)->load($id))) {
            $this->messageManager->addError(__('Unable to proceed. Please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index');
        }
        var_dump($contact);
        die();
        try{
            $contact->delete();
            $this->messageManager->addSuccess(__('Your contact has been deleted !'));
        } catch (Exception $e) {
            $this->messageManager->addError(__('Error while trying to delete contact: '));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index');
    }

    protected function _isAllowed()
    {
        return true;
    }
}
