<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Settings for PayPal Express Checkout.
 */
$require_ssl = '';
if (wc_checkout_is_https() == false) {
    $require_ssl = __('This image requires an SSL host.  Please upload your image to <a target="_blank" href="http://www.sslpic.com">www.sslpic.com</a> and enter the image URL here.', 'paypal-for-woocommerce');
}
return $this->form_fields = array(
    'enabled' => array(
        'title' => __('Enable/Disable', 'woo-paypal-express-checkout'),
        'label' => __('Enable PayPal Express', 'woo-paypal-express-checkout'),
        'type' => 'checkbox',
        'description' => '',
        'default' => 'no'
    ),
    'title' => array(
        'title' => __('Title', 'woo-paypal-express-checkout'),
        'type' => 'text',
        'description' => __('This controls the title which the user sees during checkout.', 'woo-paypal-express-checkout'),
        'default' => __('PayPal Express', 'woo-paypal-express-checkout'),
        'desc_tip' => true,
    ),
    'description' => array(
        'title' => __('Description', 'woo-paypal-express-checkout'),
        'type' => 'textarea',
        'description' => __('This controls the description which the user sees during checkout.', 'woo-paypal-express-checkout'),
        'default' => __("Pay via PayPal; you can pay with your credit card if you don't have a PayPal account", 'woo-paypal-express-checkout'),
        'desc_tip' => true,
    ),
    'account_settings' => array(
        'title' => __('Account Settings', 'woo-paypal-express-checkout'),
        'type' => 'title',
        'description' => '',
    ),
    'sandbox' => array(
        'title' => __('Sandbox Mode', 'woo-paypal-express-checkout'),
        'type' => 'checkbox',
        'label' => __('Enable PayPal Sandbox Mode', 'woo-paypal-express-checkout'),
        'default' => 'yes',
        'description' => sprintf(__('Place the payment gateway in development mode. Sign up for a developer account <a href="%s" target="_blank">here</a>', 'woo-paypal-express-checkout'), 'https://developer.paypal.com/'),
    ),
    'rest_client_id_sandbox' => array(
        'title' => __('Sandbox Client ID', 'woo-paypal-express-checkout'),
        'type' => 'password',
        'description' => 'Enter your Sandbox PayPal Rest API Client ID',
        'default' => ''
    ),
    'rest_secret_id_sandbox' => array(
        'title' => __('Sandbox Secret ID', 'woo-paypal-express-checkout'),
        'type' => 'password',
        'description' => __('Enter your Sandbox PayPal Rest API Secret ID.', 'woo-paypal-express-checkout'),
        'default' => ''
    ),
    'rest_client_id_live' => array(
        'title' => __('Live Client ID', 'woo-paypal-express-checkout'),
        'type' => 'password',
        'description' => 'Enter your PayPal Rest API Client ID',
        'default' => ''
    ),
    'rest_secret_id_live' => array(
        'title' => __('Live Secret ID', 'woo-paypal-express-checkout'),
        'type' => 'password',
        'description' => __('Enter your PayPal Rest API Secret ID.', 'woo-paypal-express-checkout'),
        'default' => ''
    ),
    'display_settings' => array(
        'title' => __('Display Settings (Optional)', 'woo-paypal-express-checkout'),
        'type' => 'title',
        'description' => __('Customize the appearance of Express Checkout in your store.', 'woo-paypal-express-checkout'),
    ),
    'page_style' => array(
        'title' => __('Page Style', 'woo-paypal-express-checkout'),
        'type' => 'text',
        'description' => __('Optionally enter the name of the page style you wish to use. These are defined within your PayPal account.', 'woo-paypal-express-checkout'),
        'default' => '',
        'desc_tip' => true,
        'placeholder' => __('Optional', 'woo-paypal-express-checkout'),
    ),
    'brand_name' => array(
        'title' => __('Brand Name', 'woo-paypal-express-checkout'),
        'type' => 'text',
        'description' => __('This controls what users see as the brand / company name on PayPal review pages.', 'woo-paypal-express-checkout'),
        'default' => __(get_bloginfo('name'), 'woo-paypal-express-checkout'),
        'desc_tip' => true,
    ),
    'checkout_logo' => array(
        'title' => __('PayPal Checkout Logo Image(190x60)', 'woo-paypal-express-checkout'),
        'type' => 'text',
        'description' => __('This controls what users see as the logo on PayPal review pages. ', 'woo-paypal-express-checkout') . $require_ssl,
        'default' => '',
        'desc_tip' => true,
        'placeholder' => __('Optional', 'woo-paypal-express-checkout'),
    ),
    'checkout_logo_hdrimg' => array(
        'title' => __('Header Image (750x90)', 'woo-paypal-express-checkout'),
        'type' => 'text',
        'description' => __('This controls what users see as the header banner on PayPal review pages. ', 'woo-paypal-express-checkout') . $require_ssl,
        'default' => '',
        'desc_tip' => true,
        'placeholder' => __('Optional', 'woo-paypal-express-checkout'),
    ),
    'show_on_cart' => array(
        'title' => __('Cart Page', 'woo-paypal-express-checkout'),
        'label' => __('Show Express Checkout button on shopping cart page.', 'woo-paypal-express-checkout'),
        'type' => 'checkbox',
        'default' => 'yes'
    ),
    'button_position' => array(
        'title' => __('Cart Button Position', 'woo-paypal-express-checkout'),
        'label' => __('Where to display PayPal Express Checkout button(s).', 'woo-paypal-express-checkout'),
        'class' => 'wc-enhanced-select',
        'description' => __('Set where to display the PayPal Express Checkout button(s).'),
        'type' => 'select',
        'options' => array(
            'top' => 'At the top, above the shopping cart details.',
            'bottom' => 'At the bottom, below the shopping cart details.',
            'both' => 'Both at the top and bottom, above and below the shopping cart details.'
        ),
        'default' => 'bottom',
        'desc_tip' => true,
    ),
    'show_on_product_page' => array(
        'title' => __('Product Page', 'woo-paypal-express-checkout'),
        'type' => 'checkbox',
        'label' => __('Show the Express Checkout button on product detail pages.', 'woo-paypal-express-checkout'),
        'default' => 'no',
        'description' => sprintf(__('Allows customers to checkout using PayPal directly from a product page.')),
        'desc_tip' => false,
    ),
    'paypal_account_optional' => array(
        'title' => __('PayPal Account Optional', 'woo-paypal-express-checkout'),
        'type' => 'checkbox',
        'label' => __('Allow customers to checkout without a PayPal account using their credit card.', 'woo-paypal-express-checkout'),
        'default' => 'no',
        'description' => __('PayPal Account Optional must be turned on in your PayPal account profile under Website Preferences.', 'woo-paypal-express-checkout'),
        'desc_tip' => true,
    ),
    'landing_page' => array(
        'title' => __('Landing Page', 'woo-paypal-express-checkout'),
        'type' => 'select',
        'class' => 'wc-enhanced-select',
        'description' => __('Type of PayPal page to display.', 'woo-paypal-express-checkout'),
        'default' => 'Login',
        'desc_tip' => true,
        'options' => array(
            'Billing' => _x('Billing (Non-PayPal account)', 'Type of PayPal page', 'woo-paypal-express-checkout'),
            'Login' => _x('Login (PayPal account login)', 'Type of PayPal page', 'woo-paypal-express-checkout'),
        ),
    ),
    'checkout_skip_text' => array(
        'title' => __('Express Checkout Message', 'woo-paypal-express-checkout'),
        'type' => 'text',
        'description' => __('This message will be displayed next to the PayPal Express Checkout button at the top of the checkout page.'),
        'default' => __('Skip the checkout form and pay faster with PayPal!', 'woo-paypal-express-checkout'),
        'desc_tip' => true,
    ),
    'button_styles' => array(
        'title' => __('Express Checkout Custom Button Styles', 'woo-paypal-express-checkout'),
        'type' => 'title',
        'description' => 'Customize your PayPal button with colors, sizes and shapes.',
    ),
    'button_size' => array(
        'title' => __('Button Size', 'woo-paypal-express-checkout'),
        'type' => 'select',
        'class' => 'wc-enhanced-select',
        'description' => __('Type of PayPal Button Size (small | medium | responsive).', 'woo-paypal-express-checkout'),
        'default' => 'small',
        'desc_tip' => true,
        'options' => array(
            'small' => __('Small', 'woo-paypal-express-checkout'),
            'medium' => __('Medium', 'woo-paypal-express-checkout'),
            'responsive' => __('Responsive', 'woo-paypal-express-checkout'),
        ),
    ),
    'button_shape' => array(
        'title' => __('Button Shape', 'woo-paypal-express-checkout'),
        'type' => 'select',
        'class' => 'wc-enhanced-select',
        'description' => __('Type of PayPal Button Shape (pill | rect).', 'woo-paypal-express-checkout'),
        'default' => 'pill',
        'desc_tip' => true,
        'options' => array(
            'pill' => __('Pill', 'woo-paypal-express-checkout'),
            'rect' => __('Rect', 'woo-paypal-express-checkout')
        ),
    ),
    'button_color' => array(
        'title' => __('Button Color', 'woo-paypal-express-checkout'),
        'type' => 'select',
        'class' => 'wc-enhanced-select',
        'description' => __('Type of PayPal Button Color (gold | blue | silver).', 'woo-paypal-express-checkout'),
        'default' => 'gold',
        'desc_tip' => true,
        'options' => array(
            'gold' => __('Gold', 'woo-paypal-express-checkout'),
            'blue' => __('Blue', 'woo-paypal-express-checkout'),
            'silver' => __('Silver', 'woo-paypal-express-checkout')
        ),
    ),
    'advanced' => array(
        'title' => __('Advanced Settings (Optional)', 'woo-paypal-express-checkout'),
        'type' => 'title',
        'description' => '',
    ),
    'invoice_id_prefix' => array(
        'title' => __('Invoice ID Prefix', 'woo-paypal-express-checkout'),
        'type' => 'text',
        'description' => __('Add a prefix to the invoice ID sent to PayPal. This can resolve duplicate invoice problems when working with multiple websites on the same PayPal account.', 'woo-paypal-express-checkout'),
        'desc_tip' => true,
        'default' => 'WC-EC'
    ),
//    'enable_tokenized_payments' => array(
//        'title' => __('Enable Tokenized Payments', 'woo-paypal-express-checkout'),
//        'label' => __('Enable Tokenized Payments', 'woo-paypal-express-checkout'),
//        'type' => 'checkbox',
//        'description' => __('Allow buyers to securely save payment details to their account for quick checkout / auto-ship orders in the future.', 'woo-paypal-express-checkout'),
//        'default' => 'no',
//        'class' => 'enable_tokenized_payments'
//    ),
//    'skip_final_review' => array(
//        'title' => __('Skip Final Review', 'woo-paypal-express-checkout'),
//        'label' => __('Enables the option to skip the final review page.', 'woo-paypal-express-checkout'),
//        'description' => __('By default, users will be returned from PayPal and presented with a final review page which includes shipping and tax in the order details.  Enable this option to eliminate this page in the checkout process.'),
//        'type' => 'checkbox',
//        'default' => 'no'
//    ),
    'paymentaction' => array(
        'title' => __('Payment Action', 'woo-paypal-express-checkout'),
        'type' => 'select',
        'class' => 'wc-enhanced-select',
        'description' => __('Choose whether you wish to capture funds immediately or authorize payment only.', 'woo-paypal-express-checkout'),
        'default' => 'sale',
        'desc_tip' => true,
        'options' => array(
            'Sale' => __('Sale', 'woo-paypal-express-checkout'),
            'Authorization' => __('Authorization', 'woo-paypal-express-checkout'),
            'Order' => __('Order', 'woo-paypal-express-checkout')
        ),
    ),
    'debug' => array(
        'title' => __('Debug', 'woo-paypal-express-checkout'),
        'type' => 'checkbox',
        'label' => sprintf(__('Enable logging<code>%s</code>', 'woo-paypal-express-checkout'), version_compare(WC_VERSION, '3.0', '<') ? wc_get_log_file_path('paypal_express') : WC_Log_Handler_File::get_log_file_path('paypal_express')),
        'default' => 'no'
    )
);


