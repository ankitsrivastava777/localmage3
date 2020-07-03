<?php
namespace Excellence\ShippingNew\Block\Adminhtml;
class Ship extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
		
        $this->_controller = 'adminhtml_ship';/*block grid.php directory*/
        $this->_blockGroup = 'Excellence_ShippingNew';
        $this->_headerText = __('Ship');
        $this->_addButtonLabel = __('Add New Entry'); 
        parent::_construct();
		
    }
}
