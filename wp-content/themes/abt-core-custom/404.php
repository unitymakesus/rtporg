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
			<h2>Lost in Space</h2>
			<p>
				But seriously, we can't find the page you're looking for. Try searching for it below.</p>
			<div class="site-search"><?php get_search_form(); ?></div>
			<p><small><em>And if you're looking for a place to plant your flag...</em></small></p>
			<a class="button primary" href="/real-estate/" target="_blank">
				Find Available Space
			</a>
		</div>
	</div>

<?php get_footer(); ?>
