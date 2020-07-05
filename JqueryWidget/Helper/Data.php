<?php

namespace Excellence\JqueryWidget\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /** 
     * @var \Magento\Framework\App\Config\ScopeConfigInterface 
     */
    protected $scopeConfig;

    /** 
     * Data constructor 
     * @param \Magento\Framework\App\Helper\Context $context 
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig 
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
    }

    /** 
     * @return $telephoneConfig 
     */
    public function getBannerConfig()
    {
        $BannerConfig = $this->scopeConfig->getValue(
            'helloworld/active_display/my_image_field',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return $BannerConfig;
    }
}