<?php
/**
 * Single Site Page
 *
 */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();

  $id = get_the_id();
  $location_terms = wp_get_object_terms($id, 'rtp-availability', array('fields' => 'all'));

  $location_photo = get_the_post_thumbnail_url();

  // Location
  $within_facility = get_field('within_facility');
  if ($within_facility == true) {
    $related_facility = get_field('related_facility');
    $street_address = get_field('street_address', $related_facility[0]);
  } else {
    $street_address = get_field('street_address');
    $coords = get_field('coords');
  }

  // Details
  $link = get_field('link');

  // Get In Touch
  $contact_co = get_field('contact_company');
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
            <?php if (!empty($link)) : ?>
              <a class="website button secondary large" href="<?php echo $link; ?>" target="_blank" rel="noopener">More Information</a>
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

            <?php if (!empty($contact_ppl)) { ?>
              <h2>Get In Touch</h2>

              <div class="indent">
                <?php foreach($contact_ppl as $contact) { ?>
                  <p>
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
                  </p>
                <?php } ?>
              </div>
            <?php } ?>

            <?php if (!empty($link)) : ?>
              <a class="button secondary large" href="<?php echo $link; ?>" target="_blank" rel="noopener">More Information</a>
            <?php endif; ?>
          </div>
        </div>

        <div class="col-xs-12 col-md-6">
          <div class="location-map-wrapper">
            <div class="location-map" id="location-map"></div>
          </div>
          <div class="address">
            <?php if ($within_facility == 'true') { ?>
              <strong><?php echo get_the_title($related_facility[0]); ?></strong>
              <br />
            <?php } ?>

            <?php echo $street_address; ?><br />
              RTP, NC 27709
          </div>

          <div class="location-photo">
            <?php if (!empty($location_photo)) { ?>
              <img src="<?php echo $location_photo; ?>" alt="<?php the_title(); ?> Photograph"/>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
