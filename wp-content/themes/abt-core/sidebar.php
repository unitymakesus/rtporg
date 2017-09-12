<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v0.9.3
 */
?>

<?php if ( is_active_sidebar( 'pages-widget-area' ) ) : ?>
	<div class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'pages-widget-area' ); ?>
	</div>
<?php endif; ?>