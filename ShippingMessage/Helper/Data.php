<?php

namespace Excellence\ShippingMessage\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Checkout\Model\Session;

class Data extends AbstractHelper
{
   /**
     * @var Magento\Checkout\Model\Session
     */
    protected $_checkoutSession;
    protected $scopeConfig;
    protected $_storeManager;
    const CUSTOM_SHIPPING_MESSAGE = 'testnegative/';

    /**
     * @param Context $context
     * @param Session $session
     */
    public function __construct(
        Context $context,
        Session $session,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->_checkoutSession = $session;
        $this->_cart = $cart;
        $this->_storeManager = $storeManager;
    }

    // public function getTotalMessage()
    // {
    //     $quote = $this->_checkoutSession->getQuote();

    //     if ($quote->getSubtotal() < 135) {
    //       return __('Increase your cart value to $135 and enjoy free shipping.');
    //     }
    //     return false;
    // }
    // function To Get config Value 
    public function getConfigValue($code)
	{   
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        return $objectManager->create('\Magento\Framework\App\Config\ScopeConfigInterface')->getValue(self::CUSTOM_SHIPPING_MESSAGE.'general/'. $code, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    public function getInternationalSkuConfigVal($code)
	{   
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        return $objectManager->create('\Magento\Framework\App\Config\ScopeConfigInterface')->getValue(self::CUSTOM_SHIPPING_MESSAGE.'international_cartrule/'. $code, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
    function getExcludedSKu(){
        $Enable = $this->getInternationalSkuConfigVal('enable');
        if($Enable){
            $excludedSkus = explode(',', $this->getInternationalSkuConfigVal('sku'));
            return $excludedSkus;
        }else{
            return false;
        }
    }
    function checkSkuValid(){
        $sku = $this->getExcludedSKu();
        if($sku && count($sku) > 0){
            $cart = $this->_cart;
            $countyrId = $cart->getQuote()->getShippingAddress()->getCountry();
            $itemsVisible = $cart->getQuote()->getAllVisibleItems();
            foreach($itemsVisible as $item) {
                $itemSku = $item->getSku();
                if((in_array($itemSku, $sku)) && ($countyrId != 'US')){
                    return true;
                    exit;
                }else{
                    return false;
                }        
            }
        }else{
            return false;
        } 
    }
    function getCountryData($CountryId){
        $sku = $this->getExcludedSKu();
        if($sku && count($sku) > 0){
            $cart = $this->_cart;
            $countyrId = $CountryId;
            $itemsVisible = $cart->getQuote()->getAllVisibleItems();
            foreach($itemsVisible as $item) {
                $itemSku = $item->getSku();
                if((in_array($itemSku, $sku)) && ($countyrId != 'US')){
                    return true;
                    exit;
                }else{
                    return false;
                }        
            }
        }else{
            return false;
        }
    }
    function getShippingMessage(){
        if($this->getInternationalSkuConfigVal('enable')){
            // die('jnjnjnjn');
            return $this->getInternationalSkuConfigVal('shippingmessage');
        }
    }
    function getBaseUrl(){
        return $this->_storeManager->getStore()->getBaseUrl();
    }
}