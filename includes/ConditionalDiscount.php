<?php

namespace Shanto\ConditionalDiscount;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class ConditionalDiscount {
    use App\Traits\Singleton;

    public function init(){
        $this->define_constants();

        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    public function define_constants(){
        define('CDFW_VER', defined('CDFW_VER') ? time() : '1.0.0' );
        define('CDFW_PATH', \plugin_dir_path(__DIR__));
        define('CDFW_URL', \plugin_dir_url(__DIR__));
    }

    public function init_plugin(){
        $this->includes();
        $this->init_hooks();
    }

    public function includes(){
        App\Settings::instance()->init();
        App\DiscountController::instance()->init();
    }

    public function init_hooks(){
        load_plugin_textdomain( 'conditional-discount', false, CDFW_PATH . 'i18n/' );
    }
}