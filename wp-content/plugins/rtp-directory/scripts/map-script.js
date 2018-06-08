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

	const pointLayers = ['recreation','companies','realestate']; // Array cats
  const polyLayers = ['polygon-fills', 'polygon-fills-hover', 'polygon-outlines']; // Array shapes
  const lineLayers = ['lines']; // Array of trails
  const allLayers = pointLayers.concat(polyLayers).concat(lineLayers);

  // Get facets on page load
  let facets = FWP.facets;

  // Remove all facet filters
  function remove_all_facets(layer, flabel) {
    fcurrent = map.getFilter(layer);

    // Set up empty arrays to keep expressions
    cleaned = [], cleaned_any = [];

    // Loop through each of the expressions in the current filter
    $.each(fcurrent, function(ckey, cval) {
      // Handle expressions that contain more expressions
      if (cval[0].indexOf('any') >= 0) {
        cleaned_any = [];

        // Loop through sub-expressions
        $.each(cval, function(k, v) {
          // Only keep the expressions that are default for the layer's filter
          if (flabel != 'blank' && v[1].indexOf(flabel) == '-1' && v[1].indexOf('tenant-id') == '-1') {
            cleaned_any.push(v);
          }
        });

        if (cleaned_any.length > 1) {
          cleaned.push(cleaned_any);
        }

      // Keep the expressions that were already added to this filter for this facet in a previous loop iteration
    } else if (cval[1].indexOf(flabel) == '-1' && flabel != 'blank') {
        cleaned.push(cval);

      // Only keep the expressions that are default for the layer's filter
    } else if (flabel == 'blank' && cval[1].indexOf('facet') == '-1' && cval[1].indexOf('availability') == '-1') {
        cleaned.push(cval);
      }
    });

    console.log('cleaned', cleaned);
    return cleaned;
  }

  // Add filter for facet
  function add_filter_facet(layer, flabel, fvalue) {
    // start from scratch to avoid dupes
    cleaned = remove_all_facets(layer, flabel);
    new_exp = [];
    new_filter = [];

    console.log('inarray', ($.inArray(layer, polyLayers) != '-1'));

    if (($.inArray(layer, polyLayers) != '-1') && (flabel == 'company-facet' || flabel == 'availability')) {
      // If we're filtering facilities (polygon layers) for company types or availabilities
      // we're going to look for companies/spaces that are located within that facility

      new_exp = ['any'];

      result_ids = FWP.settings.post_ids;
      result_ids.forEach(function(r) {
        new_exp.push(['==', 'tenant-id-' + r, true]);
      });

      // Also if we're looking at polygons for sale (sites), include the original facet filter
      console.log('facet', flabel);
      if (flabel == 'availability') {
        console.log('value', fvalue);
        console.log('isvalarray', Array.isArray(fvalue));
        console.log('valinarray', $.inArray('for-sale', fvalue));
        if (Array.isArray(fvalue) && $.inArray('for-sale', fvalue) != '-1') {
          fvalue.forEach(function(fv) {
            new_exp.push(['==', flabel + '-' + fv, true]);
          });
        } else if (fvalue == 'for-sale') {
          new_exp.push(['==', flabel + '-' + fvalue, true]);
        }
      }

    } else {
      // If we're filtering any other type of layer, we're going to look for
      // results that match the specific facet
      if (Array.isArray(fvalue)) {
        new_exp = ['any'];
        fvalue.forEach(function(fv) {
          new_exp.push(['==', flabel + '-' + fv, true]);
        });
      } else {
        new_exp = ['==', flabel + '-' + fvalue, true];
      }
    }

    if (cleaned[0] == '==') {
      new_filter = ['all', cleaned, new_exp];
    } else {
      new_filter = cleaned.concat([new_exp]);
    }

    console.log('add-'+layer, new_filter);
    // map.setFilter(layer, new_filter);
    return new_filter;
  }

  function get_filter_facets(layer, facets, result_ids) {
    // Set up the filters array to hold returned filters
    let filters = [];

    $.each(facets, function(fkey, fval) {
      // Not for pagination facets though
      if (fkey == 'paged') {
        return false;
      }

      // Set label for expression based on selected facets
      if (fkey == 'availability') {
        flabel = 'availability';
      } else if (fkey == 'facility_types') {
        flabel = 'facility-facet';
      } else if (fkey == 'industry') {
        flabel = 'company-facet';
      }

      // If one or more values are set for this facet
      if (fval.length == 1) {
        filters = add_filter_facet(layer, flabel, fval[0]);
      } else if (fval.length > 1) {
        filters = add_filter_facet(layer, flabel, fval);
      }
    });

    // If there are no facets set at all, reset this layer's filters to default
    if (filters.length == 0) {
      console.log('removing all');
      filters = remove_all_facets(layer, 'blank');
    }

    return filters;
  }

  // Set facets on the map
  function set_map_facets() {
    if (map.isStyleLoaded()) {

      // Get which facets are set
      const facets = FWP.facets;
      const result_ids = FWP.settings.post_ids;

      // Filter each layer individually based on selected facets
      allLayers.forEach(function(layer) {
        console.log('layer-start', layer);
        filters = get_filter_facets(layer, facets, result_ids);
        console.log('layer-filters', filters);
        map.setFilter(layer, filters);
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

      // Companies
      map.on('click', layer, function(e) {
        var prop = e.features[0].properties;
        var tooltip = `
          <div class="tooltip">
            <p>${e.features[0].properties.title}</p>
            ${prop.logo ? `<img src="${prop.logo}" alt="${prop.title}"/>` : ''}
            <a href="${prop.permalink}">View Company</a>
          </div>
        `;

        new mapboxgl.Popup({ offset: 5 })
          .setLngLat(e.lngLat)
          .setHTML(tooltip)
          .addTo(map);
	    });
    });

		// When a click event occurs open a popup at the location of click
		map.on('click', "polygon-fills-hover", function(e) {
      // Other buildings
      var prop = e.features[0].properties;
      var tooltip = `
        <div class="tooltip">
          <p>${e.features[0].properties.title}</p>
          ${prop.image ? `<img src="${prop.image}" alt="${prop.title}"/>` : ''}
          <a href="${prop.permalink}">View Company</a>
        </div>
      `;

      console.log('Features', e.features[0].properties);
      new mapboxgl.Popup()
        .setLngLat(e.lngLat)
        .setHTML(tooltip)
        .addTo(map);
    });

		map.on('click', "lines", function(e) {
      // Lines
      new mapboxgl.Popup()
        .setLngLat(e.lngLat)
        .setHTML(e.featured[0].properties.title)
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
        if(dataValue.attr('data-value') == key) {
          dataValue.prepend(`<img class="checkboxIcons" src="${companyImages[key]}" />`);
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
    $('.filters .container-fluid').slideToggle('slow');
    $('#filter-toggle span').toggleClass('arrow-toggle');
  });
});
