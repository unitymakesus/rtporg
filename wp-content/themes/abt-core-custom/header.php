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
<?php

	$walker     = new Menu_With_Description;
	$theme_dir  = get_stylesheet_directory_uri();

	$site_logo  = ot_get_option( 'primary_logo' );
	$blog_title = esc_attr( get_bloginfo( 'name', 'display' ) );
	$twitter    = ot_get_option( 'twitter_profile' );
	$youtube    = ot_get_option( 'youtube_profile' );
	$google     = ot_get_option( 'google_plus_profile' );
	$linkedin   = ot_get_option( 'linkedin_profile' );

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
<?php if (is_home() || is_front_page()) : ?>
<body <?php body_class(); ?> data-default-menu-size="maximized">
<?php else : ?>
<body <?php body_class(); ?> data-default-menu-size="minimized">
<?php endif; ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K3PZ6P"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<?php
		if ( (is_home() || is_front_page()) && function_exists('should_run_tutorial') && should_run_tutorial()) {
			get_template_part('tutorial');
		}
	?>
	<div id="st-container" class="st-container">
		<div class="st-menu st-toggle">
			<?php if ( $site_logo ) : ?>
				<div class="logo">
					<a href="<?php echo home_url( '/' ); ?>" title="Home" rel="home">
						<img class="svg" src="<?php echo $site_logo; ?>" alt="<?php echo $blog_title; ?>" />
						<span class="label"><?php echo $blog_title; ?></span>
					</a>
				</div>
			<?php else: ?>
				<div class="logo"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo $blog_title; ?>" rel="home"><?php echo $blog_title; ?></a></div>
			<?php endif; ?>
			<div class="site-search"><?php get_search_form(); ?></div>
			<?php if ( has_nav_menu('primary') ): ?>
				<nav class="primary">
					<h2 class="visuallyhidden">Primary Navigation</h2>
					<?php wp_nav_menu(array(
						'theme_location' => 'primary',
						'container'      => false,
						'walker'         => $walker
					)); ?>
				</nav>
			<?php endif; ?>
			<?php if ( $twitter || $youtube || $google || $linkedin ): ?>
				<ul class="follow">
					<?php if ($twitter) : ?>
						<li class="twitter"><a href="<?php echo $twitter; ?>" target="_blank"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_twitter.svg" /><span>Twitter</span></a></li>
					<?php endif; ?>
					<?php if ($google) : ?>
						<li class="google"><a href="<?php echo $google; ?>" target="_blank"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_google.svg" /><span>Google+</span></a></li>
					<?php endif; ?>
					<?php if ($linkedin) : ?>
						<li class="linkedin"><a href="<?php echo $linkedin; ?>" target="_blank"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_linkedin.svg" /><span>LinkedIn</span></a></li>
					<?php endif; ?>
					<?php if ($youtube) : ?>
						<li class="youtube"><a href="<?php echo $youtube; ?>" target="_blank"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_youtube.svg" /><span>YouTube</span></a></li>
					<?php endif; ?>
				</ul>
			<?php endif; ?>
		</div>
		<div class="st-pusher">
			<div class="st-content">
				<div class="st-content-inner">
					<div id="st-trigger-effects" class="st-trigger-effects">
						<button class="menu-toggle" data-effect="st-toggle"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_menu.svg" /> <span class="visuallyhidden">Menu</span></button>
						<img class="svg" src="<?php echo $site_logo; ?>" alt="<?php echo $blog_title; ?>" />
					</div>
