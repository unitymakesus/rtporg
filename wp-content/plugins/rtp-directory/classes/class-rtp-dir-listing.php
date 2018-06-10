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

    // Query locations from WPDB
    $locations = new WP_Query(array(
      'post_type' => ['rtp-company', 'rtp-facility', 'rtp-site', 'rtp-space'],
      'posts_per_page' => -1,
      'orderby' => 'title',
      'order' => 'ASC',
    ));

    // Set up array containers
    $locations_array = array(
      'type' => 'FeatureCollection',
      'features' => array(),
    );

    if ($locations->have_posts()) :
      while ($locations->have_posts()) :
        $locations->the_post();
        $id = get_the_id();
        $location_type = get_post_type();
        $coords_array = array();
        $this->setup_location_array($id, $location_type, $locations_array, true);
      endwhile;
    endif;
    wp_reset_postdata();

    $locations_json = str_replace(['["[', ']"]'], ['[[', ']]'], json_encode($locations_array));
    echo $locations_json;
    wp_die();
  }

  /** Get JSON formatted location object
   *
   */
  public function get_this_location_json() {
    if (!check_ajax_referer( 'rtp-dir_action', '_ajax_nonce', false )) {
			wp_send_json_error();
    }

    $id = $_POST['location_id'];
    $location_type = $_POST['post_type'];

    $locations_array = array(
      'type' => 'FeatureCollection',
      'features' => array(),
    );

    $this->setup_location_array($id, $location_type, $locations_array, false);
    // error_log(print_r($locations_array, true));
    $locations_json = str_replace(['["[', ']"]'], ['[[', ']]'], json_encode($locations_array));
    echo $locations_json;
    wp_die();
  }

  private function setup_location_array($id, $location_type, &$locations_array, $all) {
    if ($location_type == 'rtp-facility') {
      // Show facilities with appropriate geometry
      $facility_type = wp_get_object_terms($id, 'rtp-facility-type', array('fields' => 'all'));

      $feature_type = get_field('geometry_type', $id);
      switch ($feature_type) {
        case 'Polygon':
          if (!empty($coords = get_field('coordinates_long', $id))) {
            $coords_array = array(array($coords));
          }
          break;
        case 'LineString':
          if (!empty($coords = get_field('coordinates_long', $id))) {
            $coords_array = array($coords);
          }
          break;
        case 'Point':
          $coords = get_field('coordinates', $id);
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
        'hover_id' => $id,
        'title' => get_the_title($id),
        'permalink' => get_permalink($id),
        'photo' => get_the_post_thumbnail_url($id),
        'content-type' => $location_type,
        'facility-type' => $facility_type[0]->slug,
        'street_address' => get_field('street_address', $id),
        'color' => '#038798',
        'hover-color' => '#0A0398',
        'opacity' => 1,
        'hover-opacity' => 1
      );

      if ($all == true) {
        if ($facility_type[0]->slug == 'multi-tenant') {
          $tenants = $this->get_facility_tenant_ids($id);
          foreach ($tenants as $t) {
            $properties['tenant-id-' . $t->id] = true;
          }
        }
      }

    } elseif ($location_type == 'rtp-company') {
      // Only add to map if it's not within a facility
      if (get_field('within_facility') == 0) {
        $feature_type = 'Point';
        $company_types = wp_get_object_terms($id, 'rtp-company-type', array('fields' => 'slugs'));

        $coords = get_field('details_coordinates', $id);
        if (!empty($coords['lat'])) {
          $coords_array = array(
            $coords['lng'],
            $coords['lat']
          );
        }

        $properties = array(
          'id' => $id,
          'hover_id' => $id,
          'title' => get_the_title($id),
          'permalink' => get_permalink($id),
          'logo' => get_field('company_logo', $id),
          'photo' => get_field('location_photograph', $id),
          'content-type' => $location_type
        );
      }

    } elseif ($location_type == 'rtp-space') {
      // Only add to map if it's not within a facility
      if (get_field('within_facility', $id) == 0) {
        $feature_type = 'Point';
        $availability = wp_get_object_terms($id, 'rtp-availability', array('fields' => 'all'));

        $coords = get_field('coords', $id);
        if (!empty($coords['lat'])) {
          $coords_array = array(
            $coords['lng'],
            $coords['lat']
          );
        }

        $properties = array(
          'id' => $id,
          'hover_id' => $id,
          'title' => get_the_title($id),
          'permalink' => get_permalink($id),
          'photo' => get_the_post_thumbnail_url($id),
          'content-type' => $location_type,
        );

        foreach ($availability as $avail) {
          $properties['availability-'.$avail->slug] = true;
        }

      }
    } elseif ($location_type == 'rtp-site') {
      // Show sites as polygons on map
      $feature_type = 'Polygon';
      $coords_array = array(array(get_field('coordinates', $id)));
      $availability = wp_get_object_terms($id, 'rtp-availability', array('fields' => 'all'));

      $properties = array(
        'id' => $id,
        'hover_id' => $id,
        'title' => get_the_title($id),
        'permalink' => get_permalink($id),
        'photo' => get_the_post_thumbnail_url($id),
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
  }

  public function get_paged_locations() {
    $locations = new WP_Query(array(
      'post_type' => ['rtp-company', 'rtp-facility', 'rtp-site', 'rtp-space'],
      'posts_per_page' => 20,
      'orderby' => 'post_type',
      'order' => 'ASC',
      'facetwp' => true,
    ));

    return $locations;
  }

  public function get_facility_tenant_ids($id) {
    global $wpdb;
    $like_id = '%"' . $id . '"%';
    $query = "SELECT id FROM {$wpdb->prefix}posts AS p INNER JOIN {$wpdb->prefix}postmeta AS pm ON (p.ID = pm.post_id) WHERE 1=1 AND (pm.meta_key = 'related_facility' AND pm.meta_value LIKE %s) AND p.post_type IN ('rtp-company', 'rtp-space') AND p.post_status = 'publish' GROUP BY p.ID";
    $sql = $wpdb->prepare($query, $like_id);
    $tenants = $wpdb->get_results($sql);

    return $tenants;
  }

}
