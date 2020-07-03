<?php
/**
 * Copyright © 2015 Excellence. All rights reserved.
 */
namespace Excellence\ShippingNew\Model\ResourceModel;

/**
 * Ship resource
 */
class Ship extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('shippingnew_ship', 'id');
    }

  
}
