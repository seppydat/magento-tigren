<?php
namespace Exam\Testimonial\Block\Adminhtml\Code\Edit;

use Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{
    /**
     * @return $this
     */
    protected function _prepareForm()
    {

        $model = $this->_coreRegistry->registry('customer');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id'    => 'edit_form',
                    'action' => $this->getData('action'),
                    'method' => 'post',
                    'enctype' => 'multipart/form-data'
                ]
            ]
        );
        $form->setHtmlIdPrefix('customer_');
        $form->setFieldNameSuffix('customer');
        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Customer')]
        );

        if ($model->getId()) {
            $fieldset->addField(
                'entity_id',
                'hidden',
                ['name' => 'entity_id']
            );
        }
        $fieldset->addField(
            'firstname',
            'text',
            [
                'name'      => 'firstname',
                'label'     => __('First Name'),
                'title' => __('Firstname'),
                'required' => true
            ]
        );
        $fieldset->addField(
            'lastname',
            'text',
            [
                'name'      => 'lastname',
                'label'     => __('Last Name'),
                'title' => __('Lastname'),
                'required' => true
            ]
        );
//        $fieldset->addField(
//            'profile_img',
//            'file',
//            array(
//                'name'      => 'profile_img',
//                'label'     => __('Image'),
//                'title' => __('Image'),
//            )
//        );
        $fieldset->addField(
            'email',
            'text',
            [
                'name'      => 'email',
                'label'     => __('Email'),
                'title' => __('Email'),
            ]
        );
//        $fieldset->addField('gender',
//            'radio',
//            [
//                'name'      => 'gender',
//                'label'   => 'Gender',
//                'required'  => false
//            ]);
        $form->setUseContainer(true);
        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
