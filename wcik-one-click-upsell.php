<?php
/**
 * Plugin Name:       WCik One-Click Upsell
 * Description:       Offer a relevant product immediately after checkout with a one-click upsell.
 * Version:           1.0.0
 * Author:            Your Name
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wcik-one-click-upsell
 * Domain Path:       /languages
 */

 define( 'WCIK_ONE_CLICK_UPSELL_PATH', plugin_dir_path( __FILE__ ) );
 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Check if WooCommerce is active
function wcik_check_woocommerce_active() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        add_action( 'admin_notices', function () {
            echo '<div class="notice notice-error"><p><strong>WCik One-Click Upsell</strong> requires WooCommerce to be installed and active.</p></div>';
        } );
        return false;
    }
    return true;
}

// Activation hook
function wcik_activate_plugin() {
    // Add activation-related logic here
    // e.g., flush rewrite rules or create options
}
register_activation_hook( __FILE__, 'wcik_activate_plugin' );

// Deactivation hook
function wcik_deactivate_plugin() {
    // Cleanup actions (e.g., flush rewrite rules)
}
register_deactivation_hook( __FILE__, 'wcik_deactivate_plugin' );

// Initialize the plugin
function wcik_initialize_plugin() {
    if ( ! wcik_check_woocommerce_active() ) {
        return;
    }

    require_once plugin_dir_path( __FILE__ ) . 'includes/class-wcik-loader.php';

    // Instantiate loader
    $loader = new WCik_Loader();
    $loader->run();
}
add_action( 'plugins_loaded', 'wcik_initialize_plugin' );
