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
                    Colorado's Finest maintains a modest and a simple approach to CBD production. Our mission is rooted in
                    our commitment to bring your purest life-changing products.
                    <div class="fda_notice">
                        The statements made regarding these products have not been evaluated by the Food and Drug
                        Administration. The efficacy of these products has not been confirmed by FDA-approved research.
                        These products are not intended to diagnose, treat, cure or prevent any disease. All information
                        presented here is not meant as a substitute or alternative to information from health care
                        practitioners. Please consult your health care professional about potential interactions or other
                        possible complications before using any product. The Federal Food, Drug and Cosmetic Act require
                        this notice.
                    </div>
                </div>
            </div>
            <div class="footer_menu">
                <ul>
                    <li>SHOP</li>
                    <li>Isolates</li>
                    <li>Distillate</li>
                    <li>Topical</li>
                    <li>THC Free</li>
                </ul>
            </div>
            <div class="footer_learn">
                <ul>
                    <li>LEARN ABOUT CBD</li>
                    <li>About Colorado's Finest</li>
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
                    <li>Contact Us</li>
                    <li>FAQ</li>
                    <li>My Account</li>
                    <li>Privacy Policy</li>
                    <li>Shipping & Returns</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer_footer">
        <?php echo date("Y"); ?> Colorado's Finest. All Right Reserved
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
