<?php
/**
 * Single Company Page
 *
 */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();

  $id = get_the_id();
  $location_terms = wp_get_object_terms($id, 'rtp-company-type', array('fields' => 'all'));

  $company_logo = get_field('company_logo');
  $location_photo = get_field('location_photograph');

  // Location
  $within_facility = get_field('within_facility');
  if ($within_facility == true) {
    $related_facility = get_field('related_facility');
    $suite_or_building = get_field('details_suite_or_building');
    $street_address = get_field('street_address', $related_facility[0]);
    $zip_code = get_field('zip_code', $related_facility[0]);
    $feature_type = get_field('geometry_type', $related_facility[0]);
  } else {
    $street_address = get_field('details_street_address');
    $zip_code = get_field('details_zip_code');
    $coords = get_field('details_coordinates');
    $feature_type = 'Point';
  }

  // Get In Touch
  $phone = get_field('details_phone');  // Array
  $fax = get_field('details_fax');
  $website = get_field('details_website');
  $mailing_address = get_field('details_mailing_address');
  $twitter = get_field('details_twitter');
  $contact_ppl = get_field('contact_person'); // Array

  // Operations
  $locations = get_field('operations_locations');
  $us_hq = get_field('details_us_headquarters');
  $global_hq = get_field('details_global_headquarters');

  // Details
  $employment_public = get_field('reporting_data_publish_employment');
  $ft_employment = get_field('reporting_data_full_time_employees');
  $pt_employment = get_field('reporting_data_part_time_employees');
  $year_in_rtp = get_field('reporting_data_year_arrived_in_rtp');
  $university = get_field('reporting_data_university_affiliation');
  $company_size = get_field('reporting_data_company_size');  // Array
  ?>
  <div class="content-container">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-md-8">
          <div class="row flex">
            <?php if(!empty($company_logo)):?>
              <div class="logo-wrapper">
                <div class="company-logo">
                  <div>
                    <div>
                      <img src="<?php the_field('company_logo'); ?>" alt="<?php the_title(); ?>" />
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
            <div class="company-title">
              <h1><?php the_title(); ?></h1>
              <?php if (!empty($location_terms)) : ?>
                <div class="location-meta">
                  <?php foreach ($location_terms as $lt) : ?>
                  <div class="meta-term">
                    <?php if (function_exists('get_wp_term_image')) :?>
                      <div class="meta-icon">
                        <?php $meta_image = get_wp_term_image($lt->term_id);?>
                        <img src="<?php echo $meta_image;?>" alt="" />
                      </div>
                    <?php endif; ?>
                    <?php echo $lt->name; ?>
                  </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-md-4">
          <div class="box">
            <?php if (!empty($website)) : ?>
              <a class="website button secondary large" href="<?php echo $website; ?>" target="_blank" rel="noopener">Visit Website</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="company-info">
      <div class="row">
        <div class="col-xs-12 col-md-6">
          <div class="container-fluid">
            <?php the_content(); ?>

            <?php if (!empty($year_in_rtp) || ($employment_public == true && !empty($company_size)) || !empty($university[0]) || (!empty($locations) && $locations !== 'Located in RTP only')) : ?>
              <h2>Additional Details</h2>

              <div class="indent">
                <dl>
                  <?php if (!empty($year_in_rtp)) { ?>
                    <dt>Arrived in RTP:</dt>
                    <dd><span><?php the_field('reporting_data_year_arrived_in_rtp'); ?></span></dd>
                  <?php } ?>

                  <?php if ($employment_public == true && !empty($company_size)) { ?>
                    <dt>Company Size:</dt>
                    <dd><span><?php echo $company_size ?> Employees</span></dd>
                  <?php } ?>

                  <?php if ($locations == 'Multiple countries') { ?>
                    <dt>Global Headquarters:</dt>
                    <dd><span><?php the_field('operations_global_headquarters'); ?></span></dd>
                    <?php if (get_field('operations_global_headquarters' == get_field('operations_us_headquarters'))) { ?>
                      <dt>US Headquarters:</dt>
                      <dd><span><?php the_field('operations_us_headquarters'); ?></span></dd>
                    <?php } ?>
                  <?php } elseif ($locations == 'Multiple US locations') { ?>
                    <dt>Headquarters:</dt>
                    <dd><span><?php the_field('operations_us_headquarters'); ?></span></dd>
                  <?php } ?>

                  <?php if (!empty($university[0])) { ?>
                  <dt>University Affiliation:</dt>
                    <dd><span><?php echo implode(', ', $university); ?></span></dd>
                  <?php } ?>
                </dl>
              </div>
            <?php endif; ?>

            <?php if (($phone['public'] == true && !empty($phone['number'])) || ($fax['public'] == true && !empty($fax['number'])) || !empty($twitter) || !empty($mailing_address) || !empty($contact_ppl)) : ?>
              <h2>Get In Touch</h2>

              <div class="indent">
                <dl>
                  <?php if ($phone['public'] == true && !empty($phone['number'])) { ?>
                    <dt>Phone:</dt>
                    <dd><span><?php echo $phone['number']; ?></span></dd>
                  <?php } ?>

                  <?php if ($fax['public'] == true && !empty($fax['number'])) { ?>
                    <dt>Fax:</dt>
                    <dd><span><?php echo $fax['number']; ?></span></dd>
                  <?php } ?>

                  <?php if (!empty($twitter)) { ?>
                    <dt>Twitter:</dt>
                    <dd><span><a href="https://www.twitter.com/<?php echo $twitter; ?>" target="_blank" rel="noopener">@<?php echo $twitter; ?></a></span></dd>
                  <?php } ?>

                  <?php if (!empty($mailing_address)) { ?>
                    <dt>Mailing Address:</dt>
                    <dd><span><?php echo $mailing_address; ?></span></dd>
                  <?php } ?>

                  <?php if (!empty($contact_ppl)) { ?>
                    <?php foreach($contact_ppl as $contact) { ?>
                      <?php if (!empty($contact['email']) || !empty($contact['phone'])) { ?>
                        <?php if ($contact['pr_contact'] == true) { ?>
                          <dt>PR Contact:</dt>
                        <?php } else { ?>
                          <dt>General Contact:</dt>
                        <?php } ?>
                        <dd><span>
                          <?php
                            if (!empty($contact['title'])) {
                              echo $contact['name'];
                              if (!empty($contact['title'])) {
                                echo ', ' . $contact['title'];
                              }
                              if (!empty($contact['phone']) || !empty($contact['email'])) {
                                echo '<br />';
                              }
                            }
                            if (!empty($contact['phone'])) {
                              echo $contact['phone'];
                              if (!empty($contact['email'])) {
                                echo '<br />';
                              }
                            }
                            if (!empty($contact['email'])) {
                              echo '<a href="mailto:' . $contact['email'] . '" target="_blank" rel="noopener">' . $contact['email'] . '</a>';
                            }
                          ?>
                        </span></dd>
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>
                </dl>
              </div>
            <?php endif; ?>

            <?php if (!empty($website)) : ?>
              <a class="button secondary large" href="<?php echo $website; ?>" target="_blank" rel="noopener">Visit Website</a>
            <?php endif; ?>
          </div>
        </div>

        <div class="col-xs-12 col-md-6">
          <div class="location-map-wrapper">
            <div class="location-map" id="location-map" data-post-type="rtp-company" data-feature-type="<?php echo $feature_type; ?>" data-location-id="<?php echo get_the_id(); ?>">
              <div class="rtp-loader-wrap">
                <div class="rtp-loader-icon">
                  <div class="row">
                     <div class="arrow up outer outer-18"></div>
                     <div class="arrow down outer outer-17"></div>
                     <div class="arrow up outer outer-16"></div>
                     <div class="arrow down outer outer-15"></div>
                     <div class="arrow up outer outer-14"></div>
                  </div>
                  <div class="row">
                     <div class="arrow up outer outer-1"></div>
                     <div class="arrow down outer outer-2"></div>
                     <div class="arrow up inner inner-6"></div>
                     <div class="arrow down inner inner-5"></div>
                     <div class="arrow up inner inner-4"></div>
                     <div class="arrow down outer outer-13"></div>
                     <div class="arrow up outer outer-12"></div>
                  </div>
                  <div class="row">
                     <div class="arrow down outer outer-3"></div>
                     <div class="arrow up outer outer-4"></div>
                     <div class="arrow down inner inner-1"></div>
                     <div class="arrow up inner inner-2"></div>
                     <div class="arrow down inner inner-3"></div>
                     <div class="arrow up outer outer-11"></div>
                     <div class="arrow down outer outer-10"></div>
                  </div>
                  <div class="row">
                     <div class="arrow down outer outer-5"></div>
                     <div class="arrow up outer outer-6"></div>
                     <div class="arrow down outer outer-7"></div>
                     <div class="arrow up outer outer-8"></div>
                     <div class="arrow down outer outer-9"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="address">
            <?php //var_dump($within_facility); ?>
            <?php //var_dump($related_facility); ?>
            <?php //var_dump($suite_or_building); ?>
            <?php //var_dump($street_address); ?>
            <?php //var_dump($coords); ?>

            <?php if ($within_facility == 'true') { ?>
              <strong><?php echo get_the_title($related_facility[0]); ?></strong>
              <?php if (!empty($suite_or_building)) {
                echo '<br />' . $suite_or_building;
              } ?>
              <br />
            <?php } ?>

            <?php if (!empty($street_address)) {
              echo $street_address . '<br />';
              echo 'RTP, NC ';
              if (!empty($zip_code)) {
                echo $zip_code;
              } else {
                echo '27709';
              }
            } ?>
          </div>

          <div class="location-photo">
            <?php if (!empty($location_photo)) { ?>
              <img src="<?php echo $location_photo['sizes']['large']; ?>" alt="<?php the_title(); ?> Photograph"/>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
