<?php
namespace Exam\Testimonial\Controller\Adminhtml\Testimonial;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Exam\Testimonial\Model\TestimonialContentFactory;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use PHPUnit\Exception;

class Update extends Action implements HttpGetActionInterface
{

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        TestimonialContentFactory $model
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPostValue();

            $update_time = date('Y/m/d h:i:s');

            $data['status'] = (isset($data['status']))?1:0;

            $data += [
                'update_at' => $update_time
            ];

            $testimonial = $model->create()->load($data['id']);

            try {
                $testimonial->addData($data);
                $testimonial->save();

                return $this->messageManager->addComplexSuccessMessage("oke");
            } catch (Exception $e) {
                return $this->messageManager->addComplexErrorMessage("error");
            }
        }
    }

    public function execute()
    {

    }

    protected function _isAllowed()
    {
        return true;
    }
}
