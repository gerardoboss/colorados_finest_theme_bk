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
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 34);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'storefront_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action('woocommerce_after_single_product_summary', 'storefront_single_product_pagination', 30);

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
    woocommerce_wp_text_input(array(
            'id' => 'max_active_thc[' . $loop . ']',
            'class' => 'short',
            'label' => __('Max Active THC', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 'max_active_thc', true)
        )
    );
}

function add_max_active_cbd($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(array(
            'id' => 'max_active_cbd[' . $loop . ']',
            'class' => 'short',
            'label' => __('Max Active CBD', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 'max_active_cbd', true)
        )
    );
}

function add_tactive_cannabinoids($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(array(
            'id' => 't_active_cannabinoids[' . $loop . ']',
            'class' => 'short',
            'label' => __('T.Active Cannabinoids', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 't_active_cannabinoids', true)
        )
    );
}

function add_total_cannabinoids($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(array(
            'id' => 'total_cannabinoids[' . $loop . ']',
            'class' => 'short',
            'label' => __('Total Cannabinoids', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 'total_cannabinoids', true)
        )
    );
}

function add_max_active_cbd_ml($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(array(
            'id' => 'max_active_cbd_ml[' . $loop . ']',
            'class' => 'short',
            'label' => __('Max Active CBD ML', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 'max_active_cbd_ml', true)
        )
    );
}

function add_max_active_thc_ml($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(array(
            'id' => 'max_active_thc_ml[' . $loop . ']',
            'class' => 'short',
            'label' => __('Max Active THC', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 'max_active_thc_ml', true)
        )
    );
}


function add_t_active_cannabinoids_ml($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(array(
            'id' => 't_active_cannabinoids_ml[' . $loop . ']',
            'class' => 'short',
            'label' => __('Max Active CBD ML', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 't_active_cannabinoids_ml', true)
        )
    );
}

function add_total_cannabinoids_ml($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(array(
            'id' => 'total_cannabinoids_ml[' . $loop . ']',
            'class' => 'short',
            'label' => __('Total Cannabinoids ML', 'woocommerce'),
            'value' => get_post_meta($variation->ID, 'total_cannabinoids_ml', true)
        )
    );
}

function add_lab_report($loop, $variation_data, $variation)
{
    woocommerce_wp_text_input(array(
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
    $variations['lab_report'] = '</tr><tr><td colspan="3"><a href="' . get_post_meta($variations['variation_id'], 'lab_report', true) . '">Lab Report</a></td></tr>';
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
        echo '<a href="' . get_post_meta($post->ID, 'simple_product_lab_report', true) . '">Lab Report </a>';
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
        echo "<tr><td colspan=\"3\"><a href=\"" . get_post_meta($post->ID, 'simple_product_lab_report', true) . "\">Lab Report </a></td></tr>";
        echo "</tbody></table>";
    };
}

add_action('woocommerce_single_product_summary', 'display_table_single_product_table', 35);