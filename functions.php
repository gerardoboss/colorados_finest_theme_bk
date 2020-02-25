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
    //wp_enqueue_style($parent_style, get_template_directory_uri()) . '/style.css';
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style), wp_get_theme()->get('version'));
    //wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.bundle.min.js', array('jquery'));
    wp_enqueue_script('colorados-finest', get_stylesheet_directory_uri() . '/colorado_scripts/colorado.js', array(), false, true);
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

/**
 * @snippet       Add Custom Field to Product Variations - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @sourcecode    https://businessbloomer.com/?p=73545
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.5.6
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

// -----------------------------------------
// 1. Add custom field input @ Product Data > Variations > Single Variation

add_action('woocommerce_variation_options_pricing', 'add_max_thc_field_backend', 10, 3);
add_action('woocommerce_variation_options_pricing', 'add_max_active_cbd', 10, 3);
add_action('woocommerce_variation_options_pricing', 'add_tactive_cannabinoids', 10, 3);
add_action('woocommerce_variation_options_pricing', 'add_total_cannabinoids', 10, 3);

function add_max_thc_field_backend($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(array(
            'id' => 'custom_field[' . $loop . ']',
            'class' => 'short',
            'label' => __('Max Active THC', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 'max_active_thc', true)
        )
    );
}

function add_max_active_cbd($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(array(
            'id' => 'custom_field[' . $loop . ']',
            'class' => 'short',
            'label' => __('Max Active CBD', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 'max_active_cbd', true)
        )
    );
}

function add_tactive_cannabinoids($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(array(
            'id' => 'custom_field[' . $loop . ']',
            'class' => 'short',
            'label' => __('T.Active Cannabinoids', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 't_active_cannabinoids', true)
        )
    );
}

function add_total_cannabinoids($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(array(
            'id' => 'custom_field[' . $loop . ']',
            'class' => 'short',
            'label' => __('Total Cannabinoids', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 'total_cannabinoids', true)
        )
    );
}

// -----------------------------------------
// 2. Save custom field on product variation save

add_action('woocommerce_save_product_variation', 'save_max_thc', 10, 2);
add_action('woocommerce_save_product_variation', 'save_max_cbd', 10, 2);
add_action('woocommerce_save_product_variation', 'save_active_cannabinoids', 10, 2);
add_action('woocommerce_save_product_variation', 'save_total_cannabinoids', 10, 2);

function save_max_thc($variation_id, $i)
{
    $custom_field = $_POST['custom_field'][$i];
    if (isset($custom_field)) update_post_meta($variation_id, 'max_active_thc', esc_attr($custom_field));
}

function save_max_cbd($variation_id, $i)
{
    $custom_field = $_POST['custom_field'][$i];
    if (isset($custom_field)) update_post_meta($variation_id, 'max_active_cbd', esc_attr($custom_field));
}

function save_active_cannabinoids($variation_id, $i)
{
    $custom_field = $_POST['custom_field'][$i];
    if (isset($custom_field)) update_post_meta($variation_id, 't_active_cannabinoids', esc_attr($custom_field));
}

function save_total_cannabinoids($variation_id, $i)
{
    $custom_field = $_POST['custom_field'][$i];
    if (isset($custom_field)) update_post_meta($variation_id, 'total_cannabinoids', esc_attr($custom_field));
}

// -----------------------------------------
// 3. Store custom field value into variation data

add_filter('woocommerce_available_variation', 'add_max_thc_data');
add_filter('woocommerce_available_variation', 'add_max_cbd_data');
add_filter('woocommerce_available_variation', 'add_active_cannabinoids_data');
add_filter('woocommerce_available_variation', 'add_total_cannabinoids_data');

function add_max_thc_data($variations)
{
    $variations['max_active_thc'] = '<div class="woocommerce_custom_field">Max Active THC: <span>' . get_post_meta($variations['variation_id'], 'max_active_thc', true) . '</span></div>';
    return $variations;
}

function add_max_cbd_data($variations)
{
    $variations['max_active_cbd'] = '<div class="woocommerce_custom_field">Max Active CBD: <span>' . get_post_meta($variations['variation_id'], 'max_active_cbd', true) . '</span></div>';
    return $variations;
}

function add_active_cannabinoids_data($variations)
{
    $variations['t_active_cannabinoids'] = '<div class="woocommerce_custom_field">T.Active Cannabinoids: <span>' . get_post_meta($variations['variation_id'], 't_active_cannabinoids', true) . '</span></div>';
    return $variations;
}

function add_total_cannabinoids_data($variations)
{
    $variations['total_cannabinoids'] = '<div class="woocommerce_custom_field">Total Cannabinoids: <span>' . get_post_meta($variations['variation_id'], 'total_cannabinoids', true) . '</span></div>';
    return $variations;
}
