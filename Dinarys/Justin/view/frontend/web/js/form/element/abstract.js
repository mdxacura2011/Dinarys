define([
    'jquery',
    'Magento_Ui/js/form/element/abstract',
], function ($, AbstractField) {
    'use strict';

    return AbstractField.extend({
        initialize: function () {
            this._super();
            this.updateCountry();
            return this;
        },

        updateCountry: function () {
            var response = this.options;
            $(document).click('#checkout-shipping-method-load input', function() {

                var cityObject = $('[name="city"]');

                if ($("input[value='customshipping_customshipping']").prop("checked")) {

                    var cities = JSON.parse(response);
                    if (cityObject.is('input')) {
                        cityObject.replaceWith(function () {
                            var select = $("<select>", {
                                html: $(this).html()
                            });
                            $.each(this.attributes, function (i, attribute) {
                                if(attribute.name == 'class'){
                                    attribute.value = 'select';
                                }
                                    select.attr(attribute.name, attribute.value);
                                });
                                return select;
                            });
                        } else {
                            cityObject.empty();
                        }

                        if (cities != 'undefined' && cities.length > 0) {
                            for (var i = 0; i < cities.length; i++) {
                                var option = $("<option/>", {
                                    value: cities[i].code,
                                    text: cities[i].name
                                });
                                cityObject.append(option);
                            }
                        }
                    } else {
                        if (cityObject.is('select')) {
                            cityObject.replaceWith(function () {
                                var select = $("<input>", {
                                    html: $(this).html()
                                });
                                $.each(this.attributes, function (i, attribute) {
                                    if(attribute.name == 'class'){
                                        attribute.value = 'input';
                                    }
                                    select.attr(attribute.name, attribute.value);
                                });
                                return select;
                            });
                        }
                    }
            });
        },
    });
});