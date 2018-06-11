jQuery(document).ready(function($) {

    mapboxgl.accessToken = 'pk.eyJ1IjoiYWJ0YWRtaW4iLCJhIjoiY2pmbzd2MXVhMWVjMzJ5bG4xZmg4YTQzOSJ9.gpCo9L71BBeUf5scYBQH_Q';

  	// Initiatlize Map
  	const map = new mapboxgl.Map({
      container: 'location-map',
      style: 'mapbox://styles/abtadmin/cjfo8weeq2rtu2rn0q4tuqp0c',
  		center: ['-78.865','35.892'],
  		zoom: 12,
  	});

    const post_type = $('#location-map').attr('data-post-type');
    const feature_type = $('#location-map').attr('data-feature-type');

    function getBBox(data) {
      let bounds = {}, coords, point, latitude, longitude;

      for (var i = 0; i < data.features.length; i++) {
        coords = data.features[i].geometry.coordinates;

        for (var j = 0; j < coords.length; j++) {
          longitude = coords[j][0];
          latitude = coords[j][1];
          bounds.xMin = bounds.xMin < longitude ? bounds.xMin : longitude;
          bounds.xMax = bounds.xMax > longitude ? bounds.xMax : longitude;
          bounds.yMin = bounds.yMin < latitude ? bounds.yMin : latitude;
          bounds.yMax = bounds.yMax > latitude ? bounds.yMax : latitude;
        }
      }

      return bounds;
    }

    map.on('load', function() {
      // Placeholder for data that's coming from AJAX response
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

      // Add geoJSON source for location
      const data = {
        action: 'get_this_location',
        location_id: $('#location-map').attr('data-location-id'),
        post_type: post_type,
        _ajax_nonce: rtp_dir_vars._ajax_nonce
      };
      $.ajax({
        url: rtp_dir_vars.ajax_uri,
        type: 'POST',
        data
      })
      .done(function(response, textStatus, jqXHR) {
        let location = JSON.parse(response),
            prop = location.features[0].properties,
            mapCenter = ['-78.865','35.892'],
            popCenter = [],
            zoom = 12;

        console.log(location);

        // Add data to locations data source on map
        map.getSource('locations').setData(location);

        if (feature_type == 'Polygon') {
          // Get bounding box of polygons
          let bbox = getBBox(location),
              centerX = (bbox.xMax[0] + bbox.yMax[0])/2,
              centerY = (bbox.xMax[1] + bbox.yMax[1])/2;
          mapCenter = [centerX,bbox.yMax[1]],
          popCenter = [centerX, centerY],
          zoom = 15;
        } else if (feature_type == 'LineString') {
          // Get bounding box of linestrings
          let bbox = getBBox(location),
              centerX = (bbox.xMax + bbox.xMin)/2,
              centerY = (bbox.yMax + bbox.yMin)/2;
          mapCenter = [centerX, centerY];
          console.log([bbox.xMin,bbox.yMin],[bbox.xMax,bbox.yMax]);
          map.fitBounds(
            [[bbox.xMin,bbox.yMin],[bbox.xMax,bbox.yMax]],
            {padding: {top: 25, bottom:25, left: 25, right: 25}}
          );
        } else if (feature_type == 'Point') {
          mapCenter = location.features[0].geometry.coordinates,
          popCenter = location.features[0].geometry.coordinates,
          zoom = 13;
        }

        if (feature_type !== 'LineString') {
          // Zoom to center
          map.flyTo({
            center: mapCenter,
            zoom: zoom
          });

          // Build tooltip HTML
          let tooltip = `
            <div class="tooltip">
              <p class="title">${prop.title}</p>
              <p class="address">
                ${prop.street_address}<br />
                RTP, NC 27709
              </p>
              ${prop.image ? `<img src="${prop.image}" alt="${prop.title}"/>` : ''}
            </div>
          `;
          new mapboxgl.Popup({closeOnClick: false})
            .setLngLat(popCenter)
            .setHTML(tooltip)
            .addTo(map)
            .on('open', function(e) {
              // Is this even firing???
              console.log('e', e);
              // var px = map.project(e.popup._latlng); // find the pixel location on the map where the popup anchor is
              // px.y -= e.popup._container.clientHeight/2 // find the height of the popup container, divide by 2, subtract from the Y axis of marker location
              // map.panTo(map.unproject(px),{animate: true}); // pan to new center
            });
          }

        // Remove loading animation
        $('#location-map').addClass('loaded');
      });

      if (post_type == 'rtp-facility' && feature_type == 'Polygon') {
        // Add polygon styles to map
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
      } else if (post_type == 'rtp-facility' && feature_type == 'Point') {
        // Add recreation styles to map
        map.loadImage(rtp_dir_vars.marker_recreation, function(error, data) {
          if (error) throw error;
          map.addImage('recreation', data);
          map.addLayer({
            'id': 'recreation',
            'type': 'symbol',
            'source': 'locations',
            'layout': {
              'icon-image': 'recreation',
              'icon-size': 0.5,
              'icon-allow-overlap': true
            },
            'filter': ['all',['==', '$type', 'Point'],['any', ['==', 'facility-type', 'recreation'],['==', 'facility-type', 'trail']]]
          });
        });
      } else if (post_type == 'rtp-facility' && feature_type == 'LineString') {
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
      }
    });


    // Stick map to fixed position when it reaches top of screen on scroll
    const $window = $(window);
    if ($('#location-map.directory-map').length) {
      let distance = $('#location-map.directory-map').offset().top;

      $window.scroll(function() {
        if ( $window.scrollTop() >= distance ) {
          $('#location-map.directory-map').addClass('fixed');

        } else {
          $('#location-map.directory-map').removeClass('fixed');
        }
      });
    }
});
