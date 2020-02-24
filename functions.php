<?php

/**
 * Lets load all the design styles
 */
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
function my_theme_enqueue_styles()
{
    wp_enqueue_style('bootstrap-style', get_stylesheet_directory_uri() . '/bootstrap/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/bootstrap/js/bootstrap.bundle.min.js', array('jquery'));
    $parent_style = 'parent-style';
    wp_enqueue_style($parent_style, get_template_directory_uri()) . '/style.css';
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style), wp_get_theme()->get('version'));
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.bundle.min.js', array('jquery'));
}

/**
 * Exclude products from a particular category on the shop page
 */
function custom_pre_get_posts_query($q)
{

    $tax_query = (array)$q->get('tax_query');

    $tax_query[] = array(
        'taxonomy' => 'product_cat',
        'field' => 'slug',
        'terms' => array('showcase'), // Don't display products in the showcase category on the shop page.
        'operator' => 'NOT IN'
    );


    $q->set('tax_query', $tax_query);

}

add_action('woocommerce_product_query', 'custom_pre_get_posts_query');

/**
 * Remove sidebar from page
 */
add_action('get_header', 'remove_storefront_sidebar');
function remove_storefront_sidebar()
{
    if (is_woocommerce()) {
        remove_action('storefront_sidebar', 'storefront_get_sidebar', 10);
    }
}

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 6);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 39);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'storefront_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action('woocommerce_after_single_product_summary', 'storefront_single_product_pagination', 30);

/**
 * @snippet       Variable Product Price Range: "From: $$$min_price"
 * @how-to        Get CustomizeWoo.com FREE
 * @sourcecode    https://businessbloomer.com/?p=275
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.5.4
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

//add_filter('woocommerce_variable_price_html', 'bbloomer_variation_price_format_min', 9999, 2);

function bbloomer_variation_price_format_min($price, $product)
{
    $prices = $product->get_variation_prices(true);
    $min_price = current($prices['price']);
    $price = sprintf(__('From: %1$s', 'woocommerce'), wc_price($min_price));
    return $price;
}
