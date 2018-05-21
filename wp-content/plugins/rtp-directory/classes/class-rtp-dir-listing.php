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
 	 * Get JSON formatted list of locations
 	 * @access  public
 	 * @since   1.0.0
 	 * @var     string
 	 */
  public function get_locations_json() {
    if (!check_ajax_referer( 'rtp-dir_action', '_ajax_nonce', false )) {
			wp_send_json_error();
    }

    $locations_array = $this->get_all_locations();
    $locations_json = str_replace(['["[', ']"]'], ['[[', ']]'], json_encode($locations_array));
    echo $locations_json;
    wp_die();
  }

  public function get_paged_locations() {
    // Query locations from WPDB
    $locations = new WP_Query(array(
      // 'post_type' => 'rtp-facility',
      'post_type' => ['rtp-company', 'rtp-facility', 'rtp-site', 'rtp-space'],
      'posts_per_page' => 20,
      'orderby' => 'title',
      'order' => 'ASC',
      'facetwp' => true,
    ));

    return $locations;
  }

 	/**
 	 * Get array
 	 * @access  public
 	 * @since   1.0.0
 	 * @var     array
 	 */
  public function get_all_locations() {
    // Set up array containers
    $locations_array = array(
      'type' => 'FeatureCollection',
      'features' => array(),
    );

    // Query locations from WPDB
    $locations = new WP_Query(array(
      // 'post_type' => 'rtp-facility',
      'post_type' => ['rtp-company', 'rtp-facility', 'rtp-site', 'rtp-space'],
      'posts_per_page' => -1,
      'orderby' => 'title',
      'order' => 'ASC',
      // 'facetwp' => true,
    ));

    if ($locations->have_posts()) : while ($locations->have_posts()) : $locations->the_post();
      $id = get_the_id();
      $location_type = get_post_type();
      $coords_array = array();

      if ($location_type == 'rtp-facility') {
        // Show facilities with appropriate geometry
        $facility_type = wp_get_object_terms($id, 'rtp-facility-type', array('fields' => 'all'));

        $feature_type = get_field('geometry_type');
        switch ($feature_type) {
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

        $properties = array(
          'id' => $id,
          'title' => get_the_title(),
          'content-type' => $location_type,
          'facility-type' => $facility_type[0]->slug,
          'color' => '#038798',
          'hover-color' => '#0A0398',
          'opacity' => 1,
          'hover-opacity' => 1
        );

        foreach ($facility_type as $ftype) {
          $properties['facility-facet-'.$ftype->slug] = true;
        }

      } elseif ($location_type == 'rtp-company') {
        // Only add to map if it's not within a facility
        if (get_field('within_facility') == 0) {
          $feature_type = 'Point';
          $company_types = wp_get_object_terms($id, 'rtp-company-type', array('fields' => 'slugs'));

          $coords = get_field('details_coordinates');
          if (!empty($coords['lat'])) {
            $coords_array = array(
              $coords['lng'],
              $coords['lat']
            );
          }

          $properties = array(
            'id' => $id,
            'title' => get_the_title(),
            'content-type' => $location_type
          );

          foreach ($company_types as $ctype) {
            $properties['company-facet-'.$ctype] = true;
          }

        }
      } elseif ($location_type == 'rtp-space') {
        // Only add to map if it's not within a facility
        if (get_field('within_facility') == 0) {
          $feature_type = 'Point';
          $availability = wp_get_object_terms($id, 'rtp-availability', array('fields' => 'all'));

          $coords = get_field('coords');
          if (!empty($coords['lat'])) {
            $coords_array = array(
              $coords['lng'],
              $coords['lat']
            );
          }

          $properties = array(
            'id' => $id,
            'title' => get_the_title(),
            'content-type' => $location_type,
          );

          foreach ($availability as $avail) {
            $properties['availability-'.$avail->slug] = true;
          }

        }
      } elseif ($location_type == 'rtp-site') {
        // Show sites as polygons on map
        $feature_type = 'Polygon';
        $coords_array = array(array(get_field('coordinates')));
        $availability = wp_get_object_terms($id, 'rtp-availability', array('fields' => 'all'));

        $properties = array(
          'id' => $id,
          'title' => get_the_title(),
          'content-type' => $location_type,
          'color' => '#850B7E',
          'hover-color' => '#850B7E',
          'opacity' => 0.2,
          'hover-opacity' => 1
        );

        foreach ($availability as $avail) {
          $properties['availability-'.$avail->slug] = true;
        }

      }

      if (!empty($coords_array)) {
        $locations_array['features'][] = array(
          'type' => 'Feature',
          'geometry' => array(
            'type' => $feature_type,
            'coordinates' => $coords_array
          ),
          'properties' => $properties
        );
      }
    endwhile; endif; wp_reset_postdata();
    return $locations_array;
  }
}
