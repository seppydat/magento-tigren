<?php

namespace Exam\AdvancedCheckout\Controller\Advanced;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class CheckOrderStatus extends  Action{

    function __construct(
        Context $context
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {

    }
}

