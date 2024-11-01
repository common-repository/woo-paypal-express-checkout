<?php

/**
 * The plugin bootstrap file
 * @link              https://profiles.wordpress.org/palmoduledev
 * @since             1.0.0
 * @package           Pal_Express_Checkout_Woo
 *
 * @wordpress-plugin
 * Plugin Name:       PayPal Express Checkout For Woo
 * Plugin URI:        https://profiles.wordpress.org/palmoduledev#content-plugins
 * Description:       Express Checkout for WooCommerce. Develop by Official PayPal Partner.
 * Version:           1.0.2
 * Author:            palmoduledev
 * Author URI:        https://profiles.wordpress.org/palmoduledev
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-paypal-express-checkout
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
if (!defined('PAL_EXPRESS_CHECKOUT_WOO_PLUGIN_DIR')) {
    define('PAL_EXPRESS_CHECKOUT_WOO_PLUGIN_DIR', untrailingslashit(dirname(__FILE__)));
}
if (!defined('PAL_EXPRESS_CHECKOUT_WOO_ASSET_URL')) {
    define('PAL_EXPRESS_CHECKOUT_WOO_ASSET_URL', untrailingslashit(plugin_dir_url(__FILE__)));
}

define( 'PAL_EXPRESS_CHECKOUT_WOO', '1.0.2' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-paypal-express-checkout-activator.php
 */
function activate_pal_express_checkout_woo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-paypal-express-checkout-activator.php';
	Pal_Express_Checkout_Woo_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-paypal-express-checkout-deactivator.php
 */
function deactivate_pal_express_checkout_woo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-paypal-express-checkout-deactivator.php';
	Pal_Express_Checkout_Woo_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pal_express_checkout_woo' );
register_deactivation_hook( __FILE__, 'deactivate_pal_express_checkout_woo' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woo-paypal-express-checkout.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pal_express_checkout_woo() {

	$plugin = new Pal_Express_Checkout_Woo();
	$plugin->run();

}
run_pal_express_checkout_woo();
