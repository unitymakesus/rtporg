<?php
/**
 * The Sidebar search form
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 */
?>

<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" >
	<div class="field">
    	<label class="access" for="s">Search For</label>
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Search" />
		<input id="searchsubmit" class="button" type="submit" value="Search" />
	</div>
</form>