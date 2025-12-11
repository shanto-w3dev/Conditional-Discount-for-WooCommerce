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

        $enabled = get_option( 'cd_conditional_discount_enable', 'no' );
        if ( 'yes' !== $enabled ) {
            return;
        }

        $criteria = get_option( 'cd_conditional_discount_criteria', 'cart_total' );
        $threshold =  get_option( 'cd_conditional_discount_threshold', 100 );
        $discount_type = get_option( 'cd_conditional_discount_type', 'percentage' );
        $discount_amount = get_option( 'cd_conditional_discount_amount', 10 );

        $subtotal = $cart->get_subtotal();
        $item_count = $cart->get_cart_contents_count();

        $apply_discount = false;

        if( 'cart_total' === $criteria && $subtotal >= $threshold ) {
            $apply_discount = true;
        } elseif ( 'item_count' === $criteria && $item_count >= $threshold ) {
            $apply_discount = true;
        }
        
        $currency  = get_woocommerce_currency_symbol();

        if ( $apply_discount ) {
            $discount = ( 'percentage' === $discount_type ) ? ( $subtotal * ( $discount_amount / 100 ) ) : $discount_amount;

            if($discount > 0){
                $cart->add_fee( sprintf( __( 'Special Discount (%s)', 'conditional-discount' ), $discount_type === 'percentage' ? $discount_amount . '%' : $discount_amount . $currency ), -$discount );
            }
        }
    }
}