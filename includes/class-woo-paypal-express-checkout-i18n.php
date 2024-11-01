<?php

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Pal_Express_Checkout_Woo
 * @subpackage Pal_Express_Checkout_Woo/includes
 * @author     palmoduledev <palmoduledev@gmail.com>
 */
class Pal_Express_Checkout_Woo_i18n {

    /**
     * @since    1.0.0
     */
    public function load_plugin_textdomain() {

        load_plugin_textdomain(
                'woo-paypal-express-checkout', false, dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }

}
