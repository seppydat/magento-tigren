<?php
namespace Exam\Testimonial\Ui\Component\Listing\Column;
use Magento\Catalog\Helper\Image;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class Thumbnail extends Column
{
    protected $storeManager;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storemanager,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->_storeManager = $storemanager;
        $this->urlBuilder = $urlBuilder;
    }

    public function prepareDataSource(array $dataSource)
    {
        $mediaDirectory = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        if (isset($dataSource['data']['items'])) {
            $fieldName = 'profile_img';
            foreach ($dataSource['data']['items'] as & $item) {
                $imageUrl = $item['profile_img'];
                $item['profile_img'] = $imageUrl;
                $item[$fieldName . '_src'] = $imageUrl;
//                $item[$fieldName . '_link'] = $this->urlBuilder->getUrl(
//                    'brand/branddetails/editbrand',
//                    ['id' => $item['id'], 'store' => $this->context->getRequestParam('store')]
//                );
                $item[$fieldName . '_orig_src'] = $imageUrl;
            }
        }
        return $dataSource;
    }
}
