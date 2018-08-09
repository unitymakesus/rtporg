<?php
/**
 * Footer Template
 *
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 */
?>
    </div><!-- #content -->

    <div id="footer-container-new" class="footer-container-new">
        <footer class="group">
            <section class="band theme-orange pad-none fade-in">
                <div class="wrapper">
                    <a href="/contact-us/" class="contact-footer">
                        <p>Help Us Write The Next Chapter</p>
                        <strong>Contact us today</strong>
                        <div class="hexagon">
                          <?php echo file_get_contents(get_stylesheet_directory() . "/img/g_contact-hexagon.svg"); ?>
                        </div>
                    </a>

                    <?php if ( has_nav_menu('footer') ) : ?>
                        <?php wp_nav_menu( array(
                            'theme_location' => 'footer',
                            'container' => false
                        )); ?>
                    <?php endif; ?>

                    <?php if ( has_nav_menu('social-footer') ) : ?>
                        <?php wp_nav_menu( array(
                            'theme_location' => 'social-footer',
                            'container' => false
                        )); ?>
                    <?php endif; ?>
                </div>
            </section>
        </footer>
    </div>
</div><!-- #page -->

<?php wp_footer(); ?>
<div id="outdated"></div>

</body>
</html>
