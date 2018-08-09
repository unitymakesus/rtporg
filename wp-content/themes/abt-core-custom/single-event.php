<?php
/**
 * Event (Single Entry)
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 *
 */

get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php
			$theme_dir     = get_stylesheet_directory_uri();
			$user_id       = get_the_author_meta( 'ID' );
			$user_obj      = get_userdata( $user_id );
			$user_role     = ($user_obj->roles[0] == "contributor") ? "rtp-contributor" : $user_obj->roles[0];
		  $display_role  = ($user_role == "administrator") ? "Author" : ucwords(str_replace("-", " ", $user_role));
			$start_date    = types_render_field("event-start-date-and-time", array("format"=>"M j g:i a"));
			$end_date      = types_render_field("event-end-date-and-time", array("format"=>"M j g:i a"));
			$sponsor       = types_render_field("event-organization-sponsor", array("raw"=>"true"));
			$description   = types_render_field("event-description", array("raw"=>"true"));
			$location      = types_render_field("event-location", array("raw"=>"true"));
			$website       = types_render_field("event-website", array("raw"=>"true"));
			$contact_name  = types_render_field("event-contact-name", array("raw"=>"true"));
			$contact_email = types_render_field("event-contact-email", array("raw"=>"true"));
			$logo          = types_render_field("event-logo", array("raw"=>"true"));
			$thumb         = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
			$thumb_url     = ($thumb['0'] != null) ? 'style="background-image: url(' . $thumb["0"] . ');"' : '';
		?>
		<div class="content-container">
			<?php get_template_part('featured', 'banners'); ?>
			<div class="breadcrumbs">
			    <?php if(function_exists('bcn_display')) {
			    	bcn_display();
			    } ?>
			</div>
	    	<div class="content-wrapper" itemscope itemtype="http://data-vocabulary.org/Event">
		    	<div class="content">
					<article id="post-<?php the_ID(); ?>" class="post">
						<header>
							<div class="cat-links" itemprop="eventType"><?php the_category( ', ' ); ?></div>
							<h2 class="entry-title" itemprop="summary"><?php the_title(); ?></h2>
							<div class="meta">
								<span itemprop="location"><?php echo $location; ?></span>
								<span class="timestamp">
									<span itemprop="startDate"><?php echo $start_date; ?></span> - <span itemprop="endDate"><?php echo $end_date; ?></span>
								</span>
							</div>
						</header>
						<div class="entry-content">
							<div itemprop="description"><?php echo do_shortcode($description); ?></div>
							<?php if ($website) : ?>
								<a class="button primary" href="<?php echo $website; ?>" itemprop="url" target="_blank">Visit Event Website</a>
							<?php endif; ?>
						</div>
					</article>
				</div>
		        <aside class="aside">
					<section class="meta">
						<?php if ($logo && $sponsor) : ?>
							<h3>Event Sponsor</h3>
							<div class="logo-sponsor"><img src="<?php echo $logo; ?>" alt="<?php echo $sponsor; ?>" /></div>
						<?php elseif ($sponsor) : ?>
							<h3>Event Sponsor</h3>
							<p><?php echo $sponsor; ?></p>
						<?php endif; ?>

						<?php if ($contact_name) : ?>
							<h3>Event Contact</h3>
							<p><?php echo $contact_name; ?><br>
								<?php if ($contact_email) : ?>
									<a href="mailto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a>
								<?php endif; ?>
							</p>
						<?php endif; ?>
						<div class="panel">
							<h3>Share Event</h3>
								<ul class="share rrssb-buttons">
										<li class="facebook">
												<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="popup" target="_blank" rel="nofollow noopener">
														<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_facebook.svg" />
												</a>
										</li>
										<li class="twitter">
												<a href="http://twitter.com/home?status=<?php the_title(); ?>%20<?php the_permalink(); ?>" class="popup" target="_blank" rel="nofollow noopener">
														<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_twitter.svg" />
												</a>
										</li>
										<li class="linkedin">
												<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>" class="popup" target="_blank" rel="nofollow noopener">
														<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_linkedin.svg" />
												</a>
										</li>
								</ul>
						</div>

					</section>
				</aside>
			</div>
		</div>
	<?php endwhile; endif; ?>

<?php get_footer(); ?>
