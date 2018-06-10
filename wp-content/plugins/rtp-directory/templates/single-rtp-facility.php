<?php
/**
 * Single Company Page
 *
 */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();

  $id = get_the_id();
  $location_terms = wp_get_object_terms($id, 'rtp-facility-type', array('fields' => 'all'));

  $location_photo = get_the_post_thumbnail_url();

  // Location
  $street_address = get_field('street_address');
  $geometry = get_field('geometry_type');
  if ($geometry == 'Point') {
    $coords = get_fields('coordinates');
  } else {
    $coords = get_fields('coordinates_long');
  }

  // Get In Touch
  $ownership = get_field('facility_ownership');
  $contact_ppl = get_field('contact_person'); // Array
  ?>
  <div class="content-container">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-md-8">
          <div class="box">
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

    <?php
    /**
     * Multi-Tenant Facility Layout
     */
    if ($location_terms[0]->slug == 'multi-tenant') :
    ?>

      <div class="facility-info">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <?php the_content(); ?>
            </div>
            <div class="col-md-4">
              <p class="address">
                <?php if (!empty($street_address)) {
                  echo $street_address;
                } ?><br />
                RTP, NC 27709
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="directory-listing">
        <div class="row">
          <div class="col-xs-12 col-sm-6 facetwp-template">
            <div class="clearfix vertical-padding">
  						<?php
  						$tenants = (new RTP_Dir_Listing)->get_facility_tenant_ids($id);
              $original_post = $post;
              if (!empty($tenants)) :
                foreach ($tenants as $tenant) :
                  $post = get_post($tenant->id);
                  setup_postdata($post);
  								$location_type = get_post_type($tenant->id);

  								if ($location_type == 'rtp-space' || $location_type == 'rtp-site') {
  									$location_terms = wp_get_object_terms($tenant->id, 'rtp-availability', array('fields' => 'all'));
  								} elseif ($location_type == 'rtp-company') {
  									$location_terms = wp_get_object_terms($tenant->id, 'rtp-company-type', array('fields' => 'all'));
  								}
  								?>
  								<div class="result-item">
  									<div class="result-logo">
  										<?php $logo = get_field('company_logo'); if(!empty($logo)):?>
  											<img src="<?php the_field('company_logo'); ?>" alt="<?php the_title(); ?>" />
  										<?php endif; ?>
  									</div>

  									<div class="result-details">
  										<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
  										<?php if (!empty($location_terms)) : ?>
  											<div class="result-meta">
  												<?php foreach ($location_terms as $lt) : ?>
  												<div class="meta-term"><?php echo $lt->name; ?></div>
  												<div class="meta-icon">
  													<?php if (function_exists('get_wp_term_image')) :?>
  														<?php $meta_image = get_wp_term_image($lt->term_id);?>
  														<img src="<?php echo $meta_image;?>"/>
  													<?php endif; ?>
  												</div>
  												<?php endforeach; ?>
  											</div>
  										<?php endif; ?>
  									</div>
  								</div>
  								<?php
  							endforeach; wp_reset_postdata();
                $post = $original_post;
  				    else :
  				      echo '<p>';
  								_e( 'Sorry, no resources matched your criteria.' );
  							echo '</p>';
  				    endif;
  						?>
            </div>
          </div>

          <div class="col-xs-12 col-sm-8 col-md-6">
            <div id="location-map" class="directory-map"></div>
          </div>
        </div>
      </div>

    <?php
    /**
     * Recreation and Trails Layout
     */
    else : ?>

      <div class="company-info">
        <div class="row">
          <div class="col-xs-12 col-md-6">
            <div class="container-fluid">
              <?php the_content(); ?>

              <?php if (!empty($contact_ppl)) { ?>
                <h2>Get In Touch</h2>

                <div class="indent">
                  <?php foreach($contact_ppl as $contact) { ?>
                    <dl>
                      <?php if (!empty($ownership)) { ?>
                        <dt><?php echo $ownership; ?></dt>
                      <?php } ?>
                      <dd class="new-line">
                        <?php if (!empty($contact['email']) || !empty($contact['phone'])) { ?>
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
                        <?php } ?>
                      </dd>
                    </dl>
                  <?php } ?>
                </div>
              <?php } ?>

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

    <?php endif; ?>

  </div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
