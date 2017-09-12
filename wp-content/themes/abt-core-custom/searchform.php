<?php
/**
 * The Sidebar search form
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 */
?>
<?php
	$theme_dir = get_stylesheet_directory_uri();
?>

<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" >
	<div class="field">
		<label for="s"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_search.svg" /> <span class="visuallyhidden">Search</span></label>
		<input type="search" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Search..." />
		<input id="searchsubmit" type="submit" value="Search" />
	</div>
</form>