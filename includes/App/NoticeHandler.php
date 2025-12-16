<?php

namespace Shanto\ConditionalDiscount\App;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class NoticeHandler {
    use \Shanto\ConditionalDiscount\App\Traits\Singleton;
    public function init( ) {
        add_action( 'woocommerce_check_cart_items', [ $this, 'display_user_notice_on_cart_page' ] );
    }

    public function display_user_notice_on_cart_page( ) {
        if ( is_admin() || (defined( 'DOING_AJAX' ) && DOING_AJAX) && (defined( 'REST_REQUEST' ) && REST_REQUEST) || ! is_cart()) {
            return;
        }

        $criteria = get_option( 'cd_conditional_discount_criteria', 'cart_total' );
        // cast option values to numeric types to avoid non-numeric value warnings
        $threshold = (float) get_option( 'cd_conditional_discount_threshold', 100 );
        $discount_type = get_option( 'cd_conditional_discount_type', 'percentage' );
        $discount_amount = (float) get_option( 'cd_conditional_discount_amount', 10 );

        $subtotal = (float) WC()->cart->get_subtotal();
        $item_count = (int) WC()->cart->get_cart_contents_count();
        $currency  = get_woocommerce_currency_symbol();
        $discount_applied = DiscountController::instance()->is_eligible_for_discount();

        // $require_amount = $threshold - $subtotal;
        // $required_product = $threshold - $item_count;


        
        if($discount_type === 'percentage' && $criteria === 'cart_total' && $discount_applied){
            $message = 'Congratulation! You\'ve received ' . $discount_amount . '% Special Discount.';
            echo '<div class="woocommerce-message cd-conditional-discount">' . $message . '</div>';
        }
        
        if($discount_type === 'flat_amount' && $criteria === 'cart_total' && $discount_applied){
            $message = 'Congratulation! You\'ve received ' . $discount_amount . $currency . ' Special Discount.';
            echo '<div class="woocommerce-message cd-conditional-discount">' . $message . '</div>';
        }

        if($discount_type === 'percentage' && $criteria === 'item_count' && $discount_applied){
            $message = 'Congratulation! You\'ve received ' . $discount_amount . '% Special Discount.';
            echo '<div class="woocommerce-message cd-conditional-discount">' . $message . '</div>';
        } 
       
        if($discount_type === 'flat_amount' && $criteria === 'item_count' && $discount_applied){
            $message = 'Congratulation! You\'ve received ' . $discount_amount . $currency . ' Special Discount.';
            echo '<div class="woocommerce-message cd-conditional-discount">' . $message . '</div>';
        }
    }
}