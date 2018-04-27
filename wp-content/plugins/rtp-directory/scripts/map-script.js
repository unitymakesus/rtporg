jQuery(document).ready(function($) {

  mapboxgl.accessToken = 'pk.eyJ1IjoiYWJ0YWRtaW4iLCJhIjoiY2pmbzd2MXVhMWVjMzJ5bG4xZmg4YTQzOSJ9.gpCo9L71BBeUf5scYBQH_Q';

	// Initiatlize Map
	var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/abtadmin/cjfo8weeq2rtu2rn0q4tuqp0c',
		center: ['-78.8678052','35.8985119'],
		zoom: 12
	});

	// Set up data to add to map
	// const facilities = <?php echo $facilities_json; ?>;

	// Query facilities from WPDB
  // $facilities = new WP_Query(array(
  //   'post_type' => 'rtp-facility',
	// 	'posts_per_page' => -1
  // ));
  // wp.api.loadPromise.done( function() {
  //   const pCollection = wp.api.collections.Posts();
  //   pCollection.fetch();
  //   console.log(pCollection);
  // } )



	// Will contain a list of map objects used to filter against.
	const layerIDs = [];

	map.on('load', function() {
		// Add geoJSON source for facilities
    const data = {
  		action: 'get_facilities',
      _ajax_nonce: rtp_dir_vars._ajax_nonce
  	};
  	$.ajax({
      url: rtp_dir_vars.ajax_uri,
      data
    })
      .done(function(response, textStatus, jqXHR) {
        let facilities = JSON.parse(response);
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
});
