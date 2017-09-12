<?php

/**
 * Shortcodes
 ==================================================================================================================*/

add_action('init', 'abtcode_register_shortcodes', 100);

function abtcode_register_shortcodes() {
	add_filter('the_content', 'abtcore_shortcode_empty_paragraph_fix'); // fixes empty paragraphs in shortcodes

	add_shortcode( 'button', 'abtcore_shortcode_button' ); // adds button markup
	add_shortcode( 'abt_google_conversion', 'abtcore_google_conversion' ); // adds Google conversion code
	add_shortcode( 'googlemap', 'abtcore_shortcode_googlemap' ); // adds Google Map
	
	remove_shortcode('wp_caption');
	add_shortcode('wp_caption', 'abtcore_img_caption_shortcode');
	do_action('abtcore_register_shortcodes');
}


/**
 * Shortcode Functions
 ==================================================================================================================*/

/**
 * Empty Paragraph Fix for Shortcodes
 *
 * @since ABT Core v0.9.3
 */
function abtcore_shortcode_empty_paragraph_fix($content) {   
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']', 
		']<br />' => ']'
	);
	
	$content = strtr($content, $array);
	
	return $content;
}

if ( ! function_exists( 'abtcore_shortcode_button' ) ) :
/**
 * Button Shortcode
 * adds necessary mark up for button styling, based on CSS
 * Usage: [button color="CSS_CLASS"] LINK_TEXT_ANCHOR [/button]
 *
 * @param color = CSS Class for color (optional)
 *
 * @since ABT Core v0.9.3
 */
function abtcore_shortcode_button( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'color' => 'blue'
		), $atts ) );
		
		/* color should be built into the CSS */
	
	return '<p class="button ' . $color . '">' . $content . '</p>';
	
}
endif;

if ( ! function_exists( 'abtcore_google_conversion' ) ) :
/**
 * Google Conversion shortcode
 * Usage: [abt_google_conversion id="ACCOUNT_ID" label="TRACKING_LABEL" conversion_value="DOLLAR_AMOUNT" lang="en" format="3" color="ffffff" /]
 *
 * @param id = Account ID, like "1010518255" (required)
 * @param label = Tracking label, like "HK7hCMLklQIQ5pHt4QM" (required)
 * @param conversion_value = $ amount (optional)
 * @param lang = language code, like "en" (default "en")
 * @param format = conversion format, like "3" (default "3")
 * @param color = conversion color, like "ffffff" (default "ffffff") [note: no # required]
 *
 * @since ABT Core v0.9.3
 */ 
function abtcore_google_conversion( $atts, $content = null ) {
		$options = abtcore_get_option();
		
		$adwordid = 
			isset( $options ) && isset( $options['google_adwords_id'] ) ? 
			$options['google_adwords_id'] : '';
		
		$adwordlabel = 
			isset( $options ) && isset( $options['google_adwords_label'] ) ? 
			$options['google_adwords_label'] : '';
		
		//parse attributes, apply defaults, extract to variables
		extract(shortcode_atts(array(
			'id'               => $adwordid,
			'label'            => $adwordlabel,
			'lang'             => 'en',
			'format'           => 3,
			'color'            => 'ffffff',
			'conversion_value' => false,	//optional if(this){ google_conversion_value = this; }
		), $atts));
		
		//error if no id or label
		if( !$id || !$label ) {
			return 
				'<div class="google-adword-notice">' .
				'<h1 class="google-adword-notice">Notice</h1>'.
				'<p class="google-adword-notice">'.
				'The Google AdWords shortcode requires an AdWords ID and Label'.
				'</p>'.
				'</div>';
		}
		
		// cheat!
		/* catch the echo output, so we can control where it appears in the text  */
		ob_start();		
		
		abtcore_google_adwords_conversion($id, $label, $lang, $format, $color, $conversion_value);
		
		return ob_get_clean();
}//-----	function abtcore_google_conversion
endif;

if ( ! function_exists( 'abtcore_shortcode_googlemap' ) ) :
/**
 * Google Maps shortcode
 * Usage: [googlemap ll="LATITUDE_LONGITUDE" width="WIDTH" height="HEIGHT" zoom="ZOOM_AMOUNT" /]
 *
 * @param ll = Google's latitude and longitude string, like '28.419683,-81.580267' (default is Disney World)
 * @param width = Width of map canvas, like "500" (default is 500)
 * @param height = Height of map canvas, like "300" (default is 300)
 * @param zoom = Zoom in/out amount, like "13" (default is 13)
 *
 * Returns a div#gmap with bouncing marker
 *
 * @since ABT Core v0.9.3
 */
function abtcore_shortcode_googlemap( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'll' => '28.419683,-81.580267', // Disney World
		'width' => 500,
		'height' => 300,
		'zoom' => 13
		), $atts ) );
	
	return abtcore_googlemap($ll, $width, $height, $zoom);	

}
endif;

if ( ! function_exists( 'abtcore_googlemap' ) ) :
function abtcore_googlemap( $ll = '28.419683,-81.580267', $width = 500, $height = 300, $zoom = 13 ) {
	
	$scriptstr = '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>';
	$scriptstr .= '<script type="text/javascript">';
	$scriptstr .= 'var hq = new google.maps.LatLng(' . $ll . ');';
	$scriptstr .= 'var maphq;';
	  
	$scriptstr .= 'function initialize() {';
	$scriptstr .= 'var mapOptions = {';
	$scriptstr .= 'zoom: ' . $zoom . ', mapTypeId: google.maps.MapTypeId.ROADMAP, mapTypeControl: true, mapTypeControlOptions: { style: google.maps.MapTypeControlStyle.DROPDOWN_MENU },zoomControl: true, zoomControlOptions: { style: google.maps.ZoomControlStyle.SMALL }, center: hq };';
		
	$scriptstr .= 'maphq = new google.maps.Map(document.getElementById("gmap"), mapOptions);';
	$scriptstr .= 'marker = new google.maps.Marker({ map: maphq, draggable: false, animation: google.maps.Animation.DROP, position: hq });';
	$scriptstr .= 'google.maps.event.addListener(marker, "click", function () { toggleBounce(marker); });';
	$scriptstr .= '}';
	
	$scriptstr .= 'function toggleBounce(marker) {';	
	$scriptstr .= 'if (marker.getAnimation() != null) {';
	$scriptstr .= 'marker.setAnimation(null);';
	$scriptstr .= '} else {';
	$scriptstr .= 'marker.setAnimation(google.maps.Animation.BOUNCE);';
	$scriptstr .= '}';
	$scriptstr .= '}';
	$scriptstr .= '</script>';
    $scriptstr .= '<script type="text/javascript">';
	$scriptstr .= '$(document).ready(function() {';
	$scriptstr .= 'initialize();';			  
	$scriptstr .= '},function(){';
	$scriptstr .= 'GUnload();';
	$scriptstr .= '});';
	$scriptstr .= '</script>';
	
	$scriptstr .= '<div id="gmap" style="width: ' . $width . 'px; height: ' . $height . 'px;"></div>';
	
	return apply_filters('abtcore_googlemap', $scriptstr);
	
}
endif;

if ( ! function_exists( 'abtcore_img_caption_shortcode' ) ) :
/**
 * Override The WP Caption shortcode. Make it HTML5
 *
 * Allows a plugin to replace the content that would otherwise be returned. The
 * filter is 'img_caption_shortcode' and passes an empty string, the attr
 * parameter and the content parameter values.
 *
 * The supported attributes for the shortcode are 'id', 'align', 'width', and
 * 'caption'.
 *
 * @param array $attr Attributes attributed to the shortcode.
 * @param string $content Optional. Shortcode content.
 * @return string
 *
 * @since ABT Core v0.9.3
 */
function abtcore_img_caption_shortcode($attr, $content = null) {

	// Allow plugins/themes to override the default caption template.
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . (10 + (int) $width) . 'px">' . do_shortcode( $content ) . '<figcaption>' . $caption . '</figcaption></figure>';
}
endif;
?>