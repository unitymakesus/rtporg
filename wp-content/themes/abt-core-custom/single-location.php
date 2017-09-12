<?php
/**
 * Location (Single Entry)
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 *
 */

get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php
			$theme_dir              = get_stylesheet_directory_uri();

			// Contact Info
			$contact_name           = types_render_field("location-contact-name", array("raw"=>"true"));
			$contact_phone          = types_render_field("location-contact-phone", array("raw"=>"true"));
			$contact_email          = types_render_field("location-contact-email", array("raw"=>"true"));
			
			// Photos
			$thumb                  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
			$thumb_url              = ($thumb['0'] != null) ? 'style="background-image: url(' . $thumb["0"] . ');"' : '';
			$location_photo         = types_render_field("location-photo", array());
			$location_photos        = '<div class="item">' . do_shortcode('[types field="location-photo" separator="</div><div class=item>"][/types]') . '</div>';
			
			// Address
			$address1               = types_render_field("location-address-line-1", array("raw"=>"true"));
			$address2               = types_render_field("location-address-line-2", array("raw"=>"true"));
			$city                   = types_render_field("location-city", array("raw"=>"true"));
			$zip                    = types_render_field("location-zip-code", array("raw"=>"true"));
			
			// Cat: Partners
			$company_logo           = types_render_field("location-company-logo", array());
			$company_website        = types_render_field("location-company-website", array("raw"=>"true"));
			$company_twitter		= types_render_field("location-company-twitter", array("raw"=>"true"));
			$company_careers        = types_render_field("location-company-careers", array("raw"=>"true"));

			// Cat: Available Sites
			$site_number            = types_render_field("location-site-number", array("raw"=>"true"));
			$site_land_coverage     = types_render_field("location-site-land-coverage", array("raw"=>"true"));
			$site_building_coverage = types_render_field("location-site-building-lot-coverage", array("raw"=>"true"));
			
			// Cat: Available Spaces
			$space_type             = types_render_field("location-space-type", array());
			$space_coverage         = types_render_field("location-space-coverage", array("raw"=>"true"));
			$space_url         		= types_render_field("location-space-url", array("raw"=>"true"));
			
			// Cat: Amenities & Recreation
			$facility_type          = types_render_field("location-facility-type", array("raw"=>"true"));
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
						<header class="visuallyhidden">
							<h2 class="entry-title" itemprop="summary"><?php the_title(); ?></h2>
						</header>
						<div class="entry-content">
							<?php if ( $location_photo ) : ?>
								<div class="owl-carousel owl-theme"><?php echo $location_photos; ?></div>
							<?php endif; ?>							
							
							<?php the_content(); ?>
							
							<?php if ($site_number || $site_land_coverage || $site_building_coverage || $space_type || $space_coverage || $facility_type) : ?>
								<div class="supplemental">
									<h3>Additional Information:</h3>

									<?php if ( $site_number ) : ?>
										<div class="site-number">
											<strong>Site Number:</strong> <?php echo $site_number; ?>
										</div>
									<?php endif; ?>

									<?php if ( $site_land_coverage ) : ?>
										<div class="land-coverage">
											<strong>Acreage Offered:</strong> <?php echo number_format($site_land_coverage); ?> acres
										</div>
									<?php endif; ?>

									<?php if ( $site_building_coverage ) : ?>
										<div class="building-coverage">
											<strong>Building Coverage:</strong> <?php echo number_format($site_building_coverage); ?> sq.ft.
										</div>
									<?php endif; ?>

									<?php if ( $space_type ) : ?>
										<div class="space-type">
											<strong>Space Type:</strong> <?php echo $space_type; ?>
										</div>
									<?php endif; ?>

									<?php if ( $space_coverage ) : ?>
										<div class="space-coverage">
											<strong>Square Footage Available:</strong> <?php echo number_format($space_coverage); ?> sq.ft.
										</div>
									<?php endif; ?>

									<?php if ( $space_coverage ) : ?>
										<div class="space-url">
											<strong>Website:</strong> <a href="<?php echo $space_url; ?>"><?php echo $space_url; ?></a>
										</div>
									<?php endif; ?>

									<?php if ( $facility_type ) : ?>
										<div class="facility-type">
											<strong>Facility Type:</strong> <?php echo $facility_type; ?>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
					</article>
					<?php
			            // We'll look to see if this location has sublocations. If it does,
						// then we'll run it through our custom loop and display them.
			            $args = array (
		                    'post_type'      => 'location',
		                    'post_status'    => 'publish',
		                    'post_parent'    => $post->ID,
		                    'orderby'        => 'title',
		                    'order'          => 'ASC',
		                    'posts_per_page' => -1
		                );
			        ?>
			        <?php query_posts( $args ); ?>
			        <?php get_template_part( 'loop', 'sublocations' ); ?>
			        <?php wp_reset_query(); ?>
				</div>
		        <aside class="aside">
					<section class="meta contact-info">						
						<?php if ( $company_logo ) : ?>
							<div class="logo-sponsor">
								<?php echo $company_logo; ?>
							</div>
						<?php endif; ?>

						<?php if ( $company_website || $company_careers ) : ?>
						<div class="meta links">
							<?php if ( $company_website ) : ?>
								<a class="button secondary" href="<?php echo $company_website; ?>" target="_blank">Visit Website</a>
							<?php endif; ?>

							<?php if ( $company_careers ) : ?>
								<a class="button secondary" href="<?php echo $company_careers; ?>" target="_blank">Available Jobs</a>
							<?php endif; ?>
						</div>
						<?php endif; ?>

						<?php if ($address1 && $city && $zip) : ?>
							<h3>Location</h3>
							<div class="adr">
								<div><?php echo $address1; ?></div>
								<?php if ($address2) : ?>
									<div><?php echo $address2; ?></div>
								<?php endif; ?>
								<div><?php echo $city; ?>, NC <?php echo $zip; ?></div>
							</div>
						<?php endif; ?>

						<?php if ($contact_name || $contact_phone || $contact_email) : ?>
							<h3>Contact</h3>
						<?php endif; ?>
						<?php if ($contact_name) : ?>
							<div><?php echo $contact_name; ?></div>
						<?php endif; ?>
						<?php if ($contact_phone) : ?>
							<div><?php echo $contact_phone; ?></div>
						<?php endif; ?>
						<?php if ($contact_email) : ?>
							<div><a href="mailto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a></div>
						<?php endif; ?>

						<?php if ($company_twitter) : ?>
							<h3>Follow Us</h3>
							<div class="contact-twitter">
								<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_twitter.svg" />
								<a href="https://twitter.com/<?php echo $company_twitter; ?>" target="_blank">Twitter</a>
							</div>
						<?php endif; ?>
					</section>				
				</aside>
			</div>
		</div>
	<?php endwhile; ?>

<?php get_footer(); ?>