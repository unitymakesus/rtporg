<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v0.9.3
 */

get_header(); ?>

<?php
	$theme_dir = get_stylesheet_directory_uri();
?>

	<div class="content-container">
		<div class="content">
			<h1>404 Error</h1>
			<h2>You must have been looking for Bubba!</h2>
			<p>
				But seriously, we can't find the page you're looking for. Try searching for it below.<br>
				We recently redesigned our website, so please contact us if you need assistance at parkinfo@rtp.org.
			</p>
			<div class="site-search"><?php get_search_form(); ?></div>
			<p><small><em>And if you're still looking for Bubba...</em></small></p>
			<a class="button primary" href="https://twitter.com/GoatBubba" target="_blank">
				<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_twitter.svg" />
				Follow Bubba
			</a>
		</div>
	</div>

<?php get_footer(); ?>