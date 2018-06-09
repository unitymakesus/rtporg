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
    $suite_or_building = get_field('suite_or_building');
    $street_address = get_field('street_address', $related_facility[0]);
  } else {
    $street_address = get_field('street_address');
    $coords = get_field('details_coordinates');
  }

  // Get In Touch
  $phone = get_field('details_phone');  // Array
  $fax = get_field('details_fax');
  $website = get_field('details_website');
  $mailing_address = get_field('details_rtp_po_box');
  $twitter = get_field('details_twitter');
  $contact_ppl = get_field('contact_person'); // Array

  // Operations
  $locations = get_field('operations_locations');
  $us_hq = get_field('details_us_headquarters');
  $global_hq = get_field('details_global_headquarters');

  // Details
  $employment_public = get_field('eporting_data_publish_employment');
  $ft_employment = get_field('eporting_data_full_time_employees');
  $pt_employment = get_field('eporting_data_part_time_employees');
  $year_in_rtp = get_field('eporting_data_year_arrived_in_rtp');
  $university = get_field('eporting_data_university_affiliation');
  $company_size = get_field('eporting_data_company_size');  // Array
  ?>
  <div class="content-container">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-md-8">
          <div class="box">
            <div class="company-logo">
              <div>
                <?php if(!empty($company_logo)):?>
                  <img src="<?php the_field('company_logo'); ?>" alt="<?php the_title(); ?>" />
                <?php endif; ?>
              </div>
            </div>
            <h1><?php the_title(); ?></h1>
            <?php if (!empty($location_terms)) : ?>
              <div class="result-meta">
                <?php foreach ($location_terms as $lt) : ?>
                <div class="meta-term"><?php echo $lt->name; ?></div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
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

            <h2>Additional Details</h2>

            <div class="indent">
              <dl>
                <?php if (!empty($year_in_rtp)) { ?>
                  <dt>Arrived in RTP:</dt>
                  <dd><?php the_field('eporting_data_year_arrived_in_rtp'); ?></dd>
                <?php } ?>

                <?php if (!empty($company_size)) { ?>
                  <dt>Company Sizesss:</dt>
                  <dd><?php echo $company_size ?> Employees</dd>
                <?php } ?>

                <?php if ($locations == 'Multiple countries') { ?>
                  <dt>Global Headquarters:</dt>
                  <dd><?php the_field('operations_global_headquarters'); ?></dd>
                  <dt>US Headquarters:</dt>
                  <dd><?php the_field('operations_us_headquarters'); ?></dd>
                <?php } elseif ($locations == 'Multiple US locations') { ?>
                  <dt>Headquarters:</dt>
                  <dd><?php the_field('operations_us_headquarters'); ?></dd>
                <?php } ?>

                <?php if (!empty($university[0])) { ?>
                <dt>University Affiliation:</dt>
                  <dd><?php echo implode(', ', $university); ?></dd>
                <?php } ?>
              </dl>
            </div>

            <h2>Get In Touch</h2>

            <div class="indent">
              <dl>
                <?php if ($phone['public'] == true) { ?>
                  <dt>Phone:</dt>
                  <dd><?php echo $phone['number']; ?></dd>
                <?php } ?>

                <?php if ($fax['public'] == true && !empty($fax['number'])) { ?>
                  <dt>Fax:</dt>
                  <dd><?php echo $fax['number']; ?></dd>
                <?php } ?>

                <?php if (!empty($twitter)) { ?>
                  <dt>Twitter:</dt>
                  <dd><a href="https://www.twitter.com/<?php echo $twitter; ?>" target="_blank" rel="noopener">@<?php echo $twitter; ?></a></dd>
                <?php } ?>

                <?php if (!empty($mailing_address)) { ?>
                  <dt>Mailing Address:</dt>
                  <dd>PLACEHOLDER</dd>
                <?php } ?>

                <?php if (!empty($contact_ppl)) { ?>
                  <?php foreach($contact_ppl as $contact) { ?>
                    <?php if (!empty($contact['email']) || !empty($contact['phone'])) { ?>
                      <?php if ($contact['pr_contact'] == true) { ?>
                        <dt>PR Contact:</dt>
                      <?php } else { ?>
                        <dt>General Contact:</dt>
                      <?php } ?>
                      <dd class="new-line">
                        <?php echo $contact['name']; ?>
                        <?php if (!empty($contact['title'])) { ?>
                          , <?php echo $contact['title']; ?>
                        <?php } ?>
                        <?php if (!empty($contact['phone'])) { ?>
                          <br /> <?php echo $contact['phone']; ?>
                        <?php } ?>
                        <?php if (!empty($contact['email'])) { ?>
                          <br /> <a href="mailto:<?php echo $contact['email']; ?>" target="_blank" rel="noopener"><?php echo $contact['email']; ?></a>
                        <?php } ?>
                      </dd>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
              </dl>
            </div>

            <?php if (!empty($website)) : ?>
              <a class="button secondary large" href="<?php echo $website; ?>" target="_blank" rel="noopener">Visit Website</a>
            <?php endif; ?>
          </div>
        </div>

        <div class="col-xs-12 col-md-6">
          <div class="location-map-wrapper">
            <div class="location-map" id="location-map"></div>
          </div>
          <div class="address">
            <?php //var_dump($within_facility); ?>
            <?php //var_dump($related_facility); ?>
            <?php //var_dump($suite_or_building); ?>
            <?php //var_dump($street_address); ?>
            <?php //var_dump($coords); ?>

            <?php if ($within_facility == 'true') { ?>
              <strong><?php echo get_the_title($related_facility[0]); ?></strong>
              <br />
            <?php } ?>

            <?php echo $street_address; ?><br />
              <?php if (!empty($suite_or_building)) { ?>
                <?php echo $suite_or_building; ?>
              <?php } ?>
              RTP, NC 27709
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
