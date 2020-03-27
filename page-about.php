<?php

/**
 * Template Name: About Page Template
 *
 * @package WordPress
 **/

get_header('shop'); ?>

    <main id="main" class="site-main page container about" role="main">
        <div class="row">
            <div class="col-md-12">
                <?php
                while (have_posts()) :
                    the_post();

                    do_action('storefront_page_before');

                    get_template_part('content', 'page');

                    /**
                     * Functions hooked in to storefront_page_after action
                     *
                     * @hooked storefront_display_comments - 10
                     */
                    do_action('storefront_page_after');

                endwhile; // End of the loop.
                ?>
            </div>
        </div>
    </main><!-- #main -->

<?php do_action('colorado_finest') ?>
<?php
get_footer();