<?php
namespace Excellence\ShippingNew\Block\Adminhtml\Ship\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
		
        parent::_construct();
        $this->setId('checkmodule_ship_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Ship Information'));
    }
}