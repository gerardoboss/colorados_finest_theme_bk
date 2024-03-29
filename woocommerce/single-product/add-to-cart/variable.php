<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

defined('ABSPATH') || exit;

global $product;

$attribute_keys = array_keys($attributes);
$variations_json = wp_json_encode($available_variations);
$variations_attr = function_exists('wc_esc_json') ? wc_esc_json($variations_json) : _wp_specialchars($variations_json, ENT_QUOTES, 'UTF-8', true);

do_action('woocommerce_before_add_to_cart_form'); ?>

<form class="variations_form cart"
      action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
      method="post" enctype='multipart/form-data' data-product_id="<?php echo absint($product->get_id()); ?>"
      data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
    <?php do_action('woocommerce_before_variations_form'); ?>

    <?php if (empty($available_variations) && false !== $available_variations) : ?>
        <p class="stock out-of-stock"><?php echo esc_html(apply_filters('woocommerce_out_of_stock_message', __('This product is currently out of stock and unavailable.', 'woocommerce'))); ?></p>
    <?php else : ?>
        <div class="colorado_variations variations">
            <?php foreach ($attributes as $attribute_name => $options) : ?>
                <div class="colorado_variation">
                    <div class="value">
                        <?php
                        wc_dropdown_variation_attribute_options(array(
                            'options' => $options,
                            'attribute' => $attribute_name,
                            'product' => $product,
                            'class' => 'colorados_dropdown'
                        ));
                        //echo end($attribute_keys) === $attribute_name ? wp_kses_post(apply_filters('woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__('Clear', 'woocommerce') . '</a>')) : '';
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="colorado_variation">
                <!--                this is the quantity-->
                <div class="value">
                    <?php
                    woocommerce_quantity_input(array(
                        'min_value' => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                        'max_value' => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                        'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                    ));

                    do_action('woocommerce_after_add_to_cart_quantity');
                    ?>
                </div>
            </div>
        </div>
        <div class="colorados_finest_submit">
            <?php do_action('woocommerce_after_add_to_cart_button'); ?>

            <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>"/>
            <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>"/>
            <input type="hidden" name="variation_id" class="variation_id" value="0"/>
        </div>
        <div class="variation_price">
            <div class="woocommerce-variation single_variation"></div>
        </div>

    <?php endif; ?>
    <?php do_action('woocommerce_after_variations_form'); ?>
</form>
<?php do_action('woocommerce_after_add_to_cart_form'); ?>

