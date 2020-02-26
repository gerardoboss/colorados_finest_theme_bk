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
    <div class="price_holder">
        <div class="woocommerce-variation-description">{{{ data.variation.variation_description }}}</div>
        <div class="woocommerce-variation-price">
            <span class="price_title">Price:</span>
            {{{ data.variation.price_html }}}
        </div>
        <div class="woocommerce-variation-availability">{{{ data.variation.availability_html }}}</div>
    </div>
    <table class="table_products table table-striped">
        <tr>
            <th scope="col">CANNABINOIDS TOTAL</th>
            <th scope="col">PERCENT</th>
            <th scope="col">MG/ML</th>
        </tr>
        {{{ data.variation.max_active_thc}}}
        {{{ data.variation.max_active_thc_ml}}}
        {{{ data.variation.max_active_cbd}}}
        {{{ data.variation.max_active_cbd_ml}}}
        {{{ data.variation.t_active_cannabinoids}}}
        {{{ data.variation.t_active_cannabinoids_ml}}}
        {{{ data.variation.total_cannabinoids}}}
        {{{ data.variation.total_cannabinoids_ml}}}
        {{{ data.variation.lab_report}}}
    </table>
</script>
<script type="text/template" id="tmpl-unavailable-variation-template">
    <p><?php esc_html_e('Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce'); ?></p>
</script>
