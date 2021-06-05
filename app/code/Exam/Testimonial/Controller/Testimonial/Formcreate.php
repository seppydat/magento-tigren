<?php
declare(strict_types=1);

namespace Exam\Testimonial\Controller\Testimonial;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;

class Formcreate extends Action
{
    public function __construct(
        Context $context
    )
    {
        parent::__construct($context);
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');
        if(!$customerSession->isLoggedIn()) {
            $this->_redirect('customer/account/login');
        }
    }

    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
