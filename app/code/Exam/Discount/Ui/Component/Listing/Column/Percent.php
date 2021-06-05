<?php
namespace Exam\Discount\Ui\Component\Listing\Column;

class Percent extends \Magento\Ui\Component\Listing\Columns\Column
{
    protected $localeCurrency;
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\Locale\CurrencyInterface $localeCurrency,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->localeCurrency = $localeCurrency;
        $this->storeManager = $storeManager;
    }
    public function prepareDataSource(array $dataSource)
    {
        foreach ($dataSource['data']['items'] as & $item) {
            $fieldName = $this->getData('name');
            $item[$fieldName] = $item[$fieldName].'%';
        }
        return $dataSource;
    }
}
