jQuery(document).ready(function($) {

  mapboxgl.accessToken = 'pk.eyJ1IjoiYWJ0YWRtaW4iLCJhIjoiY2pmbzd2MXVhMWVjMzJ5bG4xZmg4YTQzOSJ9.gpCo9L71BBeUf5scYBQH_Q';

	// Initiatlize Map
	const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/abtadmin/cjfo8weeq2rtu2rn0q4tuqp0c',
		// center: ['-78.8678052','35.8985119'],
		center: ['-78.865','35.892'],
		zoom: 12
	});

	// Contains a list of map objects used to filter against.
	const pointLayers = ['recreation','companies','realestate'];
  const polyLayers = ['polygon-fills', 'polygon-fills-hover', 'polygon-outlines'];
  const lineLayers = ['lines'];
  const allLayers = pointLayers.concat(polyLayers).concat(lineLayers);

  // Get facets on page load
  let facets = FWP.facets;

  // Remove all facet filters
  function remove_all_facets(facet, layer) {
    current = map.getFilter(layer);
    console.info('current', current);

    // Only keep expressions that do not match target facet
    cleaned = [], cleaned_any = [];

    $.each(current, function(key, val) {
      if (val[0].indexOf('any') !== -1) {
        cleaned_any = [];
        $.each(val, function(k, v) {
          if (v[1].indexOf(facet) == -1) {
            cleaned_any.push(v);
          }
        });
        if (cleaned_any.length > 1) {
          cleaned.push(cleaned_any);
        }
      } else if (val[1].indexOf(facet) == -1) {
        cleaned.push(val);
      }
    });

    console.log('cleaned', cleaned);
    return cleaned;
  }

  // Add filter for facet
  function add_filter_facet(facet, layer, value) {
    // start from scratch to avoid dupes
    cleaned = remove_all_facets(facet, layer);

    if (Array.isArray(value)) {
      new_exp = ['any'];
      value.forEach(function(v) {
        new_exp.push(['==', facet + '-' + v, true]);
      });
    } else {
      new_exp = ['==', facet + '-' + value, true];
    }

    if (cleaned[0] == '==') {
      new_filter = ['all', cleaned, new_exp];
    } else {
      new_filter = cleaned.concat([new_exp]);
    }

    console.info('add', new_filter);
    map.setFilter(layer, new_filter);
  }

  // Set facets on the map
  function set_map_facets() {
    facets = FWP.facets;

    if (map.isStyleLoaded()) {
      $.each(facets, function(key, val) {
        // Not for pagination facets though
        if (key == 'paged') {
          return false;
        }
        
        // Set label for expression based on selected facets
        if (key == 'availability') {
          label = 'availability';
        } else if (key == 'facility_types') {
          label = 'facility-facet';
        } else if (key == 'industry') {
          label = 'company-facet';
        }

        // Filter layers based on selected facets
        allLayers.forEach(function(layer) {
          if (val.length == 1) {
            add_filter_facet(label, layer, val[0]);
          } else if (val.length > 1) {
            add_filter_facet(label, layer, val);
          } else {
            filters = remove_all_facets(label, layer);
            map.setFilter(layer, filters);
          }
        });
      });
    }
  }

	map.on('load', function() {
		// Add geoJSON source for locations
    const data = {
  		action: 'get_locations',
      _ajax_nonce: rtp_dir_vars._ajax_nonce
  	};
  	$.ajax({
      url: rtp_dir_vars.ajax_uri,
      data
    })
    .done(function(response, textStatus, jqXHR) {
      let locations = JSON.parse(response);
      // Add locations data source to map
  		map.getSource('locations').setData(locations);
      // Filter layers on map
      set_map_facets();
      // Remove loading state
      $('#map').addClass('loaded');
    });

    // Placeholder
    map.addSource('locations', {
      type: 'geojson',
      data: {
        "type": "FeatureCollection",
          "features": [{
            "type": "Feature",
            "properties": {},
            "geometry": {
            "type": "Point",
            "coordinates": []
          }
        }]
      }
    });

    // Add line styles to map
    map.addLayer({
      'id': 'lines',
      'type': 'line',
      'source': 'locations',
      'layout': {
        'line-join': 'round',
        'line-cap': 'round'
      },
      'paint': {
        'line-color': '#07444C',
        'line-width': 2,
        'line-dasharray': [0,2]
      },
      'filter': ['all',['==', '$type', 'LineString']]
    });

    // Add polygon styles (inactive states) to map
    map.addLayer({
      'id': 'polygon-fills',
      'type': 'fill',
      'source': 'locations',
      'layout': {},
      'paint': {
        'fill-color': ['get', 'color'],
        'fill-opacity': ['get', 'opacity']
      },
      'filter': ['all',['==', '$type', 'Polygon']]
    });

    // Add polygon styles (hover states) to map
    map.addLayer({
      'id': 'polygon-fills-hover',
      'type': 'fill',
      'source': 'locations',
      'layout': {},
      'paint': {
        'fill-color': ['get', 'hover-color'],
        'fill-opacity': ['get', 'hover-opacity']
      },
      'filter': ['all',['==', 'id', '']]
    });

    // Add polygon outline styles to map
    map.addLayer({
      'id': 'polygon-outlines',
      'type': 'line',
      'source': 'locations',
      'layout': {},
      'paint': {
        'line-color': ['get', 'hover-color'],
        'line-width': 1
      },
      'filter': ['all',['==', '$type', 'Polygon']]
    });

    // Add marker images to map
    map.loadImage(rtp_dir_vars.marker_company, function(error, data) {
      if (error) throw error;
      map.addImage('company', data);

      // Add company styles to map
      map.addLayer({
        'id': 'companies',
        'type': 'symbol',
        'source': 'locations',
        'layout': {
          'icon-image': 'company',
          'icon-size': 0.5,
          'icon-allow-overlap': true
        },
        'filter': ['all',['==', '$type', 'Point'],['==', 'content-type', 'rtp-company']]
      });
    });
    map.loadImage(rtp_dir_vars.marker_recreation, function(error, data) {
      if (error) throw error;
      map.addImage('recreation', data);

      // Add recreation styles to map
      map.addLayer({
        'id': 'recreation',
        'type': 'symbol',
        'source': 'locations',
        'layout': {
          'icon-image': 'recreation',
          'icon-size': 0.5,
          'icon-allow-overlap': true
        },
        'filter': ['all',['==', '$type', 'Point'],['==', 'facility-type', 'recreation']]
      });
    });
    map.loadImage(rtp_dir_vars.marker_realestate, function(error, data) {
      if (error) throw error;
      map.addImage('realestate', data);

      // Add real estate point styles to map
      map.addLayer({
        'id': 'realestate',
        'type': 'symbol',
        'source': 'locations',
        'layout': {
          'icon-image': 'realestate',
          'icon-size': 0.5,
          'icon-allow-overlap': true
        },
        'filter': ['all',['==', '$type', 'Point'],['==', 'content-type', 'rtp-space']]
      });
    });

    // When the user moves their mouse over the states-fill layer, we'll update the filter in
    // the state-fills-hover layer to only show the matching state, thus making a hover effect.
    map.on("mousemove", "polygon-fills", function(e) {
      map.getCanvas().style.cursor = 'pointer';
      map.setFilter("polygon-fills-hover", ["==", "id", e.features[0].properties.id]);
    });

    // Reset the state-fills-hover layer's filter when the mouse leaves the layer.
    map.on("mouseleave", "polygon-fills", function() {
      map.getCanvas().style.cursor = '';
      map.setFilter("polygon-fills-hover", ["==", "id", ""]);
    });

    // Hover and click states for points
    pointLayers.forEach(function(layer) {
      map.on('mousemove', layer, function() {
        map.getCanvas().style.cursor = 'pointer';
      });

      map.on('mouseleave', layer, function() {
        map.getCanvas().style.cursor = '';
      });

      map.on('click', layer, function(e) {
        new mapboxgl.Popup({ offset: 5 })
          .setLngLat(e.lngLat)
          .setHTML(e.features[0].properties.title)
          .addTo(map);
	    });
    });

		// When a click event occurs open a popup at the location of click
		map.on('click', "polygon-fills-hover", function(e) {
      new mapboxgl.Popup()
        .setLngLat(e.lngLat)
        .setHTML(e.features[0].properties.title)
        .addTo(map);
    });

		map.on('click', "lines", function(e) {
      new mapboxgl.Popup()
        .setLngLat(e.lngLat)
        .setHTML(e.features[0].properties.title)
        .addTo(map);
    });

	});

  // HANDLE FACETS CHANGING
  $(document).on('facetwp-loaded', function() {
    // Re-calc map distance from top
    distance = $('#map').offset().top;

    // Filter layers on map
    set_map_facets();
  });

  // Stick map to fixed position when it reaches top of screen on scroll
  const $window = $(window);
  let distance = $('#map').offset().top;

  $window.scroll(function() {
    if ( $window.scrollTop() >= distance ) {
      $('#map').addClass('fixed');
    } else {
      $('#map').removeClass('fixed');
    }
  });

});
