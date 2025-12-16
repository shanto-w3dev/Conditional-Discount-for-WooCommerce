<?php

namespace Shanto\ConditionalDiscount\App;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class DiscountController {
    use \Shanto\ConditionalDiscount\App\Traits\Singleton;

    public function init() {
        add_action( 'woocommerce_cart_calculate_fees', [ $this, 'apply_conditional_discount' ] );
    }

    public function apply_conditional_discount( $cart ) {
        if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
            return;
        }

        $discount_type = get_option( 'cd_conditional_discount_type', 'percentage' );
        $discount_amount = get_option( 'cd_conditional_discount_amount', 10 );
        $subtotal = WC()->cart->get_subtotal();
        $currency  = get_woocommerce_currency_symbol();

        if ( $this->is_eligible_for_discount() ) {
            $discount = ( 'percentage' === $discount_type ) ? ( $subtotal * ( $discount_amount / 100 ) ) : $discount_amount;

            if($discount > 0){
                $cart->add_fee( sprintf( __( 'Special Discount (%s)', 'conditional-discount' ), $discount_type === 'percentage' ? $discount_amount . '%' : $discount_amount . $currency ), -$discount );
            }
        }
    }

    public function is_eligible_for_discount( ) {
        $enabled = get_option( 'cd_conditional_discount_enable', 'no' );
        if ( 'yes' !== $enabled ) {
            return false;
        }
        $criteria = get_option( 'cd_conditional_discount_criteria', 'cart_total' );
        $threshold =  get_option( 'cd_conditional_discount_threshold', 100 );

        $subtotal = WC()->cart->get_subtotal();
        $item_count = WC()->cart->get_cart_contents_count();

        $meet_condition = false;

        if( 'cart_total' === $criteria && $subtotal >= $threshold ) {
            $meet_condition = true;
        } elseif ( 'item_count' === $criteria && $item_count >= $threshold ) {
            $meet_condition = true;
        }

        return $meet_condition;
    }
}