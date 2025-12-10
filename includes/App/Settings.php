<?php

namespace Shanto\ConditionalDiscount\App;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Settings {
    use \Shanto\ConditionalDiscount\App\Traits\Singleton;

    public function init() {
       add_filter( 'woocommerce_settings_tabs_array', [ $this, 'add_settings_tab' ], 50 );
       add_action( 'woocommerce_settings_conditional_discount', [ $this, 'discount_tab_content' ] );
        add_action( 'woocommerce_update_options_conditional_discount', [ $this, 'update_settings' ] );
    }

    public function add_settings_tab( $tabs ) {
        $tabs['conditional_discount'] = __( 'Conditional Discount', 'conditional-discount' );
        return $tabs;
    }
    public function discount_tab_content() {
        woocommerce_admin_fields( $this->get_settings() );
    }
    public function update_settings() {
        woocommerce_update_options( $this->get_settings() );
    }

    public function get_settings() {
        $settings = [
            'section_title' => [
                'name'     => __( 'Conditional Discount Settings', 'conditional-discount' ),
                'type'     => 'title',
                'desc'     => __( 'Apply conditional discounts based on cart conditions.', 'conditional-discount' ),
                'id'       => 'cd_conditional_discount_section_title'
            ],
            'enable_discount' => [
                'name'    => __( 'Enable Discount', 'conditional-discount' ),
                'type'    => 'checkbox',
                'desc'    => __( 'Enable conditional discount feature', 'conditional-discount' ),
                'id'      => 'cd_conditional_discount_enable'
            ],
            'criteria' => [
                'name'    => __( 'Discount Criteria', 'conditional-discount' ),
                'type'    => 'select',
                'options' => [
                    'cart_total' => __( 'Cart Total', 'conditional-discount' ),
                    'item_count' => __( 'Item Count', 'conditional-discount' ),
                ],
                'desc'    => __( 'Select the criteria for applying the discount', 'conditional-discount' ),
                'id'      => 'cd_conditional_discount_criteria',
                'default' => 'cart_total',
            ],
            'threshold' => [
                'name'    => __( 'Threshold Value', 'conditional-discount' ),
                'type'    => 'number',
                'desc'    => __( 'Set the threshold value for the selected criteria', 'conditional-discount' ),
                'id'      => 'cd_conditional_discount_threshold',
                'default' => '100',
                'custom_attributes' => [
                    'min'  => 0,
                    'step' => 1,
                ],
            ],
            'discount_type' => [
                'name'    => __( 'Discount Type', 'conditional-discount' ),
                'type'    => 'select',
                'options' => [
                    'percentage' => __( 'Percentage', 'conditional-discount' ),
                    'flat_amount' => __( 'Flat Amount', 'conditional-discount' ),
                ],
                'desc'    => __( 'Select the type of discount to apply', 'conditional-discount' ),
                'id'      => 'cd_conditional_discount_type',
                'default' => 'percentage',
            ],
            'discount_value' => [
                'name'    => __( 'Discount Value', 'conditional-discount' ),
                'type'    => 'number',
                'desc'    => __( 'Flat Amount = fixed amount discount. Percentage = % of cart subtotal.', 'conditional-discount' ),
                'id'      => 'cd_conditional_discount_value',
                'default' => '10',
                'custom_attributes' => [
                    'min'  => 0,
                    'step' => 1,
                ],
            ],
            'section_end' => [
                'type' => 'sectionend',
                'id'   => 'cd_conditional_discount_section_end'
            ],
        ];

        return $settings;
    }
        
}