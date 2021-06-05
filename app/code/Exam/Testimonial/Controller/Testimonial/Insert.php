<?php
declare(strict_types=1);

namespace Exam\Testimonial\Controller\Testimonial;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;

class Insert extends Action
{
    protected $_testimonialFactory;

    public function __construct(
        Context $context,
        \Exam\Testimonial\Model\TestimonialContentFactory $contentFactory
    )
    {
        parent::__construct($context);
        $this->_testimonialFactory =  $contentFactory;

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');
        if(!$customerSession->isLoggedIn()) {
            $this->_redirect('customer/account/login');
        }
    }

    public function execute()
    {
        if ($this->getRequest()->isPost()) {
            $post = $this->getRequest()->getPostValue();
            $om = \Magento\Framework\App\ObjectManager::getInstance();
            $customerSession = $om->get('Magento\Customer\Model\Session');
            $customerId = $customerSession->getCustomer()->getId();//get id of customer
            $create_at = date('Y/m/d h:i:s');
            $data = [
                'id_customer' => $customerId,
                'content' => $post['testimonial_content'],
                'rating' => $post['rating'],
                'status' => 1,
                'create_at' => $create_at,
                'update_at' => $create_at
            ];

            $Testimonial = $this->_testimonialFactory->create();
            $Testimonial->addData($data);
            $Testimonial->save();

            return $this->_redirect('testimonial/testimonial/view');
        } else {
            return $this->messageManager->addComplexErrorMessage("error");
        }
    }
}
