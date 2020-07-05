<?php
namespace Excellence\ShippingMessage\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Excellence\ShippingMessage\Helper\Data;

class ConfigProvider implements ConfigProviderInterface
{
  protected $_helper;

  public function __construct(Data $helper)
  {
    $this->_helper = $helper;
  }

  public function getConfig()
  {
    $config = [];
    $config['shippingmessage'] = $this->_helper->getShippingMessage();
    return $config;
  }
}