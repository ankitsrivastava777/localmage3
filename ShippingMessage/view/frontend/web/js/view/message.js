define([
    'jquery',
    'ko',
    'uiComponent'
], function($, ko, Component) {
    'use strict';
    // const newLocal = window.checkoutConfig.shippingmessage;
    var show_hide_custom_blockConfig = window.checkoutConfig.shippingmessage;
    console.log('hbhbhbbhbb');
    console.log(show_hide_custom_blockConfig);
    return Component.extend({
        defaults: {
            template: 'Excellence_ShippingMessage/checkout/shipping/shippingmessage.phtml'
        },
        Msg: show_hide_custom_blockConfig
    });
});