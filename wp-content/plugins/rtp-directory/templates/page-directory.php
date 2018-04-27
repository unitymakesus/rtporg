<?php
/**
 * Template Name: RTP Directory
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 *
 */

get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="content-container">
			<?php echo do_shortcode('[facetwp facet="post_types"]'); ?>
			<div class="facetwp-template">
				<div class="row">
		      <div class="col-xs-12 col-md6">
		        <?php echo do_shortcode('[facetwp per_page="true"]'); ?>
		        <?php echo do_shortcode('[facetwp counts="true"]'); ?>
		      </div>
					<div class="col-xs-12 col-md6 right-align">
		        <?php echo do_shortcode('[facetwp sort="true"]'); ?>
		      </div>
		    </div>

				<div class="row">
					<div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
	        	<div id="map" class="directory-map"></div>
					</div>

					<div class="col-xs-12 col-sm-4 col-md-6 col-lg-8">
						<?php
						$facilities = (new RTP_Dir_Listing)->get_facilities();

				    if ( !empty($facilities['features']) ) :
				      foreach ($facilities['features'] as $feature) :
								var_dump($feature);
				      endforeach;

				      echo '<div class="center-align">';
				        echo do_shortcode('[facetwp pager="true"]');
				      echo '</div>';
				    else :
				      echo '<p>';
								_e( 'Sorry, no resources matched your criteria.' );
							echo '</p>';
				    endif;
						?>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile; ?>

<?php get_footer(); ?>
