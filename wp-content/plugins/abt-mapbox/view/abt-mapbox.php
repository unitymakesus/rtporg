<?php
  //
  // ABT Mapbox Layout Template
  // Description: custom layout template that renders out an interactive map
  // from Mapbox API
  //
?>

<pre id="debugger" class="debugger"></pre>

<div id="map" class="map"></div>
<div id="map-menu" class="map-menu"></div>
<nav id="filter-group" class="filter-group"></nav>

<div class="map-overlay">
  <fieldset>
    <input id="feature-filter" type="text" placeholder="Filter results by name or street" disabled />
  </fieldset>
  <div id="feature-count" class="feature-count"></div>
  <div id="feature-listing" class="listing"></div>
</div>

<div id="preloader" class="preloader"></div>

<?php
  // Enqueue required styles
  wp_enqueue_style('mapbox-gl-css', 'https://api.tiles.mapbox.com/mapbox-gl-js/v0.37.0/mapbox-gl.css', null, '', 'screen');

  // Enqueue required scripts
  wp_enqueue_script('mapbox-gl-js', 'https://api.tiles.mapbox.com/mapbox-gl-js/v0.37.0/mapbox-gl.js', null, '', true );
  wp_enqueue_script('abt_mapbox', plugins_url( '../js/dist/abt-map.js', __FILE__ ), array('jquery'), $core_version, true );
?>
