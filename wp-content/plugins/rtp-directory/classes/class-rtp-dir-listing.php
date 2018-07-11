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
      'post_status' => 'publish',
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
    error_log(print_r($locations_array, true));
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

  // Get coordinates for facilities with appropriate geometry
  private function get_facility_coords($id, $feature_type) {
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

    return $coords_array;
  }

  private function setup_location_array($id, $location_type, &$locations_array, $all) {
    // Set up universal properties for all post types
    $properties = array(
      'id' => $id,
      'hover_id' => $id,
      'title' => get_the_title($id),
      'permalink' => get_permalink($id),
      'content-type' => $location_type
    );

    // Iterate through the different post types
    if ($location_type == 'rtp-facility') {
      $feature_type = get_field('geometry_type', $id);
      $facility_type = wp_get_object_terms($id, 'rtp-facility-type', array('fields' => 'all'));
      $coords_array = $this->get_facility_coords($id, $feature_type);

      $properties = array_merge($properties, array(
        'photo' => get_the_post_thumbnail_url($id, 'medium'),
        'facility-type' => $facility_type[0]->slug,
        'street_address' => get_field('street_address', $id),
        'zip_code' => get_field('zip_code', $id),
        'color' => '#038798',
        'hover-color' => '#0A0398',
        'opacity' => 1,
        'hover-opacity' => 1
      ));

      // Add all tenant ids as properties if this is for all locations view
      if ($all == true) {
        if ($facility_type[0]->slug == 'multi-tenant') {
          $tenants = $this->get_facility_tenant_ids($id);
          foreach ($tenants as $t) {
            $properties['tenant-id-' . $t->id] = true;
          }
        }
      }
    } elseif ($location_type == 'rtp-site') {
      $feature_type = 'Polygon';
      $availability = wp_get_object_terms($id, 'rtp-availability', array('fields' => 'all'));
      $coords_array = array(array(get_field('coordinates', $id)));

      $properties = array_merge($properties, array(
        'photo' => get_the_post_thumbnail_url($id, 'medium'),
        'color' => '#850B7E',
        'hover-color' => '#850B7E',
        'opacity' => 0.2,
        'hover-opacity' => 1
      ));

      // Add availabilities as properties if this is for all locations view
      if ($all == true) {
        foreach ($availability as $avail) {
          $properties['availability-'.$avail->slug] = true;
        }
      }
    } elseif ($location_type == 'rtp-company') {
      // Handle company that's not within a facility
      if (get_field('within_facility', $id) == 0) {
        $feature_type = 'Point';
        $company_types = wp_get_object_terms($id, 'rtp-company-type', array('fields' => 'slugs'));
        $street_address = get_field('details_street_address', $id);
        $zip_code = get_field('details_zip_code', $id);
        $coords = get_field('details_coordinates', $id);
        $location_photo = get_field('location_photograph', $id);

        if (!empty($coords['lat'])) {
          $coords_array = array(
            (float)$coords['lng'],
            (float)$coords['lat']
          );
        }

        $properties = array_merge($properties, array(
          'street_address' => $street_address,
          'zip_code' => $zip_code,
          'logo' => get_field('company_logo', $id),
          'photo' => $location_photo['sizes']['medium']
        ));
      } else {
        // Handle company that IS within a facility
        // (but only for single location view)
        if ($all !== true) {
          $related_facility = get_field('related_facility', $id);
          $feature_type = get_field('geometry_type', $related_facility[0]);
          $street_address = get_field('street_address', $related_facility[0]);
          $suite_or_building = get_field('details_suite_or_building', $id);
          $zip_code = get_field('zip_code', $related_facility[0]);
          $coords_array = $this->get_facility_coords($related_facility[0], $feature_type);
          $location_photo = get_field('location_photograph', $id);

          $properties = array_merge($properties, array(
            'related_facility' => get_the_title($related_facility[0]),
            'street_address' => $street_address,
            'suite_or_building' => $suite_or_building,
            'zip_code' => $zip_code,
            'logo' => get_field('company_logo', $id),
            'photo' => $location_photo['sizes']['medium'],
            'related_photo' => get_the_post_thumbnail_url($related_facility[0], 'medium'),
            'color' => '#038798',
            'hover-color' => '#0A0398',
            'opacity' => 1,
            'hover-opacity' => 1
          ));
        }
      }
    } elseif ($location_type == 'rtp-space') {
      // Handle space that's not within a facility
      if (get_field('within_facility', $id) == 0) {
        $feature_type = 'Point';
        $street_address = get_field('street_address', $id);
        $zip_code = get_field('zip_code', $id);
        $coords = get_field('coords', $id);
        $location_photo = get_field('location_photograph', $id);

        if (!empty($coords['lat'])) {
          $coords_array = array(
            (float)$coords['lng'],
            (float)$coords['lat']
          );
        }

        $properties = array_merge($properties, array(
          'street_address' => $street_address,
          'zip_code' => $zip_code,
          'photo' => $location_photo['sizes']['medium']
        ));

      } else {
        // Handle space that IS within a facility
        // (but only for single location view)
        if ($all !== true) {
          $related_facility = get_field('related_facility', $id);
          $feature_type = get_field('geometry_type', $related_facility[0]);
          $street_address = get_field('street_address', $related_facility[0]);
          $suite_or_building = get_field('details_suite_or_building', $id);
          $zip_code = get_field('zip_code', $related_facility[0]);
          $coords_array = $this->get_facility_coords($related_facility[0], $feature_type);
          $location_photo = get_field('location_photograph', $id);

          $properties = array_merge($properties, array(
            'related_facility' => get_the_title($related_facility[0]),
            'street_address' => $street_address,
            'suite_or_building' => $suite_or_building,
            'zip_code' => $zip_code,
            'photo' => $location_photo['sizes']['medium'],
            'related_photo' => get_the_post_thumbnail_url($related_facility[0], 'medium'),
            'color' => '#038798',
            'hover-color' => '#0A0398',
            'opacity' => 1,
            'hover-opacity' => 1
          ));
        }
      }

      // Add availabilities as properties if this is for all locations view
      $availability = wp_get_object_terms($id, 'rtp-availability', array('fields' => 'all'));
      if ($all == true) {
        foreach ($availability as $avail) {
          $properties['availability-'.$avail->slug] = true;
        }
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
      'post_status' => 'publish',
      'orderby' => 'post_type title',
      'order' => 'ASC',
      'facetwp' => true,
    ));

    return $locations;
  }

  public function get_facility_tenant_ids($id) {
    global $wpdb;
    $like_id = '%"' . $id . '"%';
    $query = "SELECT id FROM {$wpdb->prefix}posts AS p INNER JOIN {$wpdb->prefix}postmeta AS pm ON (p.ID = pm.post_id) WHERE 1=1 AND (pm.meta_key = 'related_facility' AND pm.meta_value LIKE %s) AND p.post_type IN ('rtp-company', 'rtp-space') AND p.post_status = 'publish' GROUP BY p.ID ORDER BY p.post_type DESC, p.post_name ASC";
    $sql = $wpdb->prepare($query, $like_id);
    $tenants = $wpdb->get_results($sql);

    return $tenants;
  }

}
