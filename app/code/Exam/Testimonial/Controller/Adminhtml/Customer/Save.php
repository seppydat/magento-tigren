<?php
namespace Exam\Testimonial\Controller\Adminhtml\Customer;

class Save extends \Magento\Backend\App\Action
{

    protected $_resultPageFactory;
    protected $_customerFactory;
    protected $_messageManager;

    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\App\Action\Context $context,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        array $data = []
    )
    {
        $this->_messageManager = $messageManager;
        $this->_customerFactory = $customerFactory;
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context,$data);
    }


    public function execute()
    {
//        die('oke save');
        $resultPage = $this->_resultPageFactory->create();
        $model = $this->_customerFactory->create();
        $value = $this->getRequest()->getPostValue();
        $valueModel = $value['customer'];

        if (isset($valueModel['entity_id']))
        {
            // move img
//
//            $name_img = "seppy".$_FILES['customer']['name']['profile_img'];
//            $source_img = $_FILES['customer']['tmp_name']['profile_img'];
//            $path_upload = "images/". $name_img;
//
//            if (move_uploaded_file($source_img, $path_upload)) {
//                $valueModel += ['profile_img' => $name_img];
//            }

            // add data to database
            $model->load($valueModel['entity_id']);
            $model->addData($valueModel);
            $model->save();
            $message = 'Đã sửa thành công';
            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('testimonial_admin/customer/edit', ['id' => $model->getId()]);
                return;
            }
            $this->_messageManager->addSuccessMessage($message);
            return $this->_redirect('testimonial_admin/customer/view', [$resultPage]);
        } else {
            die('not find id');
        }
    }
}
