<?php
/**
 * Template Name: Map
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 *
 */

$mapbox_token = 'pk.eyJ1IjoiYWJ0YWRtaW4iLCJhIjoiY2pmbzd2MXVhMWVjMzJ5bG4xZmg4YTQzOSJ9.gpCo9L71BBeUf5scYBQH_Q';

get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="content-container">
			<div class="content">
				<?php
        $facilities = new WP_Query(array(
          'post_type' => 'rtp-facility'
        ));

        if ($facilities->have_posts()) : while ($facilities->have_posts()) : $facilities->the_post();

          if (get_field('geometry_type') == 'polygon') {
            $coords = get_field('coordinates');
          }

        endwhile; endif; wp_reset_postdata();
        ?>

        <div id="map" class="directory-map"></div>

        <script type="text/javascript">
          jQuery(document).ready(function($) {

            L.mapbox.accessToken = '<?php echo $mapbox_token; ?>';

            // Initialize Map
            // var map = new L.mapbox.map('map', {
            //   tileLayer: {
            //     detectRetina: true,
            //     minZoom: 4,
            //     maxZoom: 10
            //   },
            //   worldCopyJump: true
            // }).setView([19.159882, -80.188477], 4);
            //
            // // Add Style to Map
            // L.mapbox.styleLayer('mapbox://styles/abtadmin/cj6qljksg3l0y2sn83zkmdh0q').addTo(map);

            var map = L.mapbox.map('map')
                .setView([35.905, -78.864], 12);

            L.mapbox.styleLayer('mapbox://styles/abtadmin/cj6qljksg3l0y2sn83zkmdh0q', {
                  detectRetina: true,
                  continuousWorld: true,
                  maxZoom: 15,
                  minZoom: 4
                }).addTo(map);

          });

        </script>
			</div>
		</div>
	<?php endwhile; ?>

<?php get_footer(); ?>
