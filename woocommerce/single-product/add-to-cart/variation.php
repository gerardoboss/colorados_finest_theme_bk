<?php
/**
 * Single variation display
 *
 * This is a javascript-based template for single variations (see https://codex.wordpress.org/Javascript_Reference/wp.template).
 * The values will be dynamically replaced after selecting attributes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

defined('ABSPATH') || exit;

?>
<script type="text/template" id="tmpl-variation-template">
    <div class="woocommerce-variation-description">{{{ data.variation.variation_description }}}</div>
    <div class="woocommerce-variation-price">{{{ data.variation.price_html }}}</div>
    <div class="woocommerce-variation-max-thc">{{{ data.variation.max_active_thc}}}</div>
    <div class="woocommerce-variation-max-cbd">{{{ data.variation.max_active_cbd}}}</div>
    <div class="woocommerce-variation-active-cannabinoids">{{{ data.variation.t_active_cannabinoids}}}</div>
    <div class="woocommerce-variation-total-cannabinoids">{{{ data.variation.total_cannabinoids}}}</div>
    <div class="woocommerce-variation-availability">{{{ data.variation.availability_html }}}</div>
</script>
<script type="text/template" id="tmpl-unavailable-variation-template">
    <p><?php esc_html_e('Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce'); ?></p>
</script>
