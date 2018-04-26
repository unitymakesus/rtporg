<?php
/**
 * Template Name: Directory
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
				// Set up array containers
				$facilities_array = array(
					'type' => 'FeatureCollection',
    			'features' => array(),
				);

				// Query facilities from WPDB
        $facilities = new WP_Query(array(
          'post_type' => 'rtp-facility',
					'posts_per_page' => -1
        ));

        if ($facilities->have_posts()) : while ($facilities->have_posts()) : $facilities->the_post();
					$feature_type = get_field('geometry_type');
					$coords_array = array();

					switch (get_field('geometry_type')) {
          	case 'Polygon':
							if (!empty($coords = get_field('coordinates_long'))) {
								$coords_array = array(array(get_field('coordinates_long')));
							}
							break;
						case 'LineString':
							if (!empty($coords = get_field('coordinates_long'))) {
								$coords_array = array(get_field('coordinates_long'));
							}
							break;
						case 'Point':
							$coords = get_field('coordinates');
							if (!empty($coords['lat'])) {
								$coords_array = array(
									$coords['lng'],
									$coords['lat']
								);
							}
							break;
          }

					if (!empty($coords_array)) {
						$facilities_array['features'][] = array(
							'type' => 'Feature',
							'geometry' => array(
								'type' => $feature_type,
								'coordinates' => $coords_array
							),
							'properties' => array(
								'title' => get_the_title(),
								'content-type' => 'facility',
								'id' => get_the_id()
							)
						);
					}

        endwhile; endif; wp_reset_postdata();

				// Clean up JSON
				$facilities_json = str_replace(['["[', ']"]'], ['[[', ']]'], json_encode($facilities_array));
        ?>

        <div id="map" class="directory-map" style="width: 100%; height: 600px;"></div>


        <script type="text/javascript">
          jQuery(document).ready(function($) {

            mapboxgl.accessToken = '<?php echo $mapbox_token; ?>';

						// Initiatlize Map
						var map = new mapboxgl.Map({
					    container: 'map',
					    style: 'mapbox://styles/abtadmin/cjfo8weeq2rtu2rn0q4tuqp0c',
							center: ['-78.8678052','35.8985119'],
							zoom: 12
						});

						// Set up data to add to map
						const facilities = <?php echo $facilities_json; ?>;

						// Will contain a list of map objects used to filter against.
						const layerIDs = [];

						map.on('load', function() {
							// Add geoJSON source for facilities
							map.addSource('facilities', {
								'type': 'geojson',
	        			'data': facilities,
							});

							facilities.features.forEach(function(feature) {
								let layerID = 'facility-' + feature.properties['id'],
										layerType = '',
										layerStyle = {};
								layerIDs.push(layerID);

								// Set up layer properties by type
								switch (feature.geometry.type) {
									case 'Polygon':
										layerType = 'fill';
										layerStyle = {
											'layout': {},
											'paint': {
						            'fill-color': '#088',
						            'fill-opacity': 0.8
											},
											'filter': ["==", "$type", "Polygon"]
										};
										break;
									case 'LineString':
										layerType = 'line';
										layerStyle = {
											'layout': {
												'line-join': 'round',
					 							'line-cap': 'round'
											},
											'paint': {
												'line-color': '#880',
												'line-width': 2,
												'line-dasharray': [1,3]
											},
											'filter': ["==", "$type", "LineString"]
										}
										break;
									case 'Point':
										layerType = 'circle';
										layerStyle = {
											'layout': {},
							        'paint': {
												'circle-radius': 5,
												'circle-color': '#808',
												'circle-stroke-width': 1,
												'circle-stroke-color': '#909'
											},
											'filter': ["==", "$type", "Point"]
										}
										break;
								}

								let layerObj = {
									'id': layerID,
									'source': 'facilities',
									'type': layerType,
								};

								// Combine arrays
								Object.assign(layerObj, layerStyle);

								// Add facilities to map
								map.addLayer(layerObj);

								// When a click event occurs open a popup at the location of click
								map.on('click', layerID, function (e) {
					        new mapboxgl.Popup()
					            .setLngLat(e.lngLat)
					            .setHTML(e.features[0].properties.title)
					            .addTo(map);
						    });
							});

						});
          });

        </script>
			</div>
		</div>
	<?php endwhile; ?>

<?php get_footer(); ?>
