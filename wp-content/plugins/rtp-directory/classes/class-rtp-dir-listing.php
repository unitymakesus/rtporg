<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

/**
 * RTP_Dir_Listing Class
 *
 * @class RTP_Dir_Listing
 * @version	1.0.0
 * @since 1.0.0
 * @package	RTP_Dir
 * @author Unity
 */
class RTP_Dir_Listing {
 	/**
 	 * Constructor function
 	 * @access  public
 	 * @since   1.0.0
 	 */
 	public function __construct () {}

 	/**
 	 * Get JSON formatted list of facilities
 	 * @access  public
 	 * @since   1.0.0
 	 * @var     string
 	 */
  public function get_facilities_json() {
    if (!check_ajax_referer( 'rtp-dir_action', '_ajax_nonce', false )) {
			wp_send_json_error();
    }

    $facilities_array = $this->get_facilities();
    $facilities_json = str_replace(['["[', ']"]'], ['[[', ']]'], json_encode($facilities_array));
    echo $facilities_json;
    wp_die();
  }

 	/**
 	 * Get array
 	 * @access  public
 	 * @since   1.0.0
 	 * @var     array
 	 */
  public function get_facilities() {
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
    return $facilities_array;
  }
}
