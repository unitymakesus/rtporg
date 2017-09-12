<?php

if ( ! function_exists( 'abtcore_excerpt_length' ) ) :
/**
 * Sets the post excerpt length to a previously set custom number of words.
 *
 * @since ABT Core v0.9.4
 * @return int
 */
function abtcore_excerpt_length( $length ) {
	global $abtcore_custom_excerpt_length;
	return ($abtcore_custom_excerpt_length === false) ? $length : $abtcore_custom_excerpt_length;
}
/**
 * ONLY Use this function if you want a specific length for truncating the_excerpt. Otherwise use get_the_excerpt to default to your theme's excerpt_length.
 *
 * @since ABT Core v0.9.4
 * @return excerpt
 */
function abtcore_get_the_excerpt( $length ) {
	global $abtcore_custom_excerpt_length;
	$abtcore_custom_excerpt_length = $length;

	add_filter( 'excerpt_length', 'abtcore_excerpt_length', 20 );

	$result = get_the_excerpt();
	$abtcore_custom_excerpt_length = false; // remove from scope so subsequent calls are not affected.

	return $result;
}
/**
 * ONLY Use this function if you want a specific length for truncating the_excerpt. Otherwise use the_excerpt to default to your theme's excerpt_length.
 *
 * @since ABT Core v0.9.4
 */
function abtcore_the_excerpt( $length ) {
	print abtcore_get_the_excerpt( $length );
}
endif;

if ( ! function_exists( 'abtcore_continue_reading_link' ) ) :
/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since ABT Core v0.9.3
 * @return string "Continue Reading" link
 */
function abtcore_continue_reading_link() {
	return ' <a href="'. get_permalink() . '" class="more-link">' . __( 'Continue reading', 'abtcore' ) . '</a>';
}
endif;

if ( ! function_exists( 'abtcore_auto_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and abtcore_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since ABT Core v0.9.3
 * @return string An ellipsis
 */
function abtcore_auto_excerpt_more( $more ) {
	return ' &hellip;' . abtcore_continue_reading_link();
}
endif;
add_filter( 'excerpt_more', 'abtcore_auto_excerpt_more' );

if ( ! function_exists( 'abtcore_custom_excerpt_more' ) ) :
/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since ABT Core v0.9.3
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function abtcore_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= abtcore_continue_reading_link();
	}
	return $output;
}
endif;
add_filter( 'get_the_excerpt', 'abtcore_custom_excerpt_more' );


if ( ! function_exists( 'abtcore_remove_recent_comments_style' ) ) :
/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since ABT Core v0.9.3
 */
function abtcore_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
endif;
add_action( 'widgets_init', 'abtcore_remove_recent_comments_style' );

if ( ! function_exists( 'abtcore_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since ABT Core v0.9.3
 */
function abtcore_posted_on() {
	printf( __( '%2$s <span class="by-author"><span class="meta-sep">by</span> %3$s</span>', 'abtcore' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark" class="timestamp"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			'<span class="month">' . get_the_date('M') . '</span> <span class="day">' . get_the_date('d') . '</span> <span class="year">' . get_the_date('Y')
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'abtcore' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'abtcore_index_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since ABT Core v0.9.3
 */
function abtcore_loop_posted_on() {
	printf( __( '%2$s <span class="by-author"><span class="meta-sep">by</span> %3$s</span>', 'abtcore' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark" class="timestamp"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			'<span class="month">' . get_the_date('M') . '</span> <span class="day">' . get_the_date('d') . '</span> <span class="year">' . get_the_date('Y') . '</span>'
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'abtcore' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;



if ( ! function_exists( 'abtcore_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since ABT Core v0.9.3
 */
function abtcore_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'abtcore' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'abtcore' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'abtcore' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

if ( ! function_exists( 'abtcore_get_the_password_form' ) ) :
/**
 * Retrieve protected post password form content.
 *
 * @since ABT Core v0.9.3
 * @uses apply_filters() Calls 'the_password_form' filter on output.
 *
 * @return string HTML content for password form for password protected post.
 */
function abtcore_get_the_password_form() {
	global $post;
	$label = 'pwbox-'.(empty($post->ID) ? rand() : $post->ID);
	$output = '<form action="' . get_option('siteurl') . '/wp-pass.php" method="post" class="password-protected">
	<p>' . __("This post is password protected. To view it please enter your password below:") . '</p>
	<div class="field"><label for="' . $label . '">Password:</label> <input name="post_password" id="' . $label . '" type="password" size="20" /> <input type="submit" name="Submit" value="' . esc_attr__("Submit") . '" class="submit" /></div>
	</form>
	';
	return apply_filters('the_password_form', $output);
}
endif;

if ( ! function_exists( 'abtcore_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own abtcore_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since ABT Core v0.9.3
 */
function abtcore_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><div class="comment-tip"></div>
	<article id="comment-<?php comment_ID(); ?>" class="comment-inner">
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="moderation-message"><?php _e( 'Your comment is awaiting moderation.', 'abtcore' ); ?></em>
		<?php endif; ?>
        <div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<h3><?php printf( __( '%s <span class="says">says:</span>', 'abtcore' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></h3>
		</div><!-- .comment-author .vcard -->


		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'abtcore' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'abtcore' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</article><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'abtcore' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'abtcore'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;


if ( ! function_exists( 'limit_text' ) ) :
/**
 * Adds function for limiting/truncating text during loop
 *
 * @since ABT Core v0.9.5
 */
function limit_text($text, $limit, $after = '...') {
	$words = str_word_count($text, 2);
	if($limit >= count($words)) return $text;

	$pos = array_keys($words);
	$text = substr($text, 0, $pos[$limit]) . $after;

    return $text;
}
endif;

class WPh_Pagination {
	/**
	 * Get the total number of pages, given a limit-per-page and total result count
	 * @param int $limit
	 * @param int $totalResults
	 */
	static function pages($limit, $totalResults){
		return ceil($totalResults/$limit);
	}//----    end function totalPages
	/**
	* get the current page, according to the $wp_query
	*/
	static function current(){
		//optional paging
		global $wp_query;
		$currentPage = $wp_query->query_vars['paged'];
		if(!($currentPage > 1)){ $currentPage = 1; }
		return $currentPage;
	}//----    end function currentPage
	/**
	* Pagination wrapper for custom query
	* @param int $current page
	* @param int $limit how many to show per page
	* @param int $totalResults how many total results in all
	*
	* @see http://codex.wordpress.org/Function_Reference/paginate_links
	*/
	static function links($limit, $totalResults){

		//use add_query_arg instead of page/#, because 1st page won't use format?
		$args = array(
			'base' => @add_query_arg('paged','%#%')    #get_permalink(50) . '%_%'
			, 'format' => ''    #page/%#%?' . $_SERVER['QUERY_STRING']
			, 'total' => self::pages($limit, $totalResults)
			, 'current' => self::current()
			, 'show_all' => false        //show all pages, instead of ... list
			, 'end_size' => 1            //number of pages at the ends of the list, like:  prev 1 ... xxxxx .... {n-1} next
			, 'mid_size' => 2            //number of pages on either side of current page, like  ... {c-2} {c-1} c {c+1} {c+2} ...
			, 'prev_next' => true        //show prev/next links
			#, 'prev_text'
			#, 'next_text'
			, 'type' => 'list'            //format of list -- plain, array, list
		);

		return paginate_links($args);

	}
}



if ( ! function_exists( 'abtcore_block' ) ) :
/**
 * alias to abtcore_multiblock::fetch and ::fetchNth
 * @param $selector either the block's numeric index or the block's title
 */
/*function abtcore_block($selector){
	if(is_numeric($selector)) return abtcore_multiblock::fetchNth($selector);

	return abtcore_multiblock::fetch($selector);
}*/
endif;

if ( ! function_exists( 'abtcore_blocks_reset' ) ) :
/**
 * Clear saved blocks from "cache"
 *
 * alias to abtcore_multiblock::reset
 * @param $selector either the block's numeric index or the block's title
 * @param int $postId the post id to get content from; if not given use the current post
 */
/*function abtcore_blocks_reset(){
	return abtcore_multiblock::reset();
}*/
endif;

if ( ! function_exists( 'fido' ) ) :
/**
 * Written for Guess, since he likes dogs.
 * alias to abtcore_multiblock::fetch and ::fetchNth
 * @param $selector either the block's numeric index or the block's title
 */
/*function fido($selector){
	echo abtcore_block($selector);
}*/
endif;

if ( ! function_exists( 'the_block' ) ) :
/**
 * Echoes abtcore_block
 *
 * @param $selector either the block's numeric index or the block's title
 */
/*function the_block($selector){
	echo abtcore_block($selector);
}*/
endif;


?>