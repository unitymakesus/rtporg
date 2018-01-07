<?php
/**
 * Header New Template - 2017-03-27
 *
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <?php get_template_part( 'header','meta' ); ?>
  <base href="/">
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-K3PZ6P');</script>
  <!-- End Google Tag Manager -->
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K3PZ6P"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="page" class="site">
    <a class="skip-link screen-reader-text visuallyhidden" href="#content"><?php esc_html_e( 'Skip to content', 'rtp' ); ?></a>

    <header id="masthead" class="site-header headroom" role="banner">
        <div class="site-branding">
            <div class="site-logo-icon">
              <?php echo file_get_contents(get_stylesheet_directory() . "/img/l_rtp-icon.svg"); ?>
            </div>
            <div class="site-logo-tagline">
              <?php echo file_get_contents(get_stylesheet_directory() . "/img/l_rtp-tagline.svg"); ?>
            </div>
        </div><!-- .site-branding -->

        <nav id="site-navigation" class="main-navigation" role="navigation">
            <div class="menu-extra-buttons">
                <a class="button ghost" href="<?php echo get_permalink(get_page_by_path('about-us/the-frontier')); ?>">The Frontier</a>
                <a class="button ghost" href="<?php echo get_permalink(get_page_by_path('real-estate')); ?>">Real Estate</a>
            </div>
            <div class="menu-toggle-buttons">
                <button class="menu-toggle-btn ghost" aria-controls="primary-menu" aria-expanded="false"><span><?php esc_html_e( 'Menu', 'rtp' ); ?></span></button>
            </div>
            <div class="menu-global-wrapper">
            <?php
                $theme_dir = get_stylesheet_directory_uri();
            ?>
            <?php wp_nav_menu(
                array( 'theme_location' => 'primary',
                    'menu_id' => 'primary-menu',
                    'menu_class' => 'site-menu',
                    'items_wrap' => '<div class="menu-wrapper">
                        <form role="search" method="get" id="menusearch" action="'. home_url( '/' ).'" >
                            <div class="field">
                                <label for="s"><span class="visuallyhidden">Search</span></label>
                                <input type="search" name="s" id="s" placeholder="Search..." />
                                <input id="menusearchsubmit" class="menu-search-btn" type="submit" value="Search" />
                                <span class="magnifying-glass"></span>
                            </div>
                        </form>
                        <ul id="%1$s" class="%2$s">%3$s</ul>
                    </div>')
                ); ?>
            <?php if ( has_nav_menu('footer') ) : ?>
                <?php wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'container' => false,
                )); ?>
            <?php endif; ?>


            <div class="wrapper">
                <p class="copyright">Copyright &copy; <?php echo date("Y") ?> <?php bloginfo( 'name' ); ?>.<br /> All Rights Reserved.</p>

                <?php if ( has_nav_menu('social-footer') ) : ?>
                    <?php wp_nav_menu( array(
                        'theme_location' => 'social-footer',
                        'container' => false
                    )); ?>
                <?php endif; ?>
            </div>

            </div>
        </nav><!-- #site-navigation -->

    </header><!-- #masthead -->

    <div id="content" class="site-content">
