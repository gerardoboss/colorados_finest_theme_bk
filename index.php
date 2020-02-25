<?php
/** content posts */
$surveyText = get_post(135);
$cbd_vegan = get_post(138);
$amazingProducts = get_post(142);
$amazingProducts2 = get_post(144);
$powerToHeal = get_post(147);
$fullSpectrum = get_post(149);
$customerReview = get_post(151);
$coloradosFinestAdvantage = get_post(154);
$notJustForHuman = get_post(156);
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
    <div class="take_care container">
        <div class="row">
            <div class="col-md-8">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="<?php echo get_stylesheet_directory_uri() ?>/images/take_care_vert.png"
                                 alt="Take Care"
                                 height="386" width="99"/>
                        </div>
                        <div class="col-md-9">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 take_care_title">
                                        <?php
                                        echo $surveyText->post_title;
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 take_care_description">
                                        <?php
                                        echo $surveyText->post_content;
                                        ?>
                                        <div class="which_products text-center">
                                            Which of our products is right for you?
                                            <button class="btn btn-outline-warning">TAKE OUR SHORT SURVEY</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/products_take_care.png" alt="Take Care"/>
            </div>
        </div>
    </div>
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
                                            <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
                                        </h3>
                                        <div class="product_sizes">
                                            <?php
                                            $strength = $product->get_variation_attributes()["pa_strength"];
                                            echo min($strength) . " - " . max($strength);
                                            ?>
                                        </div>
                                        <div class="product_price">
                                            <div class="price_title">STARTING AT</div>
                                            <div class="price">
                                                <?php echo $product->get_price_html(); ?>
                                            </div>
                                        </div>
                                        <div class="shop_now">
                                            <button class="btn btn-outline-light">SHOP NOW</button>
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
                    <button class="btn btn-outline-warning">SHOP NOW</button>
                </div>
            </div>
            <div class="col-md-9 cbd_video">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/cbd_prod_desc.png" alt="CBD"/>
            </div>
        </div>
    </div>
    <div class="cbd_amazing_products container">
        <div class="row">
            <div class="col-md-12 amazing_products">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/weMakeAmazingProducts.png" alt="CBD"/>
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
                                SHOP ALL PRODUCTS
                                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/next_button.gif"
                                     alt="Buy Noe"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="power_to_heal container d-flex align-items-center">
        <div class="col-md-8 d-flex">
            <img src="<?php echo get_stylesheet_directory_uri() ?>/images/power_to_heal.jpg" alt="The Power To Heal"/>
        </div>
        <div class="col-md-4 d-flex">
            <div class="power_to_heal_description">
                <?php
                echo $powerToHeal->post_content;
                ?>
            </div>
        </div>
    </div>
    <div class="the_magic_cbd">
    <div class="col-md-12 title">
        <img src="<?php echo get_stylesheet_directory_uri() ?>/images/the_magic_cbd.png" alt="Magic of cbd"/>
    </div>
    <div class="spectrum">
        <div class="full_spectrum">
            <div class="full_spectrum_text">
                <div class="text">
                    <?php
                    echo $fullSpectrum->post_content;
                    ?>
                </div>
                <div class="shopnow">
                    <button class="btn btn-outline-light">SHOP NOW</button>
                </div>
            </div>
        </div>
        <div class="customer_reviews">
            <div class="customer_photo">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/customer.jpg" alt="Customer"/>
            </div>
            <div class="customer_review">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/reviews.jpg" alt="Customer"/>
                <div class="review">
                    <?php
                    echo $customerReview->post_content;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="highest_quality">
        <div class="cultivate">
            <img src="<?php echo get_stylesheet_directory_uri() ?>/images/cultivate.jpg" alt="cultivate"/>
        </div>
        <div class="potency">
            <img src="<?php echo get_stylesheet_directory_uri() ?>/images/potency.jpg" alt="potency"/>
        </div>
    </div>
    <div class="highest_quality_procesing">
        <div class="extract">
            <img src="<?php echo get_stylesheet_directory_uri() ?>/images/extract.jpg" alt="Extract"/>
        </div>
        <div class="flavor">
            <img src="<?php echo get_stylesheet_directory_uri() ?>/images/flavor.jpg" alt="Flavor"/>
        </div>
    </div>
    <div class="colorados_finest_advantage">
        <div class="logo"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/colorados_drop_logo.png"
                               alt="Flavor"/></div>
        <div class="title"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/colorados_advantage_title.png"
                                alt="Flavor"/></div>
        <div class="description">
            <?php
            echo $coloradosFinestAdvantage->post_content;
            ?>
        </div>
        <div class="cta">
            <button class="btn btn-outline-warning">SHOP NOW</button>
        </div>
    </div>
    <div class="social_box">
        <div class="not_for_human">
            <div class="description">
                <div class="title"><?php echo $notJustForHuman->post_title; ?></div>
                <div class="pet_description">
                    <?php echo $notJustForHuman->post_content; ?>
                </div>
                <div class="read_more">
                    READ MORE
                </div>
            </div>
            <div class="photo">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/notforhumans.jpg" alt="Flavor"/>
            </div>
        </div>
    </div>
<?php
get_footer();
