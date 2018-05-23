jQuery(document).ready(function($) {

    mapboxgl.accessToken = 'pk.eyJ1IjoiYWJ0YWRtaW4iLCJhIjoiY2pmbzd2MXVhMWVjMzJ5bG4xZmg4YTQzOSJ9.gpCo9L71BBeUf5scYBQH_Q';

  	// Initiatlize Map
  	const map = new mapboxgl.Map({
      container: 'static-map',
      style: 'mapbox://styles/abtadmin/cjfo8weeq2rtu2rn0q4tuqp0c',
  		// center: ['-78.8678052','35.8985119'],
  		center: ['-78.865','35.892'],
  		zoom: 12,
      interactive: false
  	});

});
