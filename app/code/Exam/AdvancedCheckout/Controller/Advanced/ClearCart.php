<?php
namespace Exam\AdvancedCheckout\Controller\Advanced;

use Exception;
use Magento\Checkout\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Quote\Model\Quote\Item;

class ClearCart extends  Action{
    protected $_session;
    protected $_quoteItem;

    function __construct(
        Context $context,
        Session $session,
        Item $quoteItem
    )
    {
        $this->_quoteItem = $quoteItem;
        $this->_session = $session;
        parent::__construct($context);
    }
    public function execute()
    {
        $allItems = $this->_session->getQuote()->getAllVisibleItems();
        $quote_Id = $this->_session->getQuoteId();
        $error = 0;
        foreach ($allItems as $item) {
            $itemId = $item->getItemId();//item id of particular item
            $allItems = $this->_quoteItem->load($itemId);
            try {
                $allItems->delete();
            } catch (Exception $e) {
                $error++;
            }
        }
        if(!empty($quote_Id)){
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            // $quoteModel = $objectManager->create('Magento\Quote\Model\Quote');
            // $quoteModel->delete($quote_Id);
            $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
            $connection = $resource->getConnection();
            $tableName = $resource->getTableName('quote');
            $sql = "DELETE  FROM " . $tableName." WHERE entity_id = ".$quote_Id;
            $connection->query($sql);
        }

        if ($error) {
            $this->messageManager->addErrorMessage("fail ". $error." item");

            echo "error";
        } else {
            echo "success";
        }
    }
}
