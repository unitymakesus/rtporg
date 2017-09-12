<?php
/**
 * The front-end style guide.
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 */

get_header(); ?>

<?php
	$theme_dir = get_stylesheet_directory_uri();
	$time      = time();

	// Load style guide depenedant styles
	wp_enqueue_style( 'google-font', 'http://fonts.googleapis.com/css?family=Inconsolata', null, null, 'screen' );
	wp_enqueue_style( 'style-guide', $theme_dir . '/css/styleguide.css', null, '1.0.0.' . $time, 'screen' );
	wp_enqueue_style( 'highlight-css', 'http://yandex.st/highlightjs/8.0/styles/default.min.css', null, '1.0.0', 'screen' );
	wp_enqueue_style( 'highlight-github', 'http://yandex.st/highlightjs/8.0/styles/github.min.css', null, '1.0.0', 'screen' );
?>


<? //-- Navigation --// ?>
<nav class="style-guide-primary">
	<h1>Style Guide</h1>
	<ul>
		<li data-content="color-type"><a href="javascript:void(0);">Style</a></li>
		<li data-content="elements"><a href="javascript:void(0);">Elements</a></li>
		<li data-content="components">
			<a href="javascript:void(0);">Components</a>
			<ul>
				<li data-content="components-banners"><a href="javascript:void(0);">Banners</a></li>				
				<li data-content="components-social-tiles"><a href="javascript:void(0);">Social Tiles</a></li>
				<li data-content="components-social-media"><a href="javascript:void(0);">Social Media</a></li>
				<li data-content="components-general"><a href="javascript:void(0);">General</a></li>
				<li data-content="components-all"><a href="javascript:void(0);">All</a></li>
			</ul>
		</li>
	</ul>
</nav>


<? //-- Sections --// ?>
<?php get_template_part('style-guide/section-style'); ?>
<?php get_template_part('style-guide/section-elements'); ?>
<?php get_template_part('style-guide/section-components'); ?>


<? //-- Scripts --// ?>
<script>
	$(document).ready(function() {

		// Highlight Code Snippets
		hljs.initHighlightingOnLoad();

		// Organize Navigational Content
		$('.section').not('[data-content="color-type"]').hide();

		// Highlight Color-Type Nav Link + Content
		$('.style-guide-primary li[data-content="color-type"]').addClass('active');
		$('.section[data-content]').addClass('active');

		// Change Navigational Content
		$('.style-guide-primary > ul > li').click(function() {

			var content = $(this).attr('data-content');

			// Update Navigation
			$('.style-guide-primary li.active').removeClass('active');
			$(this).addClass('active');

			// Hide Active Content
			$('.section').removeClass('active').hide();

			// Show Active Content
			$('.section[data-content="' + content +'"]').fadeIn(250);

		});
		$('.style-guide-primary > ul > li > ul > li').click(function() {

			var content = $(this).attr('data-content');

			// Update Navigation
			$(this).siblings().removeClass('active');
			$(this).addClass('active');

			// Hide Active Content
			$('.section:visible article.component').removeClass('active').hide();

			// Show Active Content
			if(content == "components-all") {
				$('.section:visible article.component').fadeIn(250);
			}
			else {
				$('.section:visible article.component[data-content="' + content +'"]').fadeIn(250);	
			}			

		});

		// Animated Scroll to Secondary Nav
		// $('.style-guide-secondary li').click(function() {

		// 	var id = $(this).find('a').attr('href');
		// 	$('html, body').animate({ scrollTop: $(id).offset().top }, 1000);

		// 	return false;

		// });

	});
</script>
<?php get_footer(); ?>