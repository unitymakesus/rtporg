<?php
/**
 * Header Template
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

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php // Google Tag Manager Script

	$tag_id = ot_get_option( 'google_tag_manager_id' );

	if ($tag_id) :

?>
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=<?php echo $tag_id; ?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TRS2N7');</script>
<?php endif; ?>


<!--[if lte IE 9]><p class="chromeframe">Your browser is ancient! <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

	<div class="header-container">
		<header class="wrapper group">
	        <?php

	        	$site_logo    = ot_get_option( 'primary_logo' );
	        	$blog_title   = esc_attr( get_bloginfo( 'name', 'display' ) );

	        ?>
			<?php if ( $site_logo ) : ?>
	        	<div class="logo">
	        		<a href="<?php echo home_url( '/' ); ?>" title="<?php echo $blog_title; ?>" rel="home">
	                	<img src="<?php echo $site_logo; ?>" />
	                </a>
	            </div>
	        <?php else: ?>
	            <div class="logo"><?php echo $blog_title; ?></div>
	        <?php endif; ?>

			<?php /* <div class="site-search"><?php get_search_form(); ?></div> */ ?>

			<?php if ( has_nav_menu('primary') ): ?>
		        <nav class="primary">
					<h2 class="visuallyhidden">Primary Navigation</h2>
					<?php wp_nav_menu(array(
						'theme_location' => 'primary',
						'container' => false
					)); ?>
		    	</nav>
			<?php endif; ?>
	    </header>
	</div>