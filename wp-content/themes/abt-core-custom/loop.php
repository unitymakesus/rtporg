<?php
/**
 * The loop that displays posts.
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v0.9.3
 */

	global $post;
	$slug = get_post( $post )->post_name;
	$theme_dir = get_stylesheet_directory_uri();
    $landing_page_thumb = "";
?>

<?php if ( ! have_posts() ) : ?>
    <?php get_template_part( 'partials/posts', 'none' ); ?>
<?php endif; ?>

<?php
    /*
     * This page is not architected in such a way that you can reliably determine whether
     * any events were being displayed to the user. This is because the template was filtering
     * events (event date >= today's date) outside of wp_query. So, wp_query could/would return
     * event results, but in many cases we weren't displaying those results.
     *
     * In this situation, have_posts returns true, so the no results messaging wouldn't show up
     * since wp_query actually did return results, we simply chose not to display them due
     * to PHP filtering outside of the query.
     *
     * As a result, I've migrated 2 pieces of functionality out of this template:
     *
     * 1. The no results messaging is moved to partials/posts-none.php
     * 2. The events related functionality of this template was moved to a dedicated
     *      loop template (loop-event.php).
     */
?>

<section class="social-grid">
<?php while ( have_posts() ) : the_post(); ?>

	<?php
		$user_id      = get_the_author_meta( 'ID' );
		$user_obj     = get_userdata( $user_id );
        $user_role    = "";

        if($user_obj->roles) :
		  $user_role  = ($user_obj->roles[0] != "community-contributor") ? "rtp-contributor" : $user_obj->roles[0];
        endif;
		$display_role = ($user_role != "community-contributor") ? "RTP Contributor" : ucwords(str_replace("-", " ", $user_role));
		$thumb        = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
		$thumb_url    = ($thumb['0'] != null) ? 'style="background-image: url(' . $thumb["0"] . ');"' : '';
	?>

	<?php
		// For Posts from People Post Type
		// -------------------------------------------
		if ( $post->post_type == "people" ) :
	?>

		<?php
			$job_title = types_render_field("person-job-title", array("raw"=>"true"));
		?>
		<article class="source-local social-tile type-hybrid standard hentry person" <?php echo $thumb_url; ?>>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<p class="role"><?php echo $job_title; ?></p>
			<a href="<?php the_permalink(); ?>" rel="bookmark">View Program</a>
		</article>

	<?php
		// For Posts from Programs Post Type
		// -------------------------------------------
		elseif ( $post->post_type == "program" ) :
	?>

		<article class="source-local social-tile type-hybrid standard hentry program" <?php echo $thumb_url; ?>>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-summary"><?php echo get_the_program_excerpt(); ?></div>
			<a href="<?php the_permalink(); ?>" rel="bookmark">View Program</a>
		</article>

	<?php
		// For Posts from Events Post Type
		// -------------------------------------------
		elseif ( $post->post_type == "event" ) :
	?>
        <?php
            // WARNING WARNING WARNING WARNING WARNING
            //
            //
            // This case should be deprecated. I am leaving the code in place for now, but
            // you should know that if you're using the loop and displaying only events
            // please use the event specific loop template (loop-event.php).
        ?>
        <!-- If you're seeing this message, you need to update your theme. Do not use this template to display events -->
        <script type="text/javascript">
            if (!(typeof console === "undefined")) {
                console.log("If you're seeing this message, you need to update your theme. Do not use this template to display events");
            }
        </script>
		<?php
			$user_id      = get_the_author_meta( 'ID' );
			$user_obj     = get_userdata( $user_id );
			$user_role    = ($user_obj->roles[0] != "community-contributor") ? "rtp-contributor" : $user_obj->roles[0];
			$display_role = ($user_role != "community-contributor") ? "RTP Contributor" : ucwords(str_replace("-", " ", $user_role));
			$thumb        = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
			$thumb_url    = ($thumb['0'] != null) ? 'style="background-image: url(' . $thumb["0"] . ');"' : '';
			$landing_page_thumb = types_render_field("landing_page_image", array("raw"=>"true"));
			$location     = types_render_field("event-location", array("raw"=>"true"));
			$sponsor      = types_render_field("event-organization-sponsor", array("raw"=>"true"));
			$today		  = date('Y-m-d');
			$start_time   = types_render_field("event-start-date-and-time", array("format"=>"M j g:i a"));
			$date_time    = types_render_field("event-start-date-and-time", array("format"=>"Y-m-d"));
		?>
		<?php if ($date_time >= $today) : ?>

			<?php if($landing_page_thumb) : ?>
				<article class=" source-local social-tile type-hybrid standard hentry post" style="background-image: url('<?php echo $landing_page_thumb; ?>');" itemscope itemtype="http://data-vocabulary.org/Event">
			<?php else : ?>
				<article class=" source-local social-tile type-hybrid standard hentry post" <?php echo $thumb_url; ?> itemscope itemtype="http://data-vocabulary.org/Event">
			<?php endif; ?>
				<h1 class="entry-title" itemprop="summary"><?php the_title(); ?></h1>
				<time class="start-date" itemprop="startDate" datetime="<?php echo $date_time; ?>"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_events.svg" /> <?php echo $start_time; ?></time>
				<div class="location" itemprop="location">
					<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_location.svg" /> <?php echo $location; ?>
				</div>
				<div class="options">
					<button class="open-options"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_options-right.svg" /></button>
					<ul>
						<li data-option="favorite">
							<span class="label" title="Favorite">
								<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_info.svg" />
								<span class="visuallyhidden">Info</span>
							</span>
							<div class="panel">
								<h3>Summary</h3>
								<p><strong>Date</strong><br><?php echo $start_time; ?></p>
								<p><strong>Location</strong><br><?php echo $location; ?></p>
								<p><strong>Sponsor</strong><br><?php echo $sponsor; ?></p>
							</div>
						</li>
						<li data-option="share">
							<span class="label" title="Share">
								<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_share.svg" />
								<span class="visuallyhidden">Share</span>
							</span>
							<div class="panel">
								<h3>Share</h3>
								<ul class="share rrssb-buttons">
	                                <li class="facebook">
	                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="popup" target="_blank">
		                                    <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_facebook.svg" />
	                                    </a>
	                                </li>
	                                <li class="twitter">
	                                    <a href="http://twitter.com/home?status=<?php the_title(); ?>%20<?php the_permalink(); ?>" class="popup" target="_blank">
	                                    	<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_twitter.svg" />
	                                    </a>
	                                </li>
	                                <li class="google">
	                                    <a href="https://plus.google.com/share?url=<?php the_title(); ?>%20<?php the_permalink(); ?>" class="popup" target="_blank">
	                                    	<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_google.svg" />
	                                    </a>
	                                </li>
	                            </ul>
							</div>
						</li>
						<li data-option="source">
							<span class="label" title="Source">
								<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_source.svg" />
								<span class="visuallyhidden">Source</span>
							</span>
							<div class="panel">
								<h3>Source</h3>
								<a class="button secondary" href="<?php the_permalink(); ?>"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_source.svg" /> View Article</a>
							</div>
						</li>
						<li data-option="author">
							<span class="label" title="Author">
								<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_about-us.svg" />
								<span class="visuallyhidden">Author</span>
							</span>
							<div class="panel">
								<h3>Author</h3>
								<div class="author">
									<?php echo get_avatar( $user_id, apply_filters( 'abtcore_author_bio_avatar_size', 60 ) ); ?>

									<?php /*if ( has_wp_user_avatar($user_id) ) {
										echo get_wp_user_avatar($user_id, 48);
									} else {
										echo '<img class="svg" src="' . $theme_dir . '/img/icons/i_about-us.svg" />';
									}*/ ?>
									<strong><?php the_author_posts_link(); ?></strong><br />
									<span class="badge <?php echo $user_role; ?>"><?php echo $display_role; ?></span>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<a itemprop="url" href="<?php the_permalink(); ?>" rel="bookmark">View Event</a>
			</article>
		<?php endif; ?>

	<?php
		// For Posts from Locations Post Type
		// -------------------------------------------
		elseif ( $post->post_type == "location" ) :
	?>

		<?php
			$address1 = types_render_field("location-address-line-1", array("raw"=>"true"));
			$address2 = types_render_field("location-address-line-2", array("raw"=>"true"));
			$city     = types_render_field("location-city", array("raw"=>"true"));
			$zip      = types_render_field("location-zip-code", array("raw"=>"true"));
		?>
		<article class="source-local social-tile type-hybrid standard hentry location" <?php echo $thumb_url; ?>>
			<div class="photo"><img src="<?php echo $thumb["0"]; ?>" /></div>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="adr">
				<?php if ($address1) : ?>
					<?php echo $address1; ?> <?php echo $address2; ?><br />
					<?php echo $city; ?>, NC <?php echo $zip; ?>
				<?php else : ?>
					No Address Currently<br/> At This Time
				<?php endif; ?>
			</div>
			<a href="<?php the_permalink(); ?>" rel="bookmark">View Location</a>
		</article>

	<?php
		// For Posts from Locations Post Type
		// -------------------------------------------
		elseif ( $post->post_type == "post" ) :
	?>

			<?php if($landing_page_thumb) : ?>
				<article class="source-local social-tile type-hybrid standard hentry <?php echo get_post_type( $post ) ?>" style="background-image: url('<?php echo $landing_page_thumb; ?>');">
			<?php else : ?>
				<article class="source-local social-tile type-hybrid standard hentry <?php echo get_post_type( $post ) ?>" <?php echo $thumb_url; ?>>
			<?php endif; ?>

			<h1 class="entry-title"><?php the_title(); ?></h1>
			<time class="published" datetime="2014-11-12">
				<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_clock.svg" /> <?php the_time('M d, Y'); ?>
			</time>
			<div class="options">
				<button class="open-options"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_options-right.svg" /></button>
				<ul>
					<li data-option="favorite">
						<span class="label" title="Favorite">
							<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_favorite-active.svg" />
							<span class="visuallyhidden">Favorite</span>
						</span>
						<div class="panel">
							<h3><?php _e('Comments', 'abtcore'); ?></h3>
							<div class="likes" data-disqus-url="<?php the_permalink(); ?>"></div>
						</div>
					</li>
					<li data-option="share">
						<span class="label" title="Share">
							<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_share.svg" />
							<span class="visuallyhidden">Share</span>
						</span>
                        <div class="panel">
                            <h3>Share</h3>
                            <ul class="share rrssb-buttons">
                                <li class="facebook">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="popup" target="_blank">
	                                    <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_facebook.svg" />
                                    </a>
                                </li>
                                <li class="twitter">
                                    <a href="http://twitter.com/home?status=<?php the_title(); ?>%20<?php the_permalink(); ?>" class="popup" target="_blank">
                                    	<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_twitter.svg" />
                                    </a>
                                </li>
                                <li class="google">
                                    <a href="https://plus.google.com/share?url=<?php the_title(); ?>%20<?php the_permalink(); ?>" class="popup" target="_blank">
                                    	<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_google.svg" />
                                    </a>
                                </li>
                            </ul>
                        </div>
					</li>
					<li data-option="source">
						<span class="label" title="Source">
							<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_source.svg" />
							<span class="visuallyhidden">Source</span>
						</span>
						<div class="panel">
							<h3>Source</h3>
							<a class="button secondary" href="<?php the_permalink(); ?>"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_source.svg" /> View Article</a>
						</div>
					</li>
					<li data-option="author">
						<span class="label" title="Author">
							<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_about-us.svg" />
							<span class="visuallyhidden">Author</span>
						</span>
						<div class="panel">
							<h3>Author</h3>
							<div class="author">
								<?php echo get_avatar( $user_id, apply_filters( 'abtcore_author_bio_avatar_size', 60 ) ); ?>

								<?php /*if ( has_wp_user_avatar($user_id) ) {
									echo get_wp_user_avatar($user_id, 48);
								} else {
									echo '<img class="svg" src="' . $theme_dir . '/img/icons/i_about-us.svg" />';
								}*/ ?>
								<strong><?php the_author_posts_link(); ?></strong><br />
								<span class="badge <?php echo $user_role; ?>"><?php echo $display_role; ?></span>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<a href="<?php the_permalink(); ?>" rel="bookmark">View Article</a>
		</article>

	<?php
		// For Pages
		// -------------------------------------------
		elseif ( $post->post_type == "page" ) :
	?>

		<?php
			$banner_graphic = types_render_field("banner-graphic", array("raw"=>"true"));
			$apply_graphic  = ($banner_graphic != '') ? 'style="background-image: url(' . $banner_graphic .');"' : '';
		?>
		<article class="source-local social-tile type-hybrid standard hentry page" <?php echo $apply_graphic; ?>>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<a href="<?php the_permalink(); ?>" rel="bookmark">View Page</a>
		</article>

	<?php endif; ?>

<?php endwhile; ?>
</section>

<?php if (function_exists("pagination")) {
	// pagination($additional_loop->max_num_pages);
} ?>
