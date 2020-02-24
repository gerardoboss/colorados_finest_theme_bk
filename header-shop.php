<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package coloradosfinest
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <div class="container-fluid pre_header p-0 m-0">
        <div class="row no-gutters">
            <div class="col-12">
                prehader
            </div>
        </div>
    </div>
    <div class="container-fluid header_short">
        <div class="row">
            <div class="col-md-2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 social_logos"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/facebook.png" alt="Facebook"></div>
                        <div class="col-md-3 social_logos"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/twitter.png" alt="Twitter"></div>
                        <div class="col-md-3 social_logos"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/instagram.png" alt="Instagram"></div>
                        <div class="col-md-3 social_logos"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/youtube.png" alt="Youtube"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <a href="/"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/colorados_finest.png" alt="User"></a>
            </div>
            <div class="col-md-2 text-center">
                <button class="btn btn-outline-warning" onclick="window.location.href='shop'">OUR PRODUCTS</button>
            </div>
            <div class="col-md-2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 product_items"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/user.png" alt="User"></div>
                        <div class="col-md-4 product_items">
                            <?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

                                $count = WC()->cart->cart_contents_count;
                                ?><a   href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
                                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/cart.png" alt="Cart">
                                <?php
                                if ( $count > 0 ) {
                                    ?>
                                    <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
                                    <?php
                                }
                                ?></a>

                            <?php } ?>
                        </div>
                        <div class="col-md-4 product_items"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/menu.png" alt="Menu">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>