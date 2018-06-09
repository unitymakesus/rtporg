jQuery(document).ready(function($) {

  mapboxgl.accessToken = 'pk.eyJ1IjoiYWJ0YWRtaW4iLCJhIjoiY2pmbzd2MXVhMWVjMzJ5bG4xZmg4YTQzOSJ9.gpCo9L71BBeUf5scYBQH_Q';

	// Initiatlize Map
	const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/abtadmin/cjfo8weeq2rtu2rn0q4tuqp0c',
		center: ['-78.865','35.892'],
		zoom: 12
	});

	// Arrays of map objects used to filter against.
	const pointLayers = ['recreation','companies','realestate']; // Array cats
  const polyLayers = ['polygon-fills', 'polygon-fills-hover', 'polygon-outlines']; // Array shapes
  const lineLayers = ['lines']; // Array of trails
  const allLayers = pointLayers.concat(polyLayers).concat(lineLayers);

  // Set up initial filters for each layer (to apply correct styles)
  const recreationFilter = ['all',['==', '$type', 'Point'],['==', 'facility-type', 'recreation']];
  const companyFilter = ['all',['==', '$type', 'Point'],['==', 'content-type', 'rtp-company']];
  const realestateFilter = ['all',['==', '$type', 'Point'],['==', 'content-type', 'rtp-space']];
  const polyFillFilter = ['all',['==', '$type', 'Polygon']];
  const polyFillHoverFilter = ['all',['==', 'hover_id', '']];
  const polyLinesFilter = ['all',['==', '$type', 'Polygon']];
  const lineFilter = ['all',['==', '$type', 'LineString']];

  // Get facets on page load
  let facets = FWP.facets;

  // Reset layer filters
  function reset_layer_filter(layer) {
    switch (layer) {
      case 'recreation':
        reset = recreationFilter;
        break;
      case 'companies':
        reset = companyFilter;
        break;
      case 'realestate':
        reset = realestateFilter;
        break;
      case 'polygon-fills':
        reset = polyFillFilter;
        break;
      case 'polygon-fills-hover':
        reset = polyFillHoverFilter;
        break;
      case 'polygon-outlines':
        reset = polyLinesFilter;
        break;
      case 'lines':
        reset = lineFilter;
        break;
    }
    return reset;
  }

  // Check to see if any facets are set
  function areFacetsSet(facets) {
    let set = false;

    $.each(facets, function(fkey, fval) {
      // If any values are set for this facet (besides pagination facets)
      if (fkey !== 'paged' && fval.length > 0) {
        set = true;
      }
    });

    return set;
  }

  // Set facets on the map
  function set_map_facets() {
    if (map.isStyleLoaded()) {

      // Get data from FacetsWP
      const facets = FWP.facets;
      const result_ids = FWP.settings.post_ids;

      // Set up filters for each layer individually
      allLayers.forEach(function(layer) {
        // Start building layer's filters from scratch to avoid duplicate filters being set
        let cleaned = reset_layer_filter(layer),
            new_expression = ['any'],
            new_filter = [];

        // Check if any facets are actually set
        if (areFacetsSet(facets) == true) {
          result_ids.forEach(function(id) {
            // Match on ids for any location
            new_expression.push(['==', 'id', id]);

            // Also match on ids of tenants within facility
            if (($.inArray(layer, polyLayers) != '-1')) {
              new_expression.push(['==', 'tenant-id-' + id, true]);
            }
          });

          // Add new expression to cleaned filter
          if (cleaned[0] == '==') {
            new_filter = ['all', cleaned, new_expression];
          } else {
            new_filter = cleaned.concat([new_expression]);
          }
        } else {
          // If there are no filters set, reset the filter to the cleaned one
          new_filter = cleaned;
        }

        // Set this layer's filter
        map.setFilter(layer, new_filter);
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
      'filter': lineFilter
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
      'filter': polyFillFilter
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
      'filter': polyFillHoverFilter
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
      'filter': polyLinesFilter
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
        'filter': companyFilter
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
        'filter': recreationFilter
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
        'filter': realestateFilter
      });
    });

    // When the user moves their mouse over the states-fill layer, we'll update the filter in
    // the state-fills-hover layer to only show the matching state, thus making a hover effect.
    map.on("mousemove", "polygon-fills", function(e) {
      map.getCanvas().style.cursor = 'pointer';
      map.setFilter("polygon-fills-hover", ["==", "hover_id", e.features[0].properties.hover_id]);
    });

    // Reset the state-fills-hover layer's filter when the mouse leaves the layer.
    map.on("mouseleave", "polygon-fills", function() {
      map.getCanvas().style.cursor = '';
      map.setFilter("polygon-fills-hover", ["==", "hover_id", ""]);
    });

		// When a click event occurs open a popup at the location of click
		map.on('click', "polygon-fills-hover", function(e) {
      // Other buildings
      var prop = e.features[0].properties;
      var tooltip = `
        <div class="tooltip">
          <p>${prop.title}</p>
          ${prop.image ? `<img src="${prop.image}" alt="${prop.title}"/>` : ''}
          <a href="${prop.permalink}">More Information</a>
        </div>
      `;

      new mapboxgl.Popup()
        .setLngLat(e.lngLat)
        .setHTML(tooltip)
        .addTo(map);
    });

    // Hover and click states for points
    pointLayers.forEach(function(layer) {
      map.on('mousemove', layer, function() {
        map.getCanvas().style.cursor = 'pointer';
      });

      map.on('mouseleave', layer, function() {
        map.getCanvas().style.cursor = '';
      });

      // Companies, Recreation Facilities, and some Real Estate
      map.on('click', layer, function(e) {
        var prop = e.features[0].properties;
        var tooltip = `
          <div class="tooltip">
            <p>${prop.title}</p>
            ${prop.logo ? `<img src="${prop.logo}" alt="${prop.title}"/>` : ''}
            <a href="${prop.permalink}">More Information</a>
          </div>
        `;

        new mapboxgl.Popup({ offset: 5 })
          .setLngLat(e.lngLat)
          .setHTML(tooltip)
          .addTo(map);
	    });
    });

    // Hover state for lines
    map.on('mousemove', 'lines', function(e) {
      map.getCanvas().style.cursor = 'pointer';
    });

    map.on('mouseleave', 'lines', function(e) {
      map.getCanvas().style.cursor = '';
    });

    // Click state for lines
		map.on('click', "lines", function(e) {
      // Lines
      var prop = e.features[0].properties;
      var tooltip = `
        <div class="tooltip">
          <p>${prop.title}</p>
          ${prop.image ? `<img src="${prop.image}" alt="${prop.title}"/>` : ''}
          <a href="${prop.permalink}">More Information</a>
        </div>
      `;

      new mapboxgl.Popup()
        .setLngLat(e.lngLat)
        .setHTML(tooltip)
        .addTo(map);
    });

	});

  // HANDLE FACETS CHANGING
  $(document).on('facetwp-loaded', function() {
    // Re-calc map distance from top
    distance = $('#map').offset().top;

    // Set company icons and checkboxes
    let checkboxCats = $('.facetwp-checkbox');
    let companyImages = rtp_dir_vars.company_type_images;

    // If checkboxes have an icon, set it after content
    checkboxCats.each(function(i) {
      let dataValue = $(this);
      for (key in companyImages) {
        if(dataValue.attr('data-value') == key && !dataValue.hasClass('has-icon')) {
          dataValue.addClass('has-icon');
          dataValue.prepend(`<img class="checkboxIcons" src="${companyImages[key]}" alt="" />`);
        }
      }
    });

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

  // Slide Toggle the Filter Bar
  $('#filter-toggle').click(function() {
    $('.filters .container-fluid').slideToggle('slow', function() {
      distance = $('#map').offset().top;
    });
    $('#filter-toggle span').toggleClass('arrow-toggle');
  });
});
