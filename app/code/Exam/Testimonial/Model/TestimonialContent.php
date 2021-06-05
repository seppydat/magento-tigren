<?php
namespace Exam\Testimonial\Model;

use Magento\Framework\Model\AbstractModel;

class TestimonialContent extends AbstractModel{
    public function _construct(){
        $this->_init("Exam\Testimonial\Model\ResourceModel\TestimonialContent");
    }
}
