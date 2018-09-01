/**
 * @api
 */
define([
    'jquery',
    'jquery/ui',
    'mage/translate'
], function ($) {
    'use strict';


    $.widget('mage.converter', {
        options: {
            selectClass: 'selected',
            submitBtn: 'button[type="submit"]',
            isExpandable: null
        },

        /** @inheritdoc */
        _create: function () {
            this.convertForm = $(this.options.formSelector);
            this.resultArea = $(this.options.resultArea);
            this.input = $(this.options.inputSelector);
            this.convertForm.on('submit', $.proxy(function () {
                event.preventDefault();
                this._onSubmit();
            }, this));
        },


        _onSubmit: function (e) {

            $.ajax({
                url: this.options.url,
                type: 'GET',
                dataType: 'json',
                data: {},
                success: $.proxy(this._onSuccess, this),
                error: $.proxy(this._onError, this),
                statusCode: {
                    500: function() {
                        $.proxy(this._onError, this);
                    }
                }
            });
        },

        _onError: function (response) {
            this.setMessage(response.responseJSON.message);
        },

        _onSuccess: function (response) {
            if (!response.error) {
                var rubValue = this.input.val() || 0;
                var plnValue = rubValue * response.rate;
                this.setMessage(rubValue + " RUB = " + plnValue + " PLN")
            } else {
                this.setMessage(response.message);
            }
        },

        setMessage: function (output) {
            this.resultArea.html(output)
            this.resultArea.parent().show();
        }


    });

    return $.mage.converter;
});
