(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

/*
 * This file is part of Kabooodle.
 * Copyright (c) 2017. Jacob Toolson <jake@kabooodle.com>
 */

new Vue({
    el: '#merchant_listings_index',
    data: {
        actions: {
            deleting: false
        }
    },
    methods: {

        /**
         *
         * @param endpoint
         * @param listingId
         * @param event
         */
        deleteListingItem: function deleteListingItem(endpoint, listingId, event) {
            var $el = $(event.target);

            var successCb = function successCb($noty, response) {
                $el.closest('tr[data-id="' + listingId + '"]').remove();
            };

            var notyOptions = {
                text: 'This cannot be undone, are you sure?'
            };

            this.deleteListing(endpoint, successCb, notyOptions);
        },


        /**
         * Delete listing only from facebook.
         *
         * @param {string} endpoint
         * @param {integer} id
         * @param {string} type
         * @param {object} e
         */
        deleteFacebookListing: function deleteFacebookListing(endpoint, id, e) {
            var successCb = function successCb($noty, response) {
                $(e.target).closest('tr').replaceWith($(response.body.data.html));
            };

            var notyOptions = {
                text: 'This will queue the listing for removal from Facebook. This cannot be undone, are you sure?'
            };

            this.deleteListing(endpoint, successCb, notyOptions);
        },


        /**
         *
         * @param endpoint
         * @param successCb
         * @param notyOptions
         */
        deleteListing: function deleteListing(endpoint, successCb, notyOptions) {
            var _this = this;

            confirmModal(function ($noty) {
                _this.actions.deleting = true;
                $noty.$buttons.find('.btn').addClass('disabled').prop('disabled', true);
                _this.$http.delete(endpoint).then(function (response) {
                    notify({
                        type: 'success',
                        text: response.body.data.msg
                    });
                    if (successCb instanceof Function) {
                        successCb($noty, response);
                    }
                }, function (response) {
                    notify({
                        text: response.body.data.msg
                    });
                }).finally(function () {
                    _this.actions.deleting = false;
                    $noty.close();
                });
            }, null, notyOptions);
        }
    }
});

},{}]},{},[1]);

//# sourceMappingURL=listing-index-merchant.js.map
