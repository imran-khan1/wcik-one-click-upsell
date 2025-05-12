<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Frontend Upsell Manager
 */
class WCik_Upsell_Manager {

    /**
     * Initialize hooks
     */
    public function init() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
        add_action( 'woocommerce_thankyou', [ $this, 'render_upsell_offer_template' ] );
    }

    /**
     * Enqueue frontend assets (CSS/JS)
     */
    public function enqueue_assets() {
        // Only enqueue on thank you page
        if ( is_wc_endpoint_url( 'order-received' ) ) {
            wp_enqueue_style(
                'wcik-upsell-style',
                plugin_dir_url( __DIR__ ) . 'assets/css/upsell.css',
                [],
                '1.0.0'
            );

            wp_enqueue_script(
                'wcik-upsell-script',
                plugin_dir_url( __DIR__ ) . 'assets/js/upsell.js',
                [],
                '1.0.0',
                true
            );

            // Localize data if needed
            wp_localize_script( 'wcik-upsell-script', 'WCikUpsellData', [
                'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            ] );
        }
    }

    /**
     * Renders the upsell offer modal template
     */
    public function render_upsell_offer_template() {
        echo '<!-- Upsell Modal Template Loaded -->';  // Debugging line
         wc_get_template('upsell-offer-template.php', array(),   '',  WCIK_ONE_CLICK_UPSELL_PATH . 'templates/');
    }
}
