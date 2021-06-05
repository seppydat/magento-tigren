<?php
namespace Exam\Discount\Model\Discount\ResourceModel;

use Exam\Discount\Model\Discount\ResourceModel\Discount\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Exam\Discount\Model\CustomerGroup\ResourceModel\CustomerGroup\CollectionFactory as CustomerCollection;

class DataProvider extends AbstractDataProvider
{
    protected $_customerGroup;
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $contentCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $contentCollectionFactory,
        CustomerCollection $customerGroup,
        array $meta = [],
        array $data = []
    ) {
        $this->_customerGroup = $customerGroup->create();
        $this->collection = $contentCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        $this->loadedData = array();
        $CustomerGroup = array();
        foreach ($items as $content) {
            $id = $content->getId();
            $this->loadedData[$id] = $content->getData();
            foreach ($this->_customerGroup->getDataCustomerGroup($id) as $key => $value) {
                $CustomerGroup[$key] = $value;
            }
            $this->loadedData[$id]['id_customer_group'] = $CustomerGroup;
        }
//        var_dump($this->loadedData);
//        die();
        return $this->loadedData;

    }
}
