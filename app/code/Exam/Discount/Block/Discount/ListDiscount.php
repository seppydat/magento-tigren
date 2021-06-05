<?php
namespace Exam\Discount\Block\Discount;

use Magento\Framework\View\Element\Template;

class ListDiscount extends Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\ResourceConnection $Resource
    ) {
        $this->_resource = $Resource;
        parent::__construct($context);
    }
}
