<?php
declare(strict_types=1);

namespace Excellence\Test\Block\Index;

use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;

class Index extends \Magento\Framework\View\Element\Template
{

    protected $_ShippingFactory;
    protected $_code = 'customshipping';

    protected $_isFixed = true;

    private $rateResultFactory;

    private $rateMethodFactory;

        /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory
     * @param \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory
     * @param array $data
     */

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        \Magento\Framework\View\Element\Template\Context $context,
        \Excellence\ShippingMethodNewCustom\Model\ResourceModel\Shipping\CollectionFactory $shippingFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_shippingFactory = $shippingFactory;

        $this->rateResultFactory = $rateResultFactory;
        $this->rateMethodFactory = $rateMethodFactory;

    }

    public function test()
    {
        $test = $this->_shippingFactory->create();
        echo "<pre>";        print_r($test->getData());

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $cart = $objectManager->get('\Magento\Checkout\Model\Cart');
        $items = $cart->getQuote()->getAllItems();

        $weight = 0;
        foreach ($items as $item) {
            $weight += ($item->getWeight() * $item->getQty());
        }

        if ($weight) {
            /** @var \Magento\Shipping\Model\Rate\Result $result */
            $result = $this->rateResultFactory->create();
            print_r($result);

            /** @var \Magento\Quote\Model\Quote\Address\RateResult\Method $method */
            $method = $this->rateMethodFactory->create();

            $method->setCarrier($this->_code);
            $method->setCarrierTitle($this->getConfigData('title'));
print_r($method->setCarrierTitle($this->getConfigData('title'))); exit;
            $method->setMethod($this->_code);
            $method->setMethodTitle($this->getConfigData('name'));

            $shippingCost = (float) $this->getConfigData('shipping_cost');
            $weightCost = (float) $this->getConfigData('weight');

            $cost = $weight;
            $realCost = $cost * $shippingCost;
            $method->setPrice($realCost);

            $method->setCost($realCost);

            $result->append($method);
            // return $result;
        }

    }

}

