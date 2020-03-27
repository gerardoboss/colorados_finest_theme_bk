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

    <main id="main" class="site-main" role="main" style="display: none;">
        <div class="row">
            <div class="col-md-12 mt-4">
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="post_short">
                    <?php
                    // Define our WP Query Parameters
                    $query_options = array(
                        //'category_name' => 'blog',
                        'posts_per_page' => 30,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    );
                    $the_query = new WP_Query($query_options);

                    while ($the_query->have_posts()) : $the_query->the_post();
                        ?>
                        <div class="post" style="background-image: url(' <?php the_post_thumbnail_url(); ?>')">
                            <div class="the_title"><?php the_title() ?></div>
                            <a href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a>
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
    //'offset' => 3
);
$the_query2 = new WP_Query($query_options);
?>
    <div class="blogposts">

		<div class="container">
		<h2>THE MAGIC OF CBD</h2>
		<p>We can guarantee the purity and potency of our products--we test each and every batch.</p>

        <div class="posts">
            <?php while ($the_query2->have_posts()) : $the_query2->the_post(); ?>
			
			<?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
			
               <div class="post_item">
                    <a href="<?php the_permalink() ?>"> 
					<div class="post_thumb" style="background: url('<?php echo $backgroundImg[0]; ?>') no-repeat;background-size: cover;"></div>
                    <div class="title"><?php the_title() ?></div>
                    <div class="post_description"><?php the_excerpt() ?></div>
                    <div class="read_more">Read More</div>
					</a>
                </div>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
			</div></div>

<?php do_action('colorado_finest') ?>
		
<?php
get_footer();
