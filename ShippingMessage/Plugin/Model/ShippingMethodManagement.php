<?php
namespace Excellence\ShippingMessage\Plugin\Model;
    
class ShippingMethodManagement {

    protected $dataHelper;

    public function __construct(
        
        \Excellence\ShippingMessage\Helper\Data $dataHelper
        
    ) {  
        $this->dataHelper = $dataHelper;
    }
    public function afterEstimateByExtendedAddress($output)
    {
        return $this->filterOutput($output);
    }
    public function filterOutput($output)
    {
        $helper = $this->dataHelper->checkSkuValid();
        if ($helper) {
            return false;
        }
        return $output;
    }
}
