<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Main Loader Class for WCik One-Click Upsell
 */
class WCik_Loader {

    /**
     * Constructor
     */
    public function __construct() {
        $this->load_dependencies();
    }

    /**
     * Load required class files
     */
    private function load_dependencies() {
        require_once plugin_dir_path( __FILE__ ) . 'class-wcik-upsell-manager.php';
        require_once plugin_dir_path( __FILE__ ) . 'class-wcik-order-handler.php';
        require_once plugin_dir_path( __FILE__ ) . 'class-wcik-settings.php';
        require_once plugin_dir_path( __FILE__ ) . 'features/class-wcik-upsell-tracker.php';        
    }

    /**
     * Initialize the plugin components
     */
    public function run() {
        if ( class_exists( 'WCik_Upsell_Manager' ) ) {
            ( new WCik_Upsell_Manager() )->init();
        }

        if ( class_exists( 'WCik_Order_Handler' ) ) {
            ( new WCik_Order_Handler() )->init();
        }

        if ( is_admin() && class_exists( 'WCik_Settings' ) ) {
            ( new WCik_Settings() )->init();
        }

         if ( is_admin() && class_exists( 'WCik_Settings' ) ) {
            ( new WCik_Settings() )->init();
        }

         if ( is_admin() && class_exists( 'WCIK_Upsell_Tracker' ) ) {
            ( new WCIK_Upsell_Tracker() )->init();
        }

    }
}
