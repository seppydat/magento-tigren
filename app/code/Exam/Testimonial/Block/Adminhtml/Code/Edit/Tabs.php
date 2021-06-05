<?php
namespace Exam\Testimonial\Block\Adminhtml\Code\Edit;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

class Tabs extends WidgetTabs
{
    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('customer_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Customer Information'));
    }

    /**
     * @return $this
     */
    protected function _beforeToHtml()
    {

        $this->addTab(
            'customer_info',
            [
                'label' => __('Customer'),
                'title' => __('Customer'),
//                'content' => $this->getLayout()->createBlock(
//                    'Exam\Testimonial\Block\Adminhtml\Code\Edit.php\Form'
//                )->toHtml(),
                'active' => true
            ]
        );

        return parent::_beforeToHtml();
    }
}
