<?php
namespace Exam\Discount\Plugin;

class Product
{
    protected $isLoggedIn;

    public function __construct(
        \Magento\Customer\Model\Session $session
    ) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $httpContext=$objectManager->get('Magento\Framework\App\Http\Context');
        $this->isLoggedIn=$httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
    }

    public function afterIsSaleable(\Magento\Catalog\Model\Product $product)
    {

        if($this->isLoggedIn){
            return true;
        } else {
            return false;
        }
    }

    function afterToHtml(\Magento\Catalog\Pricing\Render\FinalPriceBox $subject, $result)
    {
        if ($this->isLoggedIn) {
            return $result;
        } else {
            return '<p style="font-weight: bold; color: red" >Please Sign In</p>';
        }
    }
}
