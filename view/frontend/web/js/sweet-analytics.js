define([
    'jquery'
], function ($) {
    'use strict';

    function loadSweetAnalyticsScript(config){
        (function (i, s, o, g, r, a, m) {
            i.sweet=i.sweet||{};
            i.sweet.q=sweet.q||[];
            i.sweet.init=function(e){this.cid=e;};
            i.sweet.track=function(){this.q.push(arguments)};
            a = s.createElement(o);
            m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m);

        })(window, document, 'script', 'https://track.sweetanalytics.com/sweet.min.js', 'sweet');

        // Process page info
        sweet.init(config.trackingId);
    }

    function processOrderData(config){
        var order = config.order;

        // Collect orders data for Sweet Analytics
        if (order) {
            sweet.track('addTransaction', {
                transaction_id: order.transaction_id,
                total: order.total
            });

            // Collect product data for Sweet Analytics
            if (order.products) {
                $.each(order.products, function (index, value) {
                    sweet.track('addItem', value);
                });
            }

            sweet.track('transaction');
        }
    }

    function setupEvents(config){
        /* Add to cart Event */
        $(document).on('ajax:addToCart', function (event, data) {
            var $form = $(data.form),
                $product_id = $form.find('input[name=product]'),
                $formQty = $form.find('input[name=qty]') ,
                $qty = $formQty.length ? $($formQty).val() : 1,
                $options = {},
                $body = $('body');

            var addToCart = {
                item_id: data.sku,
                item_name: data.sku,
                category: 'Unknown',
                price: 0,
                qty: $qty
            };

            sweet.track('addToBasket', addToCart);
        });

        /* Remove from cart Event */
        $(document).on('ajax:removeFromCart', function (event, data) {
            if(data.products) {
                $.each(data.products, function (index, product) {
                    removeProductToCart(product);
                });
            }
        });
    }

    function addProductToCart(product) {

    }

    function removeProductToCart(product) {
        var pid = product.product_sku,
            removefromcart = {
                id: pid
            };

        sweet.track('removeFromBasket', {
            id: product.productSku
        });
    }

    function manipulationOfCart(products, type) {
        var i;

        products = eval('(' + products + ')');

        for (i in products) {
            if (type == 'add') {
                addProductToCart(products[i]);
            } else if (type == 'remove') {
                removeProductToCart(products[i]);
            }
        }
    }

    function pageTracking(config) {
        sweet.track('pageview', { category: config.pageUrl, action: 'view', value: 1 });

    }
    /**
     * @param {Object} config
     */
    return function (config) {
        loadSweetAnalyticsScript(config);
        setupEvents(config);
        processOrderData(config);
        pageTracking(config);
    }
});
