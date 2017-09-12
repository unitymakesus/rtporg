// -----------------------------------------------------------------------------
// Variables
// -----------------------------------------------------------------------------

// Define credentials to mapbox api
var mapboxgl_api                = 'https://api.mapbox.com';
var mapboxgl_username           = 'abtadmin';
var mapboxgl_dataSetID_points   = 'cj3nrirst001a33mrz90nj1qu';
var mapboxgl_dataSetID_region   = 'ciyz3f02j02rm33moqf1vwepz';

// Define our token for mapbox
mapboxgl.accessToken = 'pk.eyJ1IjoiYWJ0YWRtaW4iLCJhIjoid3lQS0RvQSJ9.7Y3yjdxUbLyuMfmLOo7o-w';

// Define our api url
var mapboxgl_data_url = mapboxgl_api + '/datasets/v1/' + mapboxgl_username + '/' + mapboxgl_dataSetID_points + '/features?access_token=' + mapboxgl.accessToken;
var mapboxgl_region_url = mapboxgl_api + '/datasets/v1/' + mapboxgl_username + '/' + mapboxgl_dataSetID_region + '/features?access_token=' + mapboxgl.accessToken;

// Define our map
var map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/light-v9',
  center: [-78.864, 35.905],
  zoom: 12,
  minZoom: 8,
  attributionControl: false
});

// Holds mapbox data
var mapbox_data;

// Holds mapbox layers
var mapbox_layers = [];

// Holds visible map features for filtering
var locations = [];

// Create a popup, but don't add it to the map yet.
var popup = new mapboxgl.Popup({
  closeButton: false
});

// Filter variables
var filterGroup = document.getElementById('filter-group');
var filterEl    = document.getElementById('feature-filter');
var listingEl   = document.getElementById('feature-listing');


// -----------------------------------------------------------------------------
// Function: Render Listings
// -----------------------------------------------------------------------------
function renderListings(features) {

  // Clear any existing listings
  listingEl.innerHTML = '';

  // Let's sort our array alphabetically
  features.sort(function(a, b) {
    var keyA = decode_string(a.properties.title);
    var keyB = decode_string(b.properties.title);

    if (keyA < keyB) {
      return -1;
    }
    if (keyA > keyB) {
      return 1;
    }

    return 0;
  });

  // If features exist...
  if (features.length) {
    features.forEach(function(feature) {
      var property = feature.properties;

      // feature properties
      var title    = (property.title) ? property.title : '';
      var address1 = (property.address1) ? property.address1 : '';
      var address2 = (property.address2) ? property.address2 : '';
      var city     = 'Research Triangle Park';
      var state    = 'NC';
      var zipcode  = '27709';

      // build our custom address
      if ( address1 && address2 ) {
        address = address1 + '<br />' + address2 + '<br />' + city + ' ' + state + ', ' + zipcode;
      } else if ( address1 ) {
        address = address1 + '<br />' + city + ' ' + state + ', ' + zipcode;
      } else {
        address = '';
      }

      // define our item
      var item = document.createElement('article');
      var item_title = document.createElement('h1');
      item_title.className = 'entry-title';
      item_title.innerHTML = title;
      var item_address = document.createElement('div');
      item_address.className = 'adr';
      item_address.innerHTML = address;
      item.appendChild(item_title);
      item.appendChild(item_address);

      // Highlight corresponding feature on the map
      item.addEventListener('mouseover', function() {
        popup.setLngLat(feature.geometry.coordinates)
        .setText(feature.properties.title)
        .addTo(map);
      });

      // get coordinates from the point and center the map
      item.addEventListener('click', function() {
        map.flyTo({
          center: feature.geometry.coordinates,
          zoom: 14,
          speed: 1,
          curve: 1
        });
      });

      $('#feature-listing').append(item);
    });

    // Show the filter input
    filterEl.parentNode.style.display = 'block';
  }
  else {
    // define our item
    var item = document.createElement('article');
    item.className = 'empty';
    item.textContent = 'Drag & zoom the map to find locations';

    $('#feature-listing').append(item);

    // remove features filter
    //map.setFilter('partners', ['has', 'abbrev']);
  }

}


// -----------------------------------------------------------------------------
// Function: Sort Listings
// -----------------------------------------------------------------------------
function sortListings(selector) {
  var list = $(selector);
  var listItem = $('article', list);

  listItem.sort(function(a, b) {
    var keyA = $(a).find('h1').text();
    var keyB = $(b).find('h1').text();

    return (keyA > keyB) ? 1 : 0;
  });
  $.each(listItem, function(index, row) {
    list.append(row);
  });
}


// -----------------------------------------------------------------------------
// Function: Normalize
// -----------------------------------------------------------------------------
function normalize(string) {
  return string.trim().toLowerCase();
}


// -----------------------------------------------------------------------------
// Function: String Replace
// -----------------------------------------------------------------------------
function slugify(string) {
  return string.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
}


// -----------------------------------------------------------------------------
// Function: Decode String
// -----------------------------------------------------------------------------
function decode_string(string){
  var temp = document.createElement("textarea");
  temp.innerHTML = string;
  return temp.value;
}


// -----------------------------------------------------------------------------
// Function: Get Unique Features
// -----------------------------------------------------------------------------
function getUniqueFeatures(array, comparatorProperty) {
  var existingFeatureKeys = {};

  // Because features come from tiled vector data, feature geometries may be split
  // or duplicated across tile boundaries and, as a result, features may appear
  // multiple times in query results.
  var uniqueFeatures = array.filter(function(el) {
    if (existingFeatureKeys[el.properties[comparatorProperty]]) {
      return false;
    } else {
      existingFeatureKeys[el.properties[comparatorProperty]] = true;
      return true;
    }
  });

  return uniqueFeatures;
}


// -----------------------------------------------------------------------------
// Listener: When map is loaded...
// -----------------------------------------------------------------------------
map.on('load', function() {


  // Add controls to the map.
  map.addControl( new mapboxgl.NavigationControl(), 'bottom-right' );


  // Add source data ($.getJSON())
  map.addSource('points', {
    type: 'geojson',
    data: mapboxgl_data_url
  });
  map.addSource('rtp_outline', {
    type: 'geojson',
    data: mapboxgl_region_url
  });

  // Add layer for RTP region outline
  map.addLayer({
    'id': 'rtp_outline',
    'type': 'fill',
    'source': 'rtp_outline',
    'paint': {
      'fill-color': '#517FA4',
      'fill-opacity': 0.15
    }
  });

  // Get our source and setup the map
  $.getJSON(mapboxgl_data_url, function(data) {

    // define our source
    mapbox_data = data;

    // iterate through our features
    mapbox_data.features.forEach(function(feature) {
      var label;
      var category    = feature.properties.category;
      var subcategory = feature.properties.subcategory;
      var layer_id    = (category && subcategory) ? 'poi-' + slugify(subcategory) : 'poi-' + slugify(category);
      var filter_by   = (category && subcategory) ? 'subcategory' : 'category';
      var filter_val  = (category && subcategory) ? subcategory : category;

      // redefine desired category labels
      if ( category == 'partner' && !subcategory ) {
        label = 'Business / Organization';
      } else if ( category == 'amenity' && !subcategory ) {
        label = 'Recreation & Amenities';
      } else if ( category == 'site' && !subcategory ) {
        label = 'Available Sites';
      } else if ( category == 'space' && !subcategory ) {
        label = 'Available Spaces';
      } else if ( subcategory ) {
        label = subcategory;
      }

      // check to see if the layer already exists...
      if (!map.getLayer(layer_id)) {

        // add a layer for this symbol type if it hasn't been added already.
        map.addLayer({
          'id': layer_id,
          'type': 'circle',
          'source': 'points',
          'paint': {
            'circle-radius': {
              'base': 1.75,
              'stops': [[12, 4], [22, 180]]
            },
            'circle-color': {
              property: 'category',
              type: 'categorical',
              stops: [
                ['partner', '#194685'],
                ['amenity', '#00ACED'],
                ['site', '#EF4E22'],
                ['space', '#2EBAA5'],
              ]
            }
          },
          'filter': ['==', filter_by, filter_val]
        });

        // define our layer control
        if (category || category && subcategory) {

          // push the layer into our array for later usage
          mapbox_layers.push(layer_id);

          var link = document.createElement('div');
          link.className = 'active';
          link.setAttribute('data-layer', layer_id);
          link.innerHTML = '<a href="#">' + label + '</a>';

          if (subcategory) {
            link.setAttribute('data-parent', 'poi-' + slugify(category));
          }

          // click event
          link.addEventListener('click', function (e) {
            var clickedLayer = this.getAttribute('data-layer');
            e.preventDefault();
            e.stopPropagation();

            // update visibility of layer
            var visibility = map.getLayoutProperty(clickedLayer, 'visibility');

            if (visibility === 'visible') {
              map.setLayoutProperty(clickedLayer, 'visibility', 'none');
              this.className = '';
            } else {
              this.className = 'active';
              map.setLayoutProperty(clickedLayer, 'visibility', 'visible');
            }
          });

          // add our layer control
          var layers = document.getElementById('map-menu');
          layers.appendChild(link);

        }
      }

    });


    // By default, set the layer to be visible
    mapbox_layers.forEach(function(layer) {
      map.setLayoutProperty(layer, 'visibility', 'visible');
    });


    // Reorganize layers by groups
    var map_menu = document.getElementById('map-menu');
    var subcategories = document.querySelectorAll('#map-menu > div[data-parent]');

    subcategories.forEach(function(subcategory) {
      var parent_id = subcategory.getAttribute('data-parent');
          parent = map_menu.querySelector('[data-layer="' + parent_id + '"]');

      // If parent doesn't exist, add it
      if (parent == null) {

        if ( parent_id == 'poi-partner' ) {
          label = 'Business / Organization';
        }

        link = document.createElement('div');
        link.className = 'active';
        link.setAttribute('data-layer', parent_id);
        link.innerHTML = '<a href="#">' + label + '</a>';

        // click event for parent category: toggles all subcategories
        link.addEventListener('click', function (e) {
          var clickedLayer = this.getAttribute('data-layer');
          var toggleState;

          e.preventDefault();
          e.stopPropagation();

          // toggle active switch
          if (this.className == 'active') {
            this.className = '';
            toggleState = 'off';
          } else {
            this.className = 'active';
            toggleState = 'on';
          }

          subcategories.forEach(function(subcategory) {
            var subcategory_parent_id = subcategory.getAttribute('data-parent');

            // just for subcategories of this parent
            if (subcategory_parent_id == parent_id) {

              var subcategory_layer = subcategory.getAttribute('data-layer');

              // update visibility of subcategory layers
              if (toggleState == 'off') {
                map.setLayoutProperty(subcategory_layer, 'visibility', 'none');
                subcategory.className = '';
              } else {
                subcategory.className = 'active';
                map.setLayoutProperty(subcategory_layer, 'visibility', 'visible');
              }
            }
          });
        });

        // add our layer control
        var layers = document.getElementById('map-menu');
        layers.appendChild(link);

        // update parent variable
        parent = link;
      }

      parent.appendChild(subcategory);
    });


    // Reorder sublayers by title
    var children = document.querySelectorAll('#map-menu div[data-parent]');
    var childrenArray = [].slice.call(children).sort(function(a, b) {
      return a.textContent > b.textContent ? 1 : -1;
    });
    childrenArray.forEach(function(child) {
      var parent = child.getAttribute('data-parent');
          parent = map_menu.querySelector('[data-layer="' + parent + '"]');

      parent.appendChild(child);
    });


  });

  // Hide our preloader after loading is complete
  $('#loading').fadeOut();

});


// -----------------------------------------------------------------------------
// Listener: When mouse moves...
// -----------------------------------------------------------------------------
map.on('mousemove', function (e) {
  var features = map.queryRenderedFeatures(e.point, { layers: mapbox_layers });

  if (features.length) {

    // update cursors
    map.getCanvas().style.cursor = (features.length) ? 'pointer' : '';

    var feature = features[0];

    popup.setLngLat(feature.geometry.coordinates)
    .setText(feature.properties.title)
    .addTo(map);

  } else {

    popup.remove();
    return;

  }
});


// -----------------------------------------------------------------------------
// Listener: When map drag ends...
// -----------------------------------------------------------------------------
map.on('moveend', function() {
  var features = map.queryRenderedFeatures({ layers: mapbox_layers });

  if (features) {
    var uniqueFeatures = getUniqueFeatures(features, 'title');

    // Enable input container
    filterEl.disabled = false;

    // Populate features for the listing overlay.
    renderListings(uniqueFeatures);

    // Update our listing count
    var listingsCount = $('#feature-listing article').not('.empty').length;

    $('#feature-count').addClass('active').html('<strong>' + listingsCount + '</strong> locations found');

    // Store the current features in sn `locations` variable to
    // later use for filtering on `keyup`.
    if (filterEl.value.length === 0) {
      locations = uniqueFeatures;
    }
  }
});


// -----------------------------------------------------------------------------
// Listener: When map is clicked...
// -----------------------------------------------------------------------------
map.on('click', function (e) {
  var features = map.queryRenderedFeatures(e.point, { layers: mapbox_layers });

  // debugger
  //document.getElementById('debugger').innerHTML = JSON.stringify(features, null, 2);

  if (features.length) {

    // get coordinates from the point and center the map
    map.flyTo({
      center: features[0].geometry.coordinates
    });

    // build our custom attributes
    var html = '';

    if (features.length > 1) {
      // add controls
      html += '<div class="mapboxgl-popup-controls"><button id="control-prev" class="control-prev">Prev</button><button id="control-next" class="control-next">Next</button></div>';

      // add opening group
      html += '<div class="control-group">';
    }

    features.forEach(function(feature) {

      // feature properties
      var property = feature.properties;
      var thumbnail   = (property.thumbnail) ? '<div class="marker-photo"><img src="' + property.thumbnail + '" /></div>' : '';
      var title       = (property.title) ? property.title : '';
      var permalink   = (property.permalink) ? '<div class="marker-action"><a class="button secondary" href="' + property.permalink + '" target="_blank">View Details</a></div>' : '';
      var category    = (property.category) ? property.category : '';
      var subcategory = (property.subcategory) ? '<div class="marker-category">' + property.subcategory + '</div>' : '';
      var site_num    = (property.site_number) ? '<div class="marker-site-number">Site ' + property.site_number + '</div>' : '';
      var acres       = (property.acres) ? '<div class="marker-acres">' + property.acres + ' acres</div>' : '';
      var space_type  = (property.space_type) ? '<div class="marker-space">' + property.space_type + '</div>' : '';
      var sqft        = (property.sqft) ? '<div class="marker-sqft">' + property.sqft + ' sqft</div>' : '';
      var address1    = (property.address1) ? property.address1 : '';
      var address2    = (property.address2) ? property.address2 : '';
      var city        = 'Research Triangle Park';
      var state       = 'NC';
      var zipcode     = '27709';

      // build our custom title
      if ( title && permalink ) {
        title = '<div class="marker-title"><a href="' + property.permalink + '" target="_blank">' + property.title + '</a></div>';
      } else if ( title ) {
        title = '<div class="marker-title">' + property.title + '</div>';
      } else {
        title = '';
      }

      // build our custom address
      if ( address1 && address2 ) {
        address = '<div class="marker-address">' + address1 + '<br />' + address2 + '<br />' + city + ' ' + state + ', ' + zipcode + '</div>';
      } else if ( address1 ) {
        address = '<div class="marker-address">' + address1 + '<br />' + city + ' ' + state + ', ' + zipcode + '</div>';
      } else {
        address = '';
      }

      // setup our html
      if (category == "site") {
        html += '<div class="location ' + property.category + '">' + thumbnail + subcategory + title + site_num + acres + permalink +  '</div>';
      } else if (category == "space") {
        html += '<div class="location ' + property.category + '">' + thumbnail + subcategory + title + space_type + sqft + permalink +  '</div>';
      } else {
        html += '<div class="location ' + property.category + '">' + thumbnail + subcategory + title + address + permalink +  '</div>';
      }

    });

    if (features.length > 1) {
      // add closing group
      html += '</div>';
    }

    // Populate the popup and set its coordinates
    // based on the feature found.
    var popup = new mapboxgl.Popup()
    .setLngLat(features[0].geometry.coordinates)
    .setHTML(html)
    .addTo(map);

    // Setup listeners to control popups with multiple locations
    if (features.length > 1) {

      var locations    = document.querySelectorAll('.control-group .location');
      var prevLocation = document.getElementById('control-prev');
      var nextLocation = document.getElementById('control-next');

      // show the first location
      locations[0].classList.add('active');

      prevLocation.addEventListener('click', function() {
        var group    = document.querySelector('.control-group');
        var active   = group.querySelector('.location.active');
        var previous = (active.previousSibling) ? active.previousSibling : group.lastChild;

        active.classList.remove('active');
        previous.classList.add('active');
      });
      nextLocation.addEventListener('click', function() {
        var group  = document.querySelector('.control-group');
        var active = document.querySelector('.control-group .location.active');
        var next   = (active.nextSibling) ? active.nextSibling : group.firstChild;

        active.classList.remove('active');
        next.classList.add('active');
      });
    }

  } else {
    return;
  }
});


// -----------------------------------------------------------------------------
// Listener: When searching map...
// -----------------------------------------------------------------------------
filterEl.addEventListener('keyup', function(e) {
  var value = normalize(e.target.value);

  // Filter visible features that don't match the input value.
  var filtered = locations.filter(function(feature) {
    var name = normalize(feature.properties.title);
    var address = normalize(feature.properties.address1);

    return name.indexOf(value) > -1 || address.indexOf(value) > -1;
  });

  // Remove popup
  popup.remove();

  // Populate the sidebar with filtered results
  renderListings(filtered);

  // Update our listing count
  var listingsCount = $('#feature-listing article').not('.empty').length;

  $('#feature-count').addClass('active').html('<strong>' + listingsCount + '</strong> locations found');

  // Set the filter to populate features into the layer.
  mapbox_layers.forEach(function(layer) {
    map.setFilter(layer, ['in', 'title'].concat(filtered.map(function(feature) {
      return feature.properties.title;
    })));
  });

});


// Call this function on initialization
// passing an empty array to render an empty state
renderListings([]);
