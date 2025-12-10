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

    public function apply_conditional_discount() {
        if ( ! is_admin() && did_action( 'woocommerce_cart_calculate_fees' ) >= 2 ) {
            return;
        }

        $enabled = get_option( 'cd_conditional_discount_enable', 'no' );
        if ( 'yes' !== $enabled ) {
            return;
        }

        $criteria = get_option( 'cd_conditional_discount_criteria', 'cart_total' );
        $threshold = floatval( get_option( 'cd_conditional_discount_threshold', 100 ) );
        $discount_amount = floatval( get_option( 'cd_conditional_discount_amount', 10 ) );

        $cart = cd()->cart;

        $apply_discount = false;

        if ( 'cart_total' === $criteria ) {
            if ( $cart->get_subtotal() >= $threshold ) {
                $apply_discount = true;
            }
        } elseif ( 'item_count' === $criteria ) {
            if ( $cart->get_cart_contents_count() >= $threshold ) {
                $apply_discount = true;
            }
        }

        if ( $apply_discount ) {
            $cart->add_fee( __( 'Conditional Discount', 'conditional-discount' ), -$discount_amount );
        }
    }
}