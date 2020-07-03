<?php
namespace Excellence\ShippingNew\Block\Adminhtml\Ship\Edit\Tab;
class ShippingDetails extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = array()
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
		/* @var $model \Magento\Cms\Model\Page */
        $model = $this->_coreRegistry->registry('shippingnew_ship');
		$isElementDisabled = false;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Shipping Details')));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array('name' => 'id'));
        }

		$fieldset->addField(
            'id',
            'text',
            array(
                'name' => 'id',
                'label' => __('id'),
                'title' => __('id'),
                /*'required' => true,*/
            )
        );
		$fieldset->addField(
            'shipping_price',
            'text',
            array(
                'name' => 'shipping_price',
                'label' => __('shipping price'),
                'title' => __('shipping price'),
                /*'required' => true,*/
            )
        );
		$fieldset->addField(
            'country',
            'text',
            array(
                'name' => 'country',
                'label' => __('country'),
                'title' => __('country'),
                /*'required' => true,*/
            )
        );
		$fieldset->addField(
            'zip_codes',
            'text',
            array(
                'name' => 'zip_codes',
                'label' => __('zip codes'),
                'title' => __('zip codes'),
                /*'required' => true,*/
            )
        );
		$fieldset->addField(
            'max_allowed_price',
            'text',
            array(
                'name' => 'max_allowed_price',
                'label' => __('max allowed price'),
                'title' => __('max allowed price'),
                /*'required' => true,*/
            )
        );
		/*{{CedAddFormField}}*/
        
        if (!$model->getId()) {
            $model->setData('status', $isElementDisabled ? '2' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();   
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Shipping Details');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Shipping Details');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
