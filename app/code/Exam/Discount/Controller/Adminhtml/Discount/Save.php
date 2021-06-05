<?php
namespace Exam\Discount\Controller\Adminhtml\Discount;

use Exam\Discount\Model\CustomerGroup\CustomerGroupFactory;
use Exam\Discount\Model\CustomerGroup\ResourceModel\CustomerGroup\CollectionFactory;

class Save extends \Magento\Backend\App\Action
{
    protected $_collectionCustomerGroup;
    protected $_resultPageFactory;
    protected $_contentFactory;
    protected $_messageManager;
    protected $_customerGroupFactory;

    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\App\Action\Context $context,
        \Exam\Discount\Model\Discount\DiscountFactory $contentFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        CustomerGroupFactory $customerGroup,
        CollectionFactory $collectionCustomerGroup,
        array $data = []
    )
    {
        $this->_collectionCustomerGroup = $collectionCustomerGroup;
        $this->_customerGroupFactory = $customerGroup;
        $this->_messageManager = $messageManager;
        $this->_contentFactory = $contentFactory;
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context,$data);
    }


    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $model = $this->_contentFactory->create();
        $modelCustomerGroup = $this->_customerGroupFactory->create();
        $collectionCustomerGroup = $this->_collectionCustomerGroup->create();

        $valueModelDiscount = $this->getRequest()->getPostValue();
        $valueCustomerGroup = $valueModelDiscount['id_customer_group'];

        unset($valueModelDiscount['id_customer_group']);

        $today = date('Y/m/d h:i:s');
        $valueModelDiscount['create_at'] = $today;

        $dataDiscount = [
            'discount_amount' => $valueModelDiscount['discount_amount'],
            'name' => $valueModelDiscount['name'],
            'priority' => $valueModelDiscount['priority'],
            'active' => $valueModelDiscount['active'],
            'start_time' => $valueModelDiscount['start_time'],
            'end_time' => $valueModelDiscount['end_time'],
            'create_at' => $valueModelDiscount['create_at']
        ];

        if (!empty($valueModelDiscount['id']))
        {
            $model->load($valueModelDiscount['id']);
            $model->addData($dataDiscount);
            $model->save();

            //delete old select customer group
            $idMultiSelect = $collectionCustomerGroup->getIdByDiscount($valueModelDiscount['id']);

            foreach ($idMultiSelect as $value) {
                $modelCustomerGroup->load($value)->delete();
            }

            // data multiselect new
            foreach ($valueCustomerGroup as $value) {
                $modelCustomerGroup = $this->_customerGroupFactory->create();
                $data = [
                    'id_discount' => $valueModelDiscount['id'],
                    'id_customer_group' => $value,
                    'create_at' => $today
                ];
                $modelCustomerGroup->addData($data)->save();
            }
            $message = 'Đã sửa thành công';
            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('discount_admin/discount/edit', ['id' => $model->getId()]);
                return;
            }
            $this->_messageManager->addSuccessMessage($message);
            return $this->_redirect('discount_admin/discount/view', [$resultPage]);
        } else {
            try {
                $model->addData($dataDiscount)->save();

                $idDiscount = $model->getData('id');

                foreach ($valueCustomerGroup as $value) {
                    $modelCustomerGroup = $this->_customerGroupFactory->create();
                    $data = [
                        'id_discount' => $idDiscount,
                        'id_customer_group' => $value,
                        'create_at' => $today
                    ];
                    $modelCustomerGroup->addData($data)->save();
                }
                $message = 'Đã thêm thành công';
                $this->_messageManager->addSuccessMessage($message);
                return $this->_redirect('discount_admin/discount/view', [$resultPage]);
            } catch (\Exception $e) {
                $this->_messageManager->addErrorMessage($e);
                return $this->_redirect('discount_admin/discount/view', [$resultPage]);
            }
        }
    }
}
