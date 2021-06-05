<?php
namespace Exam\Testimonial\Controller\Adminhtml\Testimonial;

use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Backend\App\Action
{
    /** @var \Magento\MediaStorage\Model\File\Uploader $_uploaderFactory */

    protected $_filesystem;
    protected $_uploaderFactory;
    protected $_resultPageFactory;
    protected $_contentFactory;
    protected $_messageManager;

    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\App\Action\Context $context,
        \Exam\Testimonial\Model\TestimonialContentFactory $contentFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        array $data = []
    )
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->_fileSystem = $objectManager->create('\Magento\Framework\Filesystem');
        $this->_messageManager = $messageManager;
        $this->_contentFactory = $contentFactory;
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context,$data);
    }


    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $model = $this->_contentFactory->create();
        $valueModel = $this->getRequest()->getPostValue();

        $today = date('Y/m/d h:i:s');
        $valueModel['update_at'] = $today;

//        $path  = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath(
//            'images/'
//        );
//
        $field = 'profile_img';
//
//        var_dump($valueModel['profile_img']);
//        if (!empty($valueModel[$field]['name'])) {
//            try {
//                $uploader = $this->_uploaderFactory->create(['fileId' => $field]);
//                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
//                $uploader->setFilesDispersion(false);
//                $uploader->setAllowRenameFiles(false);
//                $fileName = $valueModel[$field]['name'];
//                $result = $uploader->save($path, $fileName);
//                $fileName = $result['file'];
//                $valueModel[$field] = $fileName;
//            } catch (\Exception $e) {
//                $this->messageManager->addErrorMessage($e->getMessage());
//            }
//        }
        $valueModel[$field] = $valueModel[$field][0]['url'];
//        var_dump($valueModel);
//        die();
        if (isset($valueModel['id']))
        {
            $model->load($valueModel['id']);
            $model->addData($valueModel);
            $model->save();
            $message = 'Đã sửa thành công';
            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('testimonial_admin/testimonial/edit', ['id' => $model->getId()]);
                return;
            }
            $this->_messageManager->addSuccessMessage($message);
            return $this->_redirect('testimonial_admin/testimonial/view', [$resultPage]);
        } else {
            die('not find id');
        }
    }
}
