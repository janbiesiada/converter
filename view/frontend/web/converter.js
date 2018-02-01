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
            this.submitBtn = this.convertForm.find(this.options.submitBtn)[0];
            this.resultArea = $(this.options.resultArea);
            this.input = $(this.options.inputSelector);
            this.convertForm.on('submit', $.proxy(function () {
                event.preventDefault();
                this._onSubmit();
            }, this));
        },


        _onSubmit: function (e) {

            $.getJSON(this.options.url, {}, $.proxy(function (data) {
                var output;
                if (data.code == 200) {
                    var rubValue = this.input.val() || 0;
                    var plnValue = rubValue * data.rate;
                    output = rubValue + " RUB = " + plnValue + " PLN";
                } else {
                    output = data.message;
                }
                this.resultArea.html(output)
                this.resultArea.parent().show();

            }, this));
        },


    });

    return $.mage.converter;
});
