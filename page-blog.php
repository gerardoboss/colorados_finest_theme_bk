<?php
/* Template Name: Blog Page Template */
/**
 * Template Name: Full Width Page
 *
 * @package WordPress
 **/

get_header('shop');
$query = array();
?>

    <main id="main" class="site-main page container" role="main">
        <div class="row">
            <div class="col-md-12 mt-4">
                <h1><b>Blog</b></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                // Define our WP Query Parameters
                $query_options = array(
                    'category_name' => 'blog',
                    'posts_per_page' => 5,
                );
                $the_query = new WP_Query($query_options);

                while ($the_query->have_posts()) : $the_query->the_post();
                    ?>
                    <h3><?php the_title(); ?></h3>
                    <?php the_excerpt(__('(more…)')); ?>

                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </main><!-- #main -->
<?php
get_footer();
