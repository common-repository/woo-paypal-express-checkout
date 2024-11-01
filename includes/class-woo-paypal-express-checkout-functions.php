<?php

function pal_get_posted_card($payment_method) {
    $card_number = isset($_POST[$payment_method . '-card-number']) ? wc_clean($_POST[$payment_method . '-card-number']) : '';
    $card_cvc = isset($_POST[$payment_method . '-card-cvc']) ? wc_clean($_POST[$payment_method . '-card-cvc']) : '';
    $card_expiry = isset($_POST[$payment_method . '-card-expiry']) ? wc_clean($_POST[$payment_method . '-card-expiry']) : '';
    $card_number = str_replace(array(' ', '-'), '', $card_number);
    $card_expiry = array_map('trim', explode('/', $card_expiry));
    $card_exp_month = str_pad($card_expiry[0], 2, "0", STR_PAD_LEFT);
    $card_exp_year = isset($card_expiry[1]) ? $card_expiry[1] : '';
    if (strlen($card_exp_year) == 2) {
        $card_exp_year += 2000;
    }
    $first_four = substr($card_number, 0, 4);
    return (object) array(
                'number' => $card_number,
                'type' => pal_card_type_from_account_number($first_four),
                'cvc' => $card_cvc,
                'exp_month' => $card_exp_month,
                'exp_year' => $card_exp_year,
    );
}

function pal_card_type_from_account_number($account_number) {
    $types = array(
        'visa' => '/^4/',
        'mastercard' => '/^5[1-5]/',
        'amex' => '/^3[47]/',
        'discover' => '/^(6011|65|64[4-9]|622)/',
        'diners' => '/^(36|38|30[0-5])/',
        'jcb' => '/^35/',
        'maestro' => '/^(5018|5020|5038|6304|6759|676[1-3])/',
        'laser' => '/^(6706|6771|6709)/',
    );
    foreach ($types as $type => $pattern) {
        if (1 === preg_match($pattern, $account_number)) {
            return $type;
        }
    }
    return null;
}

function pal_round($price, $order) {
    $precision = 2;
    if (!pal_currency_has_decimals(version_compare(WC_VERSION, '3.0', '<') ? $order->get_order_currency() : $order->get_currency())) {
        $precision = 0;
    }
    return round($price, $precision);
}

function pal_number_format($price) {
    $decimals = 2;
    if (!pal_currency_has_decimals(get_woocommerce_currency())) {
        $decimals = 0;
    }
    return number_format($price, $decimals, '.', '');
}

function pal_currency_has_decimals($currency) {
    if (in_array($currency, array('HUF', 'JPY', 'TWD'))) {
        return false;
    }
    return true;
}

function pal_set_session($key, $value) {
    if (!function_exists('WC')) {
        return false;
    }
    if (sizeof(WC()->session) == 0) {
        return false;
    }
    $pal_session = WC()->session->get('pal_session');
    $pal_session[$key] = $value;
    WC()->session->set('pal_session', $pal_session);
}

function pal_get_session($key) {
    if (!function_exists('WC')) {
        return false;
    }
    if (sizeof(WC()->session) == 0) {
        return false;
    }
    $pal_session = WC()->session->get('pal_session');
    if (!empty($pal_session[$key])) {
        return $pal_session[$key];
    }
    return false;
}

function pal_unset_session($key) {
    if (!function_exists('WC')) {
        return false;
    }
    if (sizeof(WC()->session) == 0) {
        return false;
    }
    $pal_session = WC()->session->get('pal_session');
    if (!empty($pal_session[$key])) {
        unset($pal_session[$key]);
        WC()->session->set('pal_session', $pal_session);
    }
}

function is_pal_express_checkout_ready_to_capture() {
    $paymentID = pal_get_session('paymentID');
    $payerID = pal_get_session('payerID');
    if (!empty($paymentID) && !empty($payerID)) {
        return true;
    } else {
        return false;
    }
}

function pal_maybe_clear_session_data() {
    if (!function_exists('WC')) {
        return false;
    }
    if (sizeof(WC()->session) == 0) {
        return false;
    }
    WC()->session->set('pal_session', '');
}

function pal_get_option($getway_name, $key, $default = false) {
    if (!empty($getway_name)) {
        $gateway_key = 'woocommerce_' . $getway_name . '_settings';
        $setting_value = get_option($gateway_key);
        if (!empty($setting_value)) {
            $value = !empty($setting_value[$key]) ? $setting_value[$key] : $default;
            return $value;
        }
    }
    return false;
}
