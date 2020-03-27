<?php

add_filter('excerpt_length', function ($length) {
    return 20;
});

/**
 * Lets load all the design styles
 */
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles', 100);
function my_theme_enqueue_styles()
{
    wp_dequeue_style('storefront-child-style-css');
    wp_deregister_style('storefront-child-style-css');
    wp_enqueue_style('bootstrap-style', get_stylesheet_directory_uri() . '/bootstrap/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/bootstrap/js/bootstrap.bundle.min.js', array('jquery'));
    $parent_style = 'parent-style';
    wp_enqueue_style('colorado-style', get_stylesheet_directory_uri() . 'style2.css', array($parent_style), wp_get_theme()->get('version'));
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
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 34);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'storefront_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action('woocommerce_after_single_product_summary', 'storefront_single_product_pagination', 30);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

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
add_action('woocommerce_variation_options_pricing', 'add_max_active_cbd_ml', 10, 3);
add_action('woocommerce_variation_options_pricing', 'add_max_active_thc_ml', 10, 3);
add_action('woocommerce_variation_options_pricing', 'add_t_active_cannabinoids_ml', 10, 3);
add_action('woocommerce_variation_options_pricing', 'add_total_cannabinoids_ml', 10, 3);
add_action('woocommerce_variation_options_pricing', 'add_lab_report', 10, 3);

function add_max_thc_field_backend($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(
        array(
            'id' => 'max_active_thc[' . $loop . ']',
            'class' => 'short',
            'label' => __('Max Active THC', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 'max_active_thc', true)
        )
    );
}

function add_max_active_cbd($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(
        array(
            'id' => 'max_active_cbd[' . $loop . ']',
            'class' => 'short',
            'label' => __('Max Active CBD', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 'max_active_cbd', true)
        )
    );
}

function add_tactive_cannabinoids($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(
        array(
            'id' => 't_active_cannabinoids[' . $loop . ']',
            'class' => 'short',
            'label' => __('T.Active Cannabinoids', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 't_active_cannabinoids', true)
        )
    );
}

function add_total_cannabinoids($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(
        array(
            'id' => 'total_cannabinoids[' . $loop . ']',
            'class' => 'short',
            'label' => __('Total Cannabinoids', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 'total_cannabinoids', true)
        )
    );
}

function add_max_active_cbd_ml($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(
        array(
            'id' => 'max_active_cbd_ml[' . $loop . ']',
            'class' => 'short',
            'label' => __('Max Active CBD ML', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 'max_active_cbd_ml', true)
        )
    );
}

function add_max_active_thc_ml($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(
        array(
            'id' => 'max_active_thc_ml[' . $loop . ']',
            'class' => 'short',
            'label' => __('Max Active THC ML', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 'max_active_thc_ml', true)
        )
    );
}


function add_t_active_cannabinoids_ml($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(
        array(
            'id' => 't_active_cannabinoids_ml[' . $loop . ']',
            'class' => 'short',
            'label' => __('Max Active Cannabinoids ML', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 't_active_cannabinoids_ml', true)
        )
    );
}

function add_total_cannabinoids_ml($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(
        array(
            'id' => 'total_cannabinoids_ml[' . $loop . ']',
            'class' => 'short',
            'label' => __('Total Cannabinoids ML', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 'total_cannabinoids_ml', true)
        )
    );
}

function add_lab_report($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(
        array(
            'id' => 'lab_report[' . $loop . ']',
            'class' => 'short',
            'label' => __('Lab Report', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 'lab_report', true)
        )
    );
}


// -----------------------------------------
// 2. Save custom field on product variation save

add_action('woocommerce_save_product_variation', 'save_max_thc', 10, 2);
add_action('woocommerce_save_product_variation', 'save_max_cbd', 10, 3);
add_action('woocommerce_save_product_variation', 'save_active_cannabinoids', 10, 4);
add_action('woocommerce_save_product_variation', 'save_total_cannabinoids', 10, 5);
add_action('woocommerce_save_product_variation', 'save_max_thc_ml', 10, 6);
add_action('woocommerce_save_product_variation', 'save_max_cbd_ml', 10, 7);
add_action('woocommerce_save_product_variation', 'save_active_cannabinoids_ml', 10, 8);
add_action('woocommerce_save_product_variation', 'save_total_cannabinoids_ml', 10, 9);
add_action('woocommerce_save_product_variation', 'save_lab_report', 10, 9);

function save_max_thc($variation_id, $i)
{
    $custom_field = $_POST['max_active_thc'][$i];
    if (isset($custom_field)) update_post_meta($variation_id, 'max_active_thc', esc_attr($custom_field));
}

function save_max_cbd($variation_id, $i)
{
    $custom_field = $_POST['max_active_cbd'][$i];
    if (isset($custom_field)) update_post_meta($variation_id, 'max_active_cbd', esc_attr($custom_field));
}

function save_active_cannabinoids($variation_id, $i)
{
    $custom_field = $_POST['t_active_cannabinoids'][$i];
    if (isset($custom_field)) update_post_meta($variation_id, 't_active_cannabinoids', esc_attr($custom_field));
}

function save_total_cannabinoids($variation_id, $i)
{
    $custom_field = $_POST['total_cannabinoids'][$i];
    if (isset($custom_field)) update_post_meta($variation_id, 'total_cannabinoids', esc_attr($custom_field));
}

function save_max_thc_ml($variation_id, $i)
{
    $custom_field = $_POST['max_active_thc_ml'][$i];
    if (isset($custom_field)) update_post_meta($variation_id, 'max_active_thc_ml', esc_attr($custom_field));
}

function save_max_cbd_ml($variation_id, $i)
{
    $custom_field = $_POST['max_active_cbd_ml'][$i];
    if (isset($custom_field)) update_post_meta($variation_id, 'max_active_cbd_ml', esc_attr($custom_field));
}

function save_active_cannabinoids_ml($variation_id, $i)
{
    $custom_field = $_POST['t_active_cannabinoids_ml'][$i];
    if (isset($custom_field)) update_post_meta($variation_id, 't_active_cannabinoids_ml', esc_attr($custom_field));
}

function save_total_cannabinoids_ml($variation_id, $i)
{
    $custom_field = $_POST['total_cannabinoids_ml'][$i];
    if (isset($custom_field)) update_post_meta($variation_id, 'total_cannabinoids_ml', esc_attr($custom_field));
}

function save_lab_report($variation_id, $i)
{
    $custom_field = $_POST['lab_report'][$i];
    if (isset($custom_field)) update_post_meta($variation_id, 'lab_report', esc_attr($custom_field));
}

// -----------------------------------------
// 3. Store custom field value into variation data

add_filter('woocommerce_available_variation', 'add_max_thc_data');
add_filter('woocommerce_available_variation', 'add_max_cbd_data');
add_filter('woocommerce_available_variation', 'add_active_cannabinoids_data');
add_filter('woocommerce_available_variation', 'add_total_cannabinoids_data');
add_filter('woocommerce_available_variation', 'add_max_thc_data_ml');
add_filter('woocommerce_available_variation', 'add_max_cbd_data_ml');
add_filter('woocommerce_available_variation', 'add_active_cannabinoids_data_ml');
add_filter('woocommerce_available_variation', 'add_total_cannabinoids_data_ml');
add_filter('woocommerce_available_variation', 'add_lab_report_display');


function add_max_thc_data($variations)
{
    $variations['max_active_thc'] = '<tr><td>Max Active THC:</td><td>' . get_post_meta($variations['variation_id'], 'max_active_thc', true) . '</td>';
    return $variations;
}

function add_max_cbd_data($variations)
{
    $variations['max_active_cbd'] = '<tr><td>Max Active CBD:</td><td>' . get_post_meta($variations['variation_id'], 'max_active_cbd', true) . '</td>';
    return $variations;
}

function add_active_cannabinoids_data($variations)
{
    $variations['t_active_cannabinoids'] = '<tr><td>T.Active Cannabinoids: </td><td>' . get_post_meta($variations['variation_id'], 't_active_cannabinoids', true) . '</td>';
    return $variations;
}

function add_total_cannabinoids_data($variations)
{
    $variations['total_cannabinoids'] = '<tr><td>Total Cannabinoids: </td><td>' . get_post_meta($variations['variation_id'], 'total_cannabinoids', true) . '</td>';
    return $variations;
}

function add_max_thc_data_ml($variations)
{
    $variations['max_active_thc_ml'] = '<td>' . get_post_meta($variations['variation_id'], 'max_active_thc_ml', true) . '</td></tr>';
    return $variations;
}

function add_max_cbd_data_ml($variations)
{
    $variations['max_active_cbd_ml'] = '<td>' . get_post_meta($variations['variation_id'], 'max_active_cbd_ml', true) . '</td></tr>';
    return $variations;
}

function add_active_cannabinoids_data_ml($variations)
{
    $variations['t_active_cannabinoids_ml'] = '<td>' . get_post_meta($variations['variation_id'], 't_active_cannabinoids_ml', true) . '</td></tr>';
    return $variations;
}

function add_total_cannabinoids_data_ml($variations)
{
    $variations['total_cannabinoids_ml'] = '<td>' . get_post_meta($variations['variation_id'], 'total_cannabinoids_ml', true) . '</td></tr>';
    return $variations;
}

function add_lab_report_display($variations)
{
    $variations['lab_report'] = '</tr><tr><td colspan="3"><a href="' . get_post_meta($variations['variation_id'], 'lab_report', true) . '" target="_blank">VEW FULL REPORT</a></td></tr>';
    return $variations;
}

// ------------- simple product custom fields -----------------------------

/**
 * Displays the custom text field input field in the WooCommerce product data meta box
 */
function add_product_lab_simple_product()
{
    $args = array(
        'id' => 'simple_product_lab_report',
        'label' => __('Lab Report', 'cf_lab_report'),
        'class' => 'cf-custom-field',
        'desc_tip' => true,
        'description' => __('Add lab report url for this product', 'cf_lab_report_h'),
    );
    woocommerce_wp_text_input($args);
}

add_action('woocommerce_product_options_general_product_data', 'add_product_lab_simple_product');
/**
 * Saves the custom field data to product meta data
 */
function cf_save_lab_report($post_id)
{
    $product = wc_get_product($post_id);
    $title = isset($_POST['simple_product_lab_report']) ? $_POST['simple_product_lab_report'] : '';
    $product->update_meta_data('simple_product_lab_report', sanitize_text_field($title));
    $product->save();
}

function add_simple_product_max_thc()
{
    $args = array(
        'id' => 'simple_product_max_active_thc',
        'label' => __('Max Active THC', 'max_active_thc'),
        'class' => 'cf-custom-field',
        'desc_tip' => true,
        'description' => __('Add Max Active THC', 'cf_max_active_thc'),
    );
    woocommerce_wp_text_input($args);
}

add_action('woocommerce_product_options_general_product_data', 'add_simple_product_max_thc');
/**
 * Saves the custom field data to product meta data
 */
function cf_save_simple_product_max_thc($post_id)
{
    $product = wc_get_product($post_id);
    $title = isset($_POST['simple_product_max_active_thc']) ? $_POST['simple_product_max_active_thc'] : '';
    $product->update_meta_data('simple_product_max_active_thc', sanitize_text_field($title));
    $product->save();
}

add_action('woocommerce_process_product_meta', 'cf_save_simple_product_max_thc');

function add_simple_product_max_cbd()
{
    $args = array(
        'id' => 'simple_product_max_active_cbd',
        'label' => __('Max Active CBD', 'max_active_cbd'),
        'class' => 'cf-custom-field',
        'desc_tip' => true,
        'description' => __('Add Max Active CBD', 'cf_max_active_cbd'),
    );
    woocommerce_wp_text_input($args);
}

add_action('woocommerce_product_options_general_product_data', 'add_simple_product_max_cbd');
/**
 * Saves the custom field data to product meta data
 */
function cf_save_simple_product_max_cbd($post_id)
{
    $product = wc_get_product($post_id);
    $title = isset($_POST['simple_product_max_active_cbd']) ? $_POST['simple_product_max_active_cbd'] : '';
    $product->update_meta_data('simple_product_max_active_cbd', sanitize_text_field($title));
    $product->save();
}

add_action('woocommerce_process_product_meta', 'cf_save_simple_product_max_cbd');

function add_simple_product_t_active_cannabinoids()
{
    $args = array(
        'id' => 'simple_product_t_active_cannabinoids',
        'label' => __('T.Active Cannabinoids', 't_active_cannabinoids'),
        'class' => 'cf-custom-field',
        'desc_tip' => true,
        'description' => __('T Active Cannabinoids', 'simple_product_t_active_cannabinoids_d'),
    );
    woocommerce_wp_text_input($args);
}

add_action('woocommerce_product_options_general_product_data', 'add_simple_product_t_active_cannabinoids');
/**
 * Saves the custom field data to product meta data
 */
function cf_save_simple_product_t_active_cannabinoids($post_id)
{
    $product = wc_get_product($post_id);
    $title = isset($_POST['simple_product_t_active_cannabinoids']) ? $_POST['simple_product_t_active_cannabinoids'] : '';
    $product->update_meta_data('simple_product_t_active_cannabinoids', sanitize_text_field($title));
    $product->save();
}

add_action('woocommerce_process_product_meta', 'cf_save_simple_product_t_active_cannabinoids');

function add_simple_product_total_cannabinoids()
{
    $args = array(
        'id' => 'simple_product_total_cannabinoids',
        'label' => __('Total Cannabinoids', 'total_cannabinoids'),
        'class' => 'cf-custom-field',
        'desc_tip' => true,
        'description' => __('Total Cannabinoids', 'simple_product_t_active_cannabinoids_d'),
    );
    woocommerce_wp_text_input($args);
}

add_action('woocommerce_product_options_general_product_data', 'add_simple_product_total_cannabinoids');
/**
 * Saves the custom field data to product meta data
 */
function cf_save_simple_product_total_cannabinoids($post_id)
{
    $product = wc_get_product($post_id);
    $title = isset($_POST['simple_product_total_cannabinoids']) ? $_POST['simple_product_total_cannabinoids'] : '';
    $product->update_meta_data('simple_product_total_cannabinoids', sanitize_text_field($title));
    $product->save();
}

add_action('woocommerce_process_product_meta', 'cf_save_simple_product_total_cannabinoids');

/**
 * Displays the custom text field input field in the WooCommerce product data meta box
 */

function add_simple_product_max_thc_ml()
{
    $args = array(
        'id' => 'simple_product_max_active_thc_ml',
        'label' => __('Max Active THC ML', 'max_active_thc_ml'),
        'class' => 'cf-custom-field',
        'desc_tip' => true,
        'description' => __('Add Max Active THC ML', 'cf_max_active_thc_ml'),
    );
    woocommerce_wp_text_input($args);
}

add_action('woocommerce_product_options_general_product_data', 'add_simple_product_max_thc_ml');
/**
 * Saves the custom field data to product meta data
 */
function cf_save_simple_product_max_thc_ml($post_id)
{
    $product = wc_get_product($post_id);
    $title = isset($_POST['simple_product_max_active_thc_ml']) ? $_POST['simple_product_max_active_thc_ml'] : '';
    $product->update_meta_data('simple_product_max_active_thc_ml', sanitize_text_field($title));
    $product->save();
}

add_action('woocommerce_process_product_meta', 'cf_save_simple_product_max_thc_ml');

function add_simple_product_max_cbd_ml()
{
    $args = array(
        'id' => 'simple_product_max_active_cbd_ml',
        'label' => __('Max Active CBD ML', 'max_active_cbd_ml'),
        'class' => 'cf-custom-field',
        'desc_tip' => true,
        'description' => __('Add Max Active CBD ML', 'cf_max_active_cbd_ml'),
    );
    woocommerce_wp_text_input($args);
}

add_action('woocommerce_product_options_general_product_data', 'add_simple_product_max_cbd_ml');
/**
 * Saves the custom field data to product meta data
 */
function cf_save_simple_product_max_cbd_ml($post_id)
{
    $product = wc_get_product($post_id);
    $title = isset($_POST['simple_product_max_active_cbd_ml']) ? $_POST['simple_product_max_active_cbd_ml'] : '';
    $product->update_meta_data('simple_product_max_active_cbd_ml', sanitize_text_field($title));
    $product->save();
}

add_action('woocommerce_process_product_meta', 'cf_save_simple_product_max_cbd_ml');

function add_simple_product_t_active_cannabinoids_ml()
{
    $args = array(
        'id' => 'simple_product_t_active_cannabinoids_ml',
        'label' => __('T.Active Cannabinoids ML', 't_active_cannabinoids_ml_d'),
        'class' => 'cf-custom-field',
        'desc_tip' => true,
        'description' => __('T Active Cannabinoids ML', 'add_simple_product_t_active_cannabinoids_ml'),
    );
    woocommerce_wp_text_input($args);
}

add_action('woocommerce_product_options_general_product_data', 'add_simple_product_t_active_cannabinoids_ml');
/**
 * Saves the custom field data to product meta data
 */
function cf_save_simple_product_t_active_cannabinoids_ml($post_id)
{
    $product = wc_get_product($post_id);
    $title = isset($_POST['simple_product_t_active_cannabinoids_ml']) ? $_POST['simple_product_t_active_cannabinoids_ml'] : '';
    $product->update_meta_data('simple_product_t_active_cannabinoids_ml', sanitize_text_field($title));
    $product->save();
}

add_action('woocommerce_process_product_meta', 'cf_save_simple_product_t_active_cannabinoids_ml');

function add_simple_product_total_cannabinoids_ml()
{
    $args = array(
        'id' => 'simple_product_total_cannabinoids_ml',
        'label' => __('Total Cannabinoids ML', 'total_cannabinoids_ml'),
        'class' => 'cf-custom-field',
        'desc_tip' => true,
        'description' => __('Total Cannabinoids ML', 'simple_product_t_active_cannabinoids_ml'),
    );
    woocommerce_wp_text_input($args);
}

add_action('woocommerce_product_options_general_product_data', 'add_simple_product_total_cannabinoids_ml');
/**
 * Saves the custom field data to product meta data
 */
function cf_save_simple_product_total_cannabinoids_ml($post_id)
{
    $product = wc_get_product($post_id);
    $title = isset($_POST['simple_product_total_cannabinoids_ml']) ? $_POST['simple_product_total_cannabinoids_ml'] : '';
    $product->update_meta_data('simple_product_total_cannabinoids_ml', sanitize_text_field($title));
    $product->save();
}

add_action('woocommerce_process_product_meta', 'cf_save_simple_product_total_cannabinoids_ml');


/**
 * Displays custom field data after the add to cart button -------------------------------------------------------------
 */
function add_lab_report_display_simple_product()
{
    global $post;
    // Check for the custom field value
    $product = wc_get_product($post->ID);
    $title = $product->get_meta('simple_product_lab_report');
    if ($title) {
        echo '<a href="' . get_post_meta($post->ID, 'simple_product_lab_report', true) . '">VIEW FULL REPORT</a>';
    }
}

function display_table_single_product_table()
{
    global $post;
    // Check for the custom field value
    $product = wc_get_product($post->ID);
    $active_thc = $product->get_meta('simple_product_max_active_thc');
    $active_cbd = $product->get_meta('simple_product_max_active_cbd');
    $t_active_cannabinoids = $product->get_meta('simple_product_t_active_cannabinoids');
    $total_cannabinoids = $product->get_meta('simple_product_total_cannabinoids');
    if ($active_thc) {
        echo "<table class='table table-striped product_table'><thead><tr><th SCOPE='col'>CANNABINOIDS TOTAL</th>";
        echo "<th SCOPE=\"col\">PERCENT</th><th SCOPE=\"col\">MG/ML</th></tr></thead><tbody>";
        echo "<tr><th scope='row'>Max Active THC</th><td>" . get_post_meta($post->ID, 'simple_product_max_active_thc', true) . "</th>";
        echo "<td>" . get_post_meta($post->ID, 'simple_product_max_active_thc_ml', true) . "</td></tr>";
    }
    if ($active_cbd) {
        echo "<tr><th scope='row'>T.Active Cannabinoids</th><td>" . get_post_meta($post->ID, 'simple_product_t_active_cannabinoids', true) . "</th>";
        echo "<td>" . get_post_meta($post->ID, 'simple_product_max_active_cbd_ml', true) . "</td></tr>";
    }
    if ($t_active_cannabinoids) {
        echo "<tr><th scope='row'>T.Active Cannabinoids</th><td>" . get_post_meta($post->ID, 'simple_product_t_active_cannabinoids', true) . "</th>";
        echo "<td>" . get_post_meta($post->ID, 'simple_product_t_active_cannabinoids_ml', true) . "</td></tr>";
    }
    if ($total_cannabinoids) {
        echo "<tr><th scope='row'>Total Cannabinoids</th><td>" . get_post_meta($post->ID, 'simple_product_total_cannabinoids', true) . "</th>";
        echo "<td>" . get_post_meta($post->ID, 'simple_product_total_cannabinoids_ml', true) . "</td></tr>";
        echo "<tr><td colspan=\"3\"><a href=\"" . get_post_meta($post->ID, 'simple_product_lab_report', true) . "\">VIEW FULL REPORT </a></td></tr>";
        echo "</tbody></table>";
    };
}

add_action('woocommerce_single_product_summary', 'display_table_single_product_table', 35);

function display_prefooter()
{
    echo "Hola Mundo";
}

//add_action('pre_footer_display', 'display_prefooter');

function display_coupons()
{
    $args = array(
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'asc',
        'post_type' => 'shop_coupon',
        'post_status' => 'publish',
    );

    $coupons = get_posts($args);

    ?>
    <div class="coupon_bar"><?php
    foreach ($coupons as $coupon) {
        $coup = new WC_Coupon($coupon->post_title);
        ?>

        <div class="cf_coupon">
            <div class="holder">
                Use code:
                <div class="code">
                    <?php
                    echo strtoupper($coup->get_code());
                    ?>
                </div>
                at checkout
                <div class="coupon_desk">
                    <?php
                    echo $coup->get_description();
                    ?>
                </div>
                <div class="coupon_date">
                    <?php
                    $expiration_date = new DateTime($coup->get_date_expires());
                    echo "Expiration date. " . $expiration_date->format('Y-m-d');
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
    ?> </div><?php
}

add_action('woocommerce_archive_description', 'display_coupons');


function colorado_shop()
{
    ?>
    <div class="colorado_finest shop container">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/shop_header.png" alt="SHOP DISTILLATES"/>
                <div class="content">
                    <a href="#">
                        <button class="btn btn-outline-warning btn-round-colorado">SHOP DISTILLATES</button>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/shop_header.png" alt="SHOP TOPICALSt"/>
                <div class="content">
                    <a href="#">
                        <button class="btn btn-outline-warning btn-round-colorado">SHOP TOPICALS</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
}

//add_action('woocommerce_after_main_content', 'my_text', 20);

function my_text()
{
    if (is_shop()) {
        do_action('colorado_shop', 'colorado_shop');
    }
}


function list_products_for_dropdown_menu()
{
    $args = array(
        'exclude' => array(115, 114, 112),
    );
    $products = wc_get_products($args);
    ?>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <?php foreach ($products as $product) {
            ?>
            <a class="dropdown-item" href="<?php echo $product->get_slug(); ?>"><?php echo $product->get_name(); ?></a>
        <?php } ?>
    </div>
    <?php
}

add_action('menu_dropdown_shop', 'list_products_for_dropdown_menu');
add_action('menu_dropdown', 'list_products_for_dropdown_menu');

function show_non_gmo()
{
    $cbd_vegan = get_post(138);
    ?>
    <div class="cbd_shop_now container-fluid">
        <div class="row">
            <div class="col-md-3 cbd_description">
                <?php
                echo str_replace(' ', "<br />", $cbd_vegan->post_title);
                ?>
                <div class="product_description">
                    <?php
                    echo $cbd_vegan->post_content;
                    ?>
                </div>
                <div class="text-center">
                    <button class="btn btn-outline-warning btn-round-colorado" onclick="location.href='shop'">SHOP NOW
                    </button>
                </div>
            </div>
            <div class="col-md-9 cbd_video d-sm-flex d-md-flex d-xl-flex">
                <h2>CBD</h2>


                <video id="video1" controls="" poster="<?php echo get_stylesheet_directory_uri() ?>/images/poster.jpg">
                    <source src="<?php echo get_stylesheet_directory_uri() ?>/images/smallvideo.mp4"/>
                    Your browser does not support HTML5 video.
                </video>


            </div>
        </div>
    </div>
    <?php
}


function show_amazing_products()
{
    $amazingProducts = get_post(142);
    $amazingProducts2 = get_post(144);
    ?>
    <div class="cbd_amazing_products container">
        <div class="row">
            <div class="col-md-12 amazing_products">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/icon.png" class="icon"/>
                <span>WE MAKE </span>
                <span>AMAZING PRODUCTS</span>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="first_paragraph">
                            <?php
                            echo $amazingProducts->post_content;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/images/amazing_destillate.jpg"
                             alt="destillate"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/images/amazing_thc.jpg" alt="THC"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/images/amazing_isolate.jpg"
                             alt="Isolate"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/images/amazing_topicals.jpg"
                             alt="Amazing Topicals"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="last_paragraph">
                            <?php
                            echo $amazingProducts2->post_content;
                            ?>
                            <div class="shop_all_products">
                                <a href="/shop"> SHOP ALL PRODUCTS</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}


function power_to_hill()
{
    $powerToHeal = get_post(147);
    ?>
    <div class="power_to_heal container d-flex align-items-center">
        <div class="col-md-8 d-md-flex">
            <img src="<?php echo get_stylesheet_directory_uri() ?>/images/power_to_heal.jpg" alt="The Power To Heal"/>
        </div>
        <div class="col-md-4 col-sm-8 d-flex">
            <div class="power_to_heal_description">
                <?php
                echo $powerToHeal->post_content;
                ?>
            </div>
        </div>
    </div>
    <?php
}

function the_magic_cbd()
{
    $fullSpectrum = get_post(149);
    $customerReview = get_post(151);
    ?>
    <div class="the_magic_cbd">
        <div class="col-md-12 title">
            THE MAGIC OF CBD
        </div>
        <div class="spectrum">
            <div class="full_spectrum">

                <div class="full_spectrum_text">
                    <div class="tagline">FULL <span>SPECTRUM<br/> POTENTIAL</span></div>
                    <div class="text">
                        <?php
                        echo $fullSpectrum->post_content;
                        ?>
                    </div>
                    <div class="shopnow">
                        <button class="btn btn-outline-light btn-round-colorado" onclick="location.href='shop'">SHOP
                            NOW
                        </button>
                    </div>
                </div>
            </div>
            <div class="customer_reviews">
                <div class="text">CUSTOMER <span>REVIEWS</span></div>
                <div class="customer_review">
                    <div class="review">
                        <?php
                        echo $customerReview->post_content;
                        ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="row highest_quality_ingredients">
            <div class="container">
                <div class="col-md-4 first"><h3>HIGHEST QUALITY<br/>INGREDIENTS</h3></div>
                <div class="col-md-4"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/cultivate1.jpg"
                                           alt="cultivate"/>
                    <span>CULTIVATE</span></div>
                <div class="col-md-4"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/potency1.jpg"
                                           alt="potency"/>
                    <span>POTENCY</span></div>
            </div>
        </div>

        <div class="row highest_quality_ingredients">
            <div class="container">
                <div class="col-md-4 first"><h3>HIGHEST QUALITY<br/>PROCESSING</h3></div>
                <div class="col-md-4"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/extract1.jpg"
                                           alt="extract"/>
                    <span>EXTRACT</span></div>
                <div class="col-md-4"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/flavor1.jpg"
                                           alt="flavor"/>
                    <span>FLAVOR</span></div>
            </div>
        </div>
    </div>
    <?php
}

function colorados_finest_advante()
{
    $coloradosFinestAdvantage = get_post(154);
    ?>
    <div class="colorados_finest_advantage">
        <div class="logo"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/icon.png"
                               alt="Flavor"/></div>
        <div class="description">
            <?php
            echo $coloradosFinestAdvantage->post_content;
            ?>
        </div>
        <div class="cta">
            <button class="btn btn-outline-warning btn-round-colorado" onclick="location.href='shop'">SHOP NOW</button>
        </div>

        <div class="seed"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/advantage_seed.png"
                               alt="Seeds"/></div>
    </div>
    <?php
}

function not_for_humans()
{
    $notJustForHuman = get_post(156);
    ?>
    <div class="social_box">
        <div class="not_for_human">
            <div class="description">

                <div class="pet_description">
                    <?php echo $notJustForHuman->post_content; ?>
                    <?php echo '<a href="' . get_permalink($notJustForHuman->ID) . '" style="font-weight:bold; color:#4cb051">' . 'Read More' . '</a>'; ?>
                </div>
            </div>
            <div class="photo">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/notforhumans.jpg" alt="Flavor"/>
            </div>
        </div>
    </div>
    <?php
}

function site_survey()
{
    $surveyText = get_post(135);
    ?>
    <div class="take_care container">
        <div class="row">
            <div class="col-md-6">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 d-none d-sm-block d-md-block d-xl-block">
                            <img src="<?php echo get_stylesheet_directory_uri() ?>/images/take_care_vert.png"
                                 alt="Take Care"/>
                        </div>
                        <div class="col-md-9">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 take_care_description">
                                        <?php
                                        echo $surveyText->post_content;
                                        ?>
                                        <span>Which of our products is right for you?</span>

                                        <button class="btn btn-outline-warning btn-round-colorado">TAKE OUR SHORT
                                            SURVEY
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/products_take_care.png" alt="Take Care"/>
            </div>
        </div>
    </div>
    <?php
}


function colorado_finest()
{
    ?>
    <div class="colorado_finest container">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/colorado_finest_left.jpg"
                     alt="Colorado Finest"/>
                <div class="content">
                    <img src="<?php echo get_stylesheet_directory_uri() ?>/images/icon.png" class="icon"/>
                    <img src="<?php echo get_stylesheet_directory_uri() ?>/images/colorado_finest_left_logo.png"
                         alt="Colorado Finest"/>
                    <button class="btn btn-outline-warning btn-round-colorado" onclick="location.href='shop'">SHOP NOW
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/colorado_finest.jpg"
                     alt="Colorado Finest"/>
            </div>
        </div>
    </div>
    <?php
}


function list_products_footer()
{
    $args = array(
        'exclude' => array(115, 114, 112),
    );
    $products = wc_get_products($args);
    ?>
    <?php foreach ($products as $product) {
    ?>
    <li><a href="<?php echo $product->get_slug(); ?>"><?php echo $product->get_name(); ?></a></li>
<?php } ?>
    <?php
}

function featured_products()
{
    ?>
    <div class="featured_products container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <!--                <div class="container">-->
                <!--                    <div class="row">-->
                <div class="col-md-12">
                    <?php
                    $params = array('posts_per_page' => 3, 'post_type' => 'product', 'product_cat' => 'showcase');
                    $wc_query = new WP_Query($params);
                    ?>
                    <ul class="products">
                        <?php if ($wc_query->have_posts()) : ?>
                            <?php while ($wc_query->have_posts()) :
                                $wc_query->the_post();
                                $showcase_product = wc_get_product(get_the_ID());
                                $product_attributes = get_post_meta(get_the_ID(), '_product_attributes');
                                $product_id = ($product_attributes[0]['showcase_product']['value']);
                                $product = wc_get_product($product_id);
                                ?>
                                <li class="product">
                                    <div class="product_image">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                    <div class="product_description">
                                        <h3 class="colorados_product_title">
                                            <a href="<?php the_permalink($product_id); ?>"><?php the_title() ?></a>
                                        </h3>
                                        <div class="product_sizes">
                                            <?php
                                            $strength = $product->get_variation_attributes()["pa_strength"];
                                            echo max($strength) . " - " . min($strength);
                                            ?>
                                        </div>
                                        <div class="product_price">
                                            <div class="price_title">STARTING AT</div>
                                            <div class="price">
                                                <?php echo $product->get_price_html(); ?>
                                            </div>
                                        </div>
                                        <div class="shop_now">
                                            <button class="btn btn-outline-light btn-round-colorado"
                                                    onclick="location.href='<?php the_permalink($product_id); ?>'">SHOP
                                                NOW
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <li><?php _e('No Products'); ?></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <!--                    </div>-->
                <!--                </div>-->
            </div>
        </div>
    </div>
    <?php
}

//add_action('colorado_shop', 'colorado_shop');
add_action('colorado_finest', 'colorado_finest');
add_action('footer_list', 'list_products_footer');
add_action('site_survey', 'site_survey');
add_action('show_non_gmo', 'show_non_gmo');
add_action('show_amazing_products', 'show_amazing_products');
add_action('show_power_to_hill', 'power_to_hill');
add_action('the_magic_cbd', 'the_magic_cbd');
add_action('colorados_advantage', 'colorados_finest_advante');
add_action('not_for_human', 'not_for_humans');
add_action('after_product', 'show_non_gmo', 10);
add_action('after_product', 'power_to_hill', 11);
add_action('page_menu_bottom', 'featured_products');
add_action('product_showcase', 'featured_products');


function excerpt_readmore($more)
{
    global $post;
    return '... <a href="' . get_permalink($post->ID) . '" class="readmore">' . 'Read More' . '</a>';
}

//add_filter('excerpt_more', 'excerpt_readmore');

add_filter('excerpt_length', 'your_prefix_excerpt_length');
function your_prefix_excerpt_length()
{
    return 20;
}

