define([
    'uiComponent',
    'jquery',
    'ko'
], function (Component, $, ko) {
    'use strict';

    return Component.extend({
        availableCity: ko.observableArray(window.checkoutConfig.cityData),

        onClick: function () {
            $(document).click('#checkout-shipping-method-load input', function(event) {
                if ($("input[value='customshipping_customshipping']").prop("checked")) {
                    return true;
                } else {
                    return false;

                }
            });
        },

        isVisible: function () {
            return this.onClick();
        }
    });
});