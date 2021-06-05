<?php
namespace Exam\Testimonial\Block;

use Magento\Framework\View\Element\Template;

class TestimonialShowAll extends Template
{
    protected $_testimonialFactory;
    protected $_resource;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\ResourceConnection $Resource,
        \Exam\Testimonial\Model\TestimonialContentFactory $TestimonialFactory
    ) {
        $this->_resource = $Resource;
        $this->_testimonialFactory = $TestimonialFactory;
        parent::__construct($context);
    }

    public function getAllDataTestimonial()
    {
        $collection = $this->_testimonialFactory->create()->getCollection();

        $tableCustomer = $this->_resource->getTableName('customer_entity');

        $collection->getSelect()->joinLeft(
            ['customer' => $tableCustomer],
            "main_table.id_customer = customer.entity_id",
            [
                'first_name' => 'customer.firstname',
                'last_name' => 'customer.lastname',
                'customer_email' => 'customer.email',
                'customer_img' => 'main_table.profile_img',
                'content' => 'main_table.content',
                'rating' => 'main_table.rating',
                'create_at' => 'main_table.create_at',
                'update_at' => 'main_table.update_at'
            ]
        )->where('main_table.status = 1');
        $collection->setOrder('update_at', 'desc');

        return $collection;
    }
}
