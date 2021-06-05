<?php
namespace Exam\Testimonial\Model\ResourceModel\TestimonialContent;

use Exam\Testimonial\Model\ResourceModel\TestimonialContent;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection{
    public function _construct(){
        $this->_init(\Exam\Testimonial\Model\TestimonialContent::class, TestimonialContent::class);
    }
}
