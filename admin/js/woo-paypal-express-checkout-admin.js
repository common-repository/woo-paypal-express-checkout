(function ($) {
    'use strict';
    $(window).load(function () {
        $('#woocommerce_pal_express_checkout_sandbox').change(function () {
            var sandbox = jQuery('#woocommerce_pal_express_checkout_rest_client_id_sandbox, #woocommerce_pal_express_checkout_rest_secret_id_sandbox').closest('tr');
            var production = jQuery('#woocommerce_pal_express_checkout_rest_client_id_live, #woocommerce_pal_express_checkout_rest_secret_id_live').closest('tr');
            if ($(this).is(':checked')) {
                sandbox.show();
                production.hide();
                jQuery('#woocommerce_pal_express_checkout_sandbox_api_credentials').show();
                jQuery('#woocommerce_pal_express_checkout_api_credentials').hide();
            } else {
                sandbox.hide();
                jQuery('#woocommerce_pal_express_checkout_api_credentials').show();
                jQuery('#woocommerce_pal_express_checkout_sandbox_api_credentials').hide();
                production.show();
            }
        }).change();
    });
})(jQuery);
