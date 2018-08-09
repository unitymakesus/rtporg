<?php
/**
* Template Name: Frontier - Events
*
* @package WordPress
* @subpackage ABT_CORE
* @since ABT Core v0.9.3
*/
get_header(); ?>
<?php
  $theme_dir  = get_stylesheet_directory_uri();

  $intro_heading = types_render_field("frontier-events-intro-heading", array("raw"=>"true"));
  $intro_text = do_shortcode(types_render_field("frontier-events-intro-text", array("raw"=>"true")));

  $slide1_name = types_render_field("frontier-events-slide1-name", array("raw"=>"true"));
  $slide1_text = types_render_field("frontier-events-slide1-text", array("raw"=>"true"));
  $slide1_photo = types_render_field("frontier-events-slide1-photo", array("raw"=>"true"));

  $slide2_name = types_render_field("frontier-events-slide2-name", array("raw"=>"true"));
  $slide2_text = types_render_field("frontier-events-slide2-text", array("raw"=>"true"));
  $slide2_photo = types_render_field("frontier-events-slide2-photo", array("raw"=>"true"));

  $slide3_name = types_render_field("frontier-events-slide3-name", array("raw"=>"true"));
  $slide3_text = types_render_field("frontier-events-slide3-text", array("raw"=>"true"));
  $slide3_photo = types_render_field("frontier-events-slide3-photo", array("raw"=>"true"));

  $slide4_name = types_render_field("frontier-events-slide4-name", array("raw"=>"true"));
  $slide4_text = types_render_field("frontier-events-slide4-text", array("raw"=>"true"));
  $slide4_photo = types_render_field("frontier-events-slide4-photo", array("raw"=>"true"));

  $slide5_name = types_render_field("frontier-events-slide5-name", array("raw"=>"true"));
  $slide5_text = types_render_field("frontier-events-slide5-text", array("raw"=>"true"));
  $slide5_photo = types_render_field("frontier-events-slide5-photo", array("raw"=>"true"));

  $events_heading = types_render_field("frontier-events-events-heading", array("raw"=>"true"));
  $events_text = do_shortcode(types_render_field("frontier-events-events-text", array("raw"=>"true")));
?>
<div class="content-container">
  <?php get_template_part('frontier', 'header'); ?>
  <?php get_template_part('featured', 'banners'); ?>
  <section class="featured-banner theme-frosty frontier-about-intro">
    <div>
      <?php if ($intro_heading) : ?>
          <h2><?php echo $intro_heading; ?></h2>
        <?php endif; ?>
        <?php echo $intro_text; ?>
      </div>
  </section>
  <section class="frontier-innovate-gallery">
    <div id="frontier-innovate-gallery" class="owl-carousel owl-theme">
      <div class="item">
        <img src="<?php echo $slide1_photo; ?>" alt="<?php echo $slide1_name; ?>">
        <div class="caption">
          <?php if ($slide1_name) : ?>
            <h3><?php echo $slide1_name; ?></h3>
          <?php endif; ?>
          <?php if ($slide1_text) : ?>
            <p><?php echo $slide1_text; ?></p>
          <?php endif; ?>
        </div>
      </div>
      <div class="item">
        <img src="<?php echo $slide2_photo; ?>" alt="<?php echo $slide2_name; ?>">
        <div class="caption">
          <?php if ($slide2_name) : ?>
            <h3><?php echo $slide2_name; ?></h3>
          <?php endif; ?>
          <?php if ($slide2_text) : ?>
            <p><?php echo $slide2_text; ?></p>
          <?php endif; ?>
        </div>
      </div>
      <div class="item">
        <img src="<?php echo $slide3_photo; ?>" alt="<?php echo $slide3_name; ?>">
        <div class="caption">
          <?php if ($slide3_name) : ?>
            <h3><?php echo $slide3_name; ?></h3>
          <?php endif; ?>
          <?php if ($slide3_text) : ?>
            <p><?php echo $slide3_text; ?></p>
          <?php endif; ?>
        </div>
      </div>
      <div class="item">
        <img src="<?php echo $slide4_photo; ?>" alt="<?php echo $slide4_name; ?>">
        <div class="caption">
          <?php if ($slide4_name) : ?>
            <h3><?php echo $slide4_name; ?></h3>
          <?php endif; ?>
          <?php if ($slide4_text) : ?>
            <p><?php echo $slide4_text; ?></p>
          <?php endif; ?>
        </div>
      </div>
      <div class="item">
        <img src="<?php echo $slide5_photo; ?>" alt="<?php echo $slide5_name; ?>">
        <div class="caption">
          <?php if ($slide5_name) : ?>
            <h3><?php echo $slide5_name; ?></h3>
          <?php endif; ?>
          <?php if ($slide5_text) : ?>
            <p><?php echo $slide5_text; ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
  <section class="frontier-event-events">
    <?php if ($events_heading) : ?>
      <h2><?php echo $events_heading; ?></h2>
    <?php endif; ?>

    <?php
    /*
     * Let's get events from the frontier category in which their
     * start dates begin in the next 30 calendar days. No pagination.
     */
   ?>
    <?php wp_reset_query(); ?>
    <?php
    // Get current time
    $next30days = strtotime('+30 days');

    // Get posts from 'People' with specified categories
    $args = array(
        'post_type'         => 'event',
        'event-categories'  => 'the-frontier',
        'post_status'       => 'publish',
        'meta_key'          => 'wpcf-event-start-date-and-time',
        'meta_value'        => $next30days,
        'meta_compare'      => '<=',
        'orderby'           => 'meta_value',
        'order'             => 'ASC',
        'posts_per_page'    => -1
    );
    ?>
    <?php query_posts($args); ?>
    <?php get_template_part('loop', 'event'); ?>
    <?php wp_reset_query(); ?>
    <?php echo $events_text; ?>
  </section>
</div>
<?php get_footer(); ?>
