<?php

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Pal_Express_Checkout_Woo
 * @subpackage Pal_Express_Checkout_Woo/includes
 * @author     palmoduledev <palmoduledev@gmail.com>
 */
class Pal_Express_Checkout_Woo {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Pal_Express_Checkout_Woo_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {
        if (defined('PLUGIN_VERSION')) {
            $this->version = PAL_EXPRESS_CHECKOUT_WOO;
        } else {
            $this->version = '1.0.2';
        }
        $this->plugin_name = 'woo-paypal-express-checkout';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
        // register API endpoints
        add_action('init', array($this, 'add_endpoint'), 0);
        // handle paypal-ipn-for-wordpress-api endpoint requests
        add_action('parse_request', array($this, 'handle_api_requests'), 0);
        add_action('pal_paypal_payment_api_ipn', array($this, 'pal_paypal_payment_api_ipn'));
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Pal_Express_Checkout_Woo_Loader. Orchestrates the hooks of the plugin.
     * - Pal_Express_Checkout_Woo_i18n. Defines internationalization functionality.
     * - Pal_Express_Checkout_Woo_Admin. Defines all hooks for the admin area.
     * - Pal_Express_Checkout_Woo_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-woo-paypal-express-checkout-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-woo-paypal-express-checkout-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-woo-paypal-express-checkout-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-woo-paypal-express-checkout-functions.php';

        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-woo-paypal-express-checkout-public.php';



        $this->loader = new Pal_Express_Checkout_Woo_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Pal_Express_Checkout_Woo_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale() {

        $plugin_i18n = new Pal_Express_Checkout_Woo_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {

        $plugin_admin = new Pal_Express_Checkout_Woo_Admin($this->get_plugin_name(), $this->get_version());
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        $this->loader->add_action('plugins_loaded', $plugin_admin, 'init_pal_payment_checkout');
        $this->loader->add_filter('woocommerce_payment_gateways', $plugin_admin, 'pal_express_checkout_add_payment_method_class', 9999, 1);
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {

        $plugin_public = new Pal_Express_Checkout_Woo_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Pal_Express_Checkout_Woo_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }

    public function handle_api_requests() {
        global $wp;
        if (isset($_GET['pal_ipn_action']) && $_GET['pal_ipn_action'] == 'ipn') {
            $wp->query_vars['Pal_Express_Checkout_Woo'] = $_GET['pal_ipn_action'];
        }
        if (!empty($wp->query_vars['Pal_Express_Checkout_Woo'])) {
            ob_start();
            $api = strtolower(esc_attr($wp->query_vars['Pal_Express_Checkout_Woo']));
            do_action('pal_paypal_payment_api_' . $api);
            ob_end_clean();
            die('1');
        }
    }

    public function add_endpoint() {
        add_rewrite_endpoint('Pal_Express_Checkout_Woo', EP_ALL);
    }

    public function pal_paypal_payment_api_ipn() {
        require_once( PAL_EXPRESS_CHECKOUT_WOO_PLUGIN_DIR . '/includes/paypal-ipn/class-woo-paypal-express-checkout-paypal-ipn-handler.php' );
        $Pal_Express_Checkout_For_Woo_IPN_Handler_Object = new Pal_Express_Checkout_For_Woo_IPN_Handler();
        $Pal_Express_Checkout_For_Woo_IPN_Handler_Object->check_response();
    }

}
