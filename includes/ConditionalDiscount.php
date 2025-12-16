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
        define('CDFW_VER', defined('CDFW_DEV') ? time() : '1.1.0' );
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
        App\NoticeHandler::instance()->init();
    }

    public function init_hooks(){
        load_plugin_textdomain( 'conditional-discount', false, CDFW_PATH . 'i18n/' );
        add_action('wp_enqueue_scripts', [$this, 'frontend_assets']);
    }

    public function frontend_assets(){
        if(is_cart()){
            wp_enqueue_script('cd_conditional_discount', CDFW_URL . 'assets/js/script.js', ['jquery'], CDFW_VER, true);
        }
    }
}