<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$product_id = get_option( 'wcik_upsell_product_id' );
$product    = wc_get_product( $product_id );

if ( ! $product || ! $product->is_type( 'simple' ) ) {
    return;
}

$product_name  = $product->get_name();
$product_price = $product->get_price_html();
$product_image = wp_get_attachment_image_src( $product->get_image_id(), 'medium' )[0];
$add_to_cart_url = esc_url( wc_get_cart_url() . '?add-to-cart=' . $product_id );
?>

<div id="wcik-upsell-modal" class="wcik-modal">
    <div class="wcik-modal-content">
        <span class="wcik-close" id="wcik-close-modal">&times;</span>
        <h2>Special Offer Just for You!</h2>
        <div class="wcik-product">
            <img src="<?php echo esc_url( $product_image ); ?>" alt="<?php echo esc_attr( $product_name ); ?>">
            <h3><?php echo esc_html( $product_name ); ?></h3>
            <p class="wcik-price"><?php echo $product_price; ?></p>
            <a href="<?php echo $add_to_cart_url; ?>" class="wcik-add-btn">Add to Cart Now</a>
        </div>
    </div>
</div>
