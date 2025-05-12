<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * WCik Order Handler
 *
 * Handles logic after WooCommerce order is placed.
 */
class WCik_Order_Handler {

    /**
     * Initialize hooks
     */
    public function init() {
        add_action( 'woocommerce_thankyou', [ $this, 'handle_order_completion' ], 10, 1 );
    }

    /**
     * Hook into order completion
     *
     * @param int $order_id
     */
    public function handle_order_completion( $order_id ) {
        if ( ! $order_id ) {
            return;
        }

        $order = wc_get_order( $order_id );

        if ( ! $order ) {
            return;
        }

        // Example: Store info in session for upsell targeting
        WC()->session->set( 'wcik_last_order_id', $order_id );

        // You can later use this in the upsell manager to customize offers

        // Optional: log or send analytics event
        do_action( 'wcik_order_placed', $order );
    }
}
