<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package coloradosfinest
 */

?>

</div><!-- #content -->

<footer>
    <div class="footer_margin">
        ksdfjsdk
    </div>
    <div class="foo">
        <div class="footer">
            <div class="footer_description">
                <div class="logo">
                    <img src="<?php echo get_stylesheet_directory_uri() ?>/images/white_logo.png"
                         alt="Flavor"/>
                </div>
                <div class="footer_description_text">
                    Colorado's Finest maintains a modest and a simple approach to CBD production. Our mission is rooted
                    in
                    our commitment to bring your purest life-changing products.
                    <div class="fda_notice">
                        The statements made regarding these products have not been evaluated by the Food and Drug
                        Administration. The efficacy of these products has not been confirmed by FDA-approved research.
                        These products are not intended to diagnose, treat, cure or prevent any disease. All information
                        presented here is not meant as a substitute or alternative to information from health care
                        practitioners. Please consult your health care professional about potential interactions or
                        other
                        possible complications before using any product. The Federal Food, Drug and Cosmetic Act require
                        this notice.
                    </div>
                </div>
            </div>
            <div class="footer_menu">
                <ul>
                    <li><a href="shop">SHOP</a></li>
                    <?php do_action('footer_list'); ?>
                </ul>
            </div>
            <div class="footer_learn">
                <ul>
                    <li><a href="blog">ABOUT CBD</a></li>
                    <li><a href="about-us">About Colorado's Finest</a></li>
                    <li>Isolate Vs Distillate</li>
                    <li>Endocannabinoid System</li>
                    <li>Our Process</li>
                    <li>Recent Features</li>
                    <li>News</li>
                </ul>
            </div>
            <div class="footer_help">
                <ul>
                    <li>GET HELP</li>
                    <li><a href="contact">Contact Us</a></li>
                    <li><a href="frequently-asked-cbd-questions">FAQ</a></li>
                    <!--                    <li>My Account</li>-->
                    <li><a href="privacy-policy">Privacy Policy</a></li>
                    <li><a href="return-policy">Shipping & Returns</a></li>
                    <li class="heading">Follow Us</li>
                    <div class="row">
                        <div class="col-md-3 col-sm-3 social_logos"><a
                                    href="https://www.facebook.com/Colorados-Finest-CBD-Site-109879910456359"
                                    target="_blank"><img
                                        src="<?php echo get_stylesheet_directory_uri() ?>/images/facebook.svg"
                                        alt="Facebook" class="self-align-image"></a></div>
                        <div class="col-md-3  col-sm-3 social_logos"><a href="https://twitter.com/ColoradosCbd"
                                                                        target="_blank"><img
                                        src="<?php echo get_stylesheet_directory_uri() ?>/images/twitter.svg"
                                        alt="Twitter"></a>
                        </div>
                        <div class="col-md-3  col-sm-3 social_logos"><a
                                    href="https://www.instagram.com/colorados_finest_cbd/" target="_blank"><img
                                        src="<?php echo get_stylesheet_directory_uri() ?>/images/instagram.svg"
                                        alt="Instagram" class="self-align-image"></a></div>
                        <div class="col-md-3  col-sm-3 social_logos"><a
                                    href="https://www.youtube.com/channel/UC39vzCcYqgOkP1UfXG2T2ww" target="_blank"><img
                                        src="<?php echo get_stylesheet_directory_uri() ?>/images/youtube.svg"
                                        alt="Youtube" class="self-align-image">
                            </a>
                        </div>
                    </div>


                </ul>
            </div>
        </div>
        <div class="visa-mastercard text-center d-flex justify-content-end pr-4 align-items-center">
            <img src="<?php echo get_stylesheet_directory_uri() ?>/images/mastercard.svg"
                 alt="We accept Visa/Mastercard" style="height:50px; width:auto; margin-right: 1rem">
            <img src="<?php echo get_stylesheet_directory_uri() ?>/images/visa.svg" alt="We accept Visa/Mastercard"
                 style="height:25px; width:auto;">
        </div>
    </div>
    <div class="footer_footer">
        <?php echo date("Y"); ?> Colorado's Finest. All Right Reserved
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
