<?php
/**
 * Plugin Name: Conditional Discount for WooCommerce
 * Description: Apply discounts based on specific conditions in WooCommerce.
 * Version: 1.0.0
 * Plugin URI: https://shanto.net/plugins/conditional-discount
 * Author: Riadujjaman Shanto
 * Author URI: https://shanto.net
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt 
 * Text Domain: conditional-discount
 * Domain Path: /i18n/
 * Tags: woocommerce, discount, conditional discount, dynamic pricing
 * Requires Plugins: woocommerce
 */

namespace Shanto\ConditionalDiscount;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if(!class_exists(ConditionalDiscount::class) && is_readable(__DIR__ . '/vendor/autoload.php')){
    require_once __DIR__ . '/vendor/autoload.php';
}

class_exists(ConditionalDiscount::class) && ConditionalDiscount::instance()->init(); 