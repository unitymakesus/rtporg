<?php
/**
 * Template Name: RTP Directory
 *
 */

get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="content-container page-directory">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-8">
						<h1>RTP Directory</h1>
						<p>The Research Triangle Park is packed with the coolest companies. Explore the Park Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras hendrerit vitae nibh rutrum commodo.</p>
					</div>
					<div class="col-md-4 text-right">
						<a href="#" class="button secondary large top-margin">Get Listed</a>
					</div>
				</div>
			</div>
			<div class="filters">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-6">
							<h3>Company Types</h3>
							<?php echo do_shortcode('[facetwp facet="industry"]'); ?>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<h3>Facility Types</h3>
									<?php echo do_shortcode('[facetwp facet="facility_types"]'); ?>
								</div>
								<div class="col-md-6">
									<h3>Real Estate</h3>
									<?php echo do_shortcode('[facetwp facet="availability"]'); ?>
								</div>
							</div>
							<div class="row">
								Search
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="directory-listing">
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-md-6 facetwp-template">
						<div class="clearfix vertical-padding">
							<div class="float-left">
				        <span class="count label">Showing <?php echo do_shortcode('[facetwp counts="true"]'); ?> Results</span>
							</div>
							<div class="float-right text-right">
								<?php echo do_shortcode('[facetwp pager="true"]'); ?>
							</div>
						</div>

						<?php
						// echo do_shortcode('[facetwp template="locations"]');
						$locations = (new RTP_Dir_Listing)->get_paged_locations();
						if ($locations->have_posts()) :
							while ($locations->have_posts()) : $locations->the_post();
								$id = get_the_id();
								$location_type = get_post_type();

								if ($location_type == 'rtp-facility') {
									$location_terms = wp_get_object_terms($id, 'rtp-facility-type', array('fields' => 'all'));
								} elseif ($location_type == 'rtp-space' || $location_type == 'rtp-site') {
									$location_terms = wp_get_object_terms($id, 'rtp-availability', array('fields' => 'all'));
								} elseif ($location_type == 'rtp-company') {
									$location_terms = wp_get_object_terms($id, 'rtp-company-type', array('fields' => 'all'));
								}
								?>
								<div class="result-item">
									<div class="result-logo">
										<?php echo get_field('company_logo'); ?>
									</div>

									<div class="result-details">
										<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
										<?php if (!empty($location_terms)) : ?>
											<div class="result-meta">
												<?php foreach ($location_terms as $lt) : ?>
												<div class="meta-term"><?php echo $lt->name; ?></div>
												<?php endforeach; ?>
											</div>
										<?php endif; ?>
									</div>
								</div>
								<?php
							endwhile; wp_reset_postdata();
				    else :
				      echo '<p>';
								_e( 'Sorry, no resources matched your criteria.' );
							echo '</p>';
				    endif;
						?>

						<div class="clearfix vertical-padding">
							<div class="float-left">
								<span class="count label">Showing <?php echo do_shortcode('[facetwp counts="true"]'); ?> Results</span>
							</div>
							<div class="float-right text-right">
								<?php echo do_shortcode('[facetwp pager="true"]'); ?>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-6">
	        	<div id="map" class="directory-map">
							<div class="key">
								<h6>Map Key</h6>
								<ul>
									<li><span class="icon-multitenant"></span>Multi-Tenant Facility</li>
									<li><span class="icon-company"></span>Companies</li>
									<li><span class="icon-recreation"></span>Recreation Facilities</li>
									<li><span class="icon-realestate"></span>For Sale / For Lease</li>
									<li><span class="icon-trails"></span>Trails</li>
								</ul>
							</div>

							<div class="rtp-loader-wrap">
								<div class="rtp-loader-icon">
								  <div class="row">
								     <div class="arrow up outer outer-18"></div>
								     <div class="arrow down outer outer-17"></div>
								     <div class="arrow up outer outer-16"></div>
								     <div class="arrow down outer outer-15"></div>
								     <div class="arrow up outer outer-14"></div>
								  </div>
								  <div class="row">
								     <div class="arrow up outer outer-1"></div>
								     <div class="arrow down outer outer-2"></div>
								     <div class="arrow up inner inner-6"></div>
								     <div class="arrow down inner inner-5"></div>
								     <div class="arrow up inner inner-4"></div>
								     <div class="arrow down outer outer-13"></div>
								     <div class="arrow up outer outer-12"></div>
								  </div>
								  <div class="row">
								     <div class="arrow down outer outer-3"></div>
								     <div class="arrow up outer outer-4"></div>
								     <div class="arrow down inner inner-1"></div>
								     <div class="arrow up inner inner-2"></div>
								     <div class="arrow down inner inner-3"></div>
								     <div class="arrow up outer outer-11"></div>
								     <div class="arrow down outer outer-10"></div>
								  </div>
								  <div class="row">
								     <div class="arrow down outer outer-5"></div>
								     <div class="arrow up outer outer-6"></div>
								     <div class="arrow down outer outer-7"></div>
								     <div class="arrow up outer outer-8"></div>
								     <div class="arrow down outer outer-9"></div>
								  </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile; ?>

<?php get_footer(); ?>
