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
    <?php
    echo "<link rel='stylesheet' href='" . get_stylesheet_directory_uri() . "/sass/style.css" . "'>";
    ?>
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
    <div class="container-fluid header header_short">
        <div class="row">
           <div class="col-lg-3 d-lg-block d-xl-block social-block">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 social_logos"><a
                                    href="https://www.facebook.com/Colorados-Finest-CBD-Site-109879910456359" target="_blank"><img
                                        src="<?php echo get_stylesheet_directory_uri() ?>/images/facebook.svg"
                                        alt="Facebook" class="self-align-image"></a></div>
                        <div class="col-md-3  col-sm-3 social_logos"><a href="https://twitter.com/ColoradosCbd" target="_blank"><img
                                        src="<?php echo get_stylesheet_directory_uri() ?>/images/twitter.svg"
                                        alt="Twitter"></a>
                        </div>
                        <div class="col-md-3  col-sm-3 social_logos"><a
                                    href="https://www.instagram.com/colorados_finest_cbd/" target="_blank"><img
                                        src="<?php echo get_stylesheet_directory_uri() ?>/images/instagram.svg"
                                        alt="Instagram" class="self-align-image"></a></div>
                        <div class="col-md-3  col-sm-3 social_logos"><a
                                    href="https://www.youtube.com/channel/UC39vzCcYqgOkP1UfXG2T2ww" target="_blank"><img
                                        src="<?php echo get_stylesheet_directory_uri() ?>/images/youtube.svg"
                                        alt="Youtube" class="self-align-image">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-12 text-center main_logo">
                <a href="/">
					<img src="<?php echo get_stylesheet_directory_uri() ?>/images/colorados_finest.png"
                                 alt="Colorado Finest">
				 <span>PREMIUM CBD
					<img src="<?php echo get_stylesheet_directory_uri() ?>/images/tagline.png"
                                 alt="Take care">
					</span>
				</a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-3 col-12 text-center second">
                <div class="dropdown">
                    <button class="btn btn-outline-warning dropdown-toggle btn-round-colorado" type="button"
                            id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        OUR PRODUCTS
                    </button>
                    <?php do_action('menu_dropdown') ?>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-3 col-12 mt-3 mb-3 mt-md-0 mb-md-0 icons">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-4 product_items" style="display: none;">
                                                      <div class="icon_image">
                           <a href="/my-account/"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/user.svg" alt="User"></a> 
                                                      </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-4 product_items">
                            <div class="icon_image">
                                <?php if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

                                    $count = WC()->cart->cart_contents_count;
                                    ?><a   href="<?php echo wc_get_cart_url(); ?>"
                                           title="<?php _e('View your shopping cart'); ?>">
                                    <img src="<?php echo get_stylesheet_directory_uri() ?>/images/cart.svg" alt="Cart">
                                    <?php
                                    if ($count > 0) {
                                        ?>
                                        <span class="cart-contents-count"><?php echo esc_html($count); ?></span>
                                        <?php
                                    }
                                    ?></a>

                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-4 product_items">
                            <div class="dropdown show icon_image">
                                <a href="#" role="button"
                                   id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    <img src="<?php echo get_stylesheet_directory_uri() ?>/images/menu.svg" alt="Menu" >
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="shop">Shop</a>
                                    <a class="dropdown-item" href="blog">Blog</a>
                                    <a class="dropdown-item" href="privacy-policy">Privacy Policy</a>
                                    <a class="dropdown-item" href="frequently-asked-cbd-questions">FAQ</a>
                                    <a class="dropdown-item" href="contact">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		    <div class="row_icons">
            <div class="icon">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/header_images/natural.svg"
                     alt="100% NATURAL GROWING METHODS">100% NATURAL<br/> GROWING<br/> METHODS
            </div>
            <div class="icon">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/header_images/non-gmo.svg" alt="NON-GMO HEMP OIL">
            NON-GMO<br/> HEMP OIL
				</div>
            <div class="icon">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/header_images/lab.svg" 
					 alt="LAB TEST FOR PURITY AND POTENCY">
				LAB TEST<br/>FOR PURITY<br/>AND POTENCY
            </div>
            <div class="icon">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/header_images/usa.svg"
                     alt="MADE IN THE USA">MADE IN<br/>THE USA
            </div>
        </div>
		
		
    </div>