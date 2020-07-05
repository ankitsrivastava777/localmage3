<?php
namespace Excellence\ShippingMessage\Controller\Fetch;
use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;
    protected $_helper;
    protected $request;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Excellence\ShippingMessage\Helper\Data $helper
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_helper = $helper;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {  
        $post = $this->getRequest()->getPostValue();
        // echo "221212";
        // print_r($post['countryCode']);
        $countryCode = $post['countryCode'];
        $data = $this->_helper->getCountryData($countryCode);
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData($data);
        return $resultJson;
        // return $this->resultPageFactory->create();
    }
}
