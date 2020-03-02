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

    <main id="main" class="site-main" role="main">
        <div class="row">
            <div class="col-md-12 mt-4">
                <h1><b>Featured Articles</b></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="post_short">
                    <?php
                    // Define our WP Query Parameters
                    $query_options = array(
                        'category_name' => 'blog',
                        'posts_per_page' => 3,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    );
                    $the_query = new WP_Query($query_options);

                    while ($the_query->have_posts()) : $the_query->the_post();
                        ?>
                        <div class="post" style="background-image: url(' <?php the_post_thumbnail_url(); ?>')">
                            <a href="<?php the_permalink(); ?>"><?php the_content(); ?></a>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    </main><!-- #main -->
<?php
$query_options = array(
    'category_name' => 'blog',
    'posts_per_page' => 9,
    'orderby' => 'date',
    'order' => 'DESC',
    'offset' => 3
);
$the_query2 = new WP_Query($query_options);
?>
    <div class="blogposts container">
        <h1><b>More Posts</b></h1>
        <div class="post_item">
            <div class="post_thumb"></div>
            <div class="post_description"></div>
        </div>
    </div>
<?php
get_footer();
