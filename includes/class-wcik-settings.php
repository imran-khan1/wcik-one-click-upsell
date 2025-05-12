<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WCik Settings Page
 *
 * Adds admin settings page under WooCommerce.
 */
class WCik_Settings {

    /**
     * Initialize admin hooks
     */
    public function init() {
        add_action( 'admin_menu', [ $this, 'add_settings_page' ] );
        add_action( 'admin_init', [ $this, 'register_settings' ] );
    }

    /**
     * Add settings submenu page under WooCommerce
     */
    public function add_settings_page() {
        add_submenu_page(
            'woocommerce',
            'One-Click Upsell',
            'One-Click Upsell',
            'manage_woocommerce',
            'wcik-one-click-upsell',
            [ $this, 'render_settings_page' ]
        );
    }

    /**
     * Register plugin settings
     */
    public function register_settings() {
        register_setting( 'wcik_settings_group', 'wcik_upsell_product_id' );

        add_settings_section(
            'wcik_main_section',
            'Upsell Settings',
            null,
            'wcik-one-click-upsell'
        );

        add_settings_field(
            'wcik_upsell_product_id',
            'Upsell Product ID',
            [ $this, 'render_product_id_field' ],
            'wcik-one-click-upsell',
            'wcik_main_section'
        );
    }

    /**
     * Render input for upsell product ID
     */
    public function render_product_id_field() {
        $product_id = get_option( 'wcik_upsell_product_id', '' );
        echo '<input type="number" name="wcik_upsell_product_id" value="' . esc_attr( $product_id ) . '" class="regular-text">';
        echo '<p class="description">Enter the Product ID to offer as an upsell after checkout.</p>';
    }

    /**
     * Render settings page HTML
     */
    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1>One-Click Upsell Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields( 'wcik_settings_group' );
                do_settings_sections( 'wcik-one-click-upsell' );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}
