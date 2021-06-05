<?php
namespace Exam\Testimonial\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class TestimonialContent extends AbstractDb{
    public function _construct(){
        $this->_init('testimonial_content', 'id');
    }
}
