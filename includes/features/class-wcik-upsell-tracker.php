<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WCIK_Upsell_Tracker' ) ) {

    class WCIK_Upsell_Tracker {

       /**
             * Initialize hooks
        */
        public function init() {
            add_action( 'woocommerce_thankyou', [ $this, 'track_upsell_purchase' ], 10, 1 );
        }

        /**
         * Track if the upsell product was purchased and store in order meta.
         *
         * @param int $order_id */
    
         public function track_upsell_purchase( $order_id ) {
             $upsell_product_id = intval( get_option( 'wcik_upsell_product_id' ) );

                if ( ! $order_id || ! $upsell_product_id ) {
                   return;
                }

                 $order = wc_get_order( $order_id );
                     if ( ! $order ) {
                      return;
                 }

            $upsell_purchased = false;

            foreach ( $order->get_items() as $item ) {
               if ( intval( $item->get_product_id() ) === $upsell_product_id ) {
                   $upsell_purchased = true;
                     break;
                 }
            }

            update_post_meta(
               $order_id,
               '_wcik_upsell_' . $upsell_product_id . '_purchased',
              $upsell_purchased ? 'yes' : 'no'
            );

         $user_id = $order->get_user_id();
            if ( $user_id && $upsell_purchased ) {
               update_user_meta(
                 $user_id,
                '_wcik_upsell_' . $upsell_product_id . '_purchased',
               'yes'
           );
         }
        }

    }
}
