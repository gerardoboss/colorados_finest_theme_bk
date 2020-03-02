<?php
/** content posts */

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package coloradosfinest
 */

get_header();
?>
<?php do_action('site_survey') ?>
<?php do_action('product_showcase') ?>
<?php do_action('show_non_gmo') ?>
<?php do_action('show_amazing_products') ?>
<?php do_action('show_power_to_hill') ?>
<?php do_action('the_magic_cbd') ?>
<?php do_action('colorados_advantage') ?>
<?php do_action('not_for_human') ?>
<?php
get_footer();
