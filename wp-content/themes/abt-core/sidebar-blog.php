<?php
/**
 * The Sidebar containing the blog widget areas and menus.
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v0.9.3
 */
?>

<?php if ( is_active_sidebar( 'posts-widget-area' ) ) : ?>
	<div class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'posts-widget-area' ); ?>
	</div>
<?php endif; ?>