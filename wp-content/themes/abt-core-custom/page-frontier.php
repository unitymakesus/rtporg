<?php
/**
* Template Name: Frontier - Home
*
* @package WordPress
* @subpackage ABT_CORE
* @since ABT Core v0.9.3
*/
get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php
  $theme_dir  = get_stylesheet_directory_uri();

  require_once 'Mobile_Detect.php';
  $detect = new Mobile_Detect;
  
  $video_content = do_shortcode(types_render_field("video-section-content", array("raw"=>"true")));
  $innovate_heading = types_render_field("innovate-section-heading", array("raw"=>"true"));
  $innovate_content = do_shortcode(types_render_field("innovate-section-content", array("raw"=>"true")));
  $events_heading = types_render_field("events-section-heading", array("raw"=>"true"));
  $events_content = do_shortcode(types_render_field("events-section-content", array("raw"=>"true")));
  $about_us_heading = types_render_field("about-us-section-heading", array("raw"=>"true"));
  $about_us_content = do_shortcode(types_render_field("about-us-section-content", array("raw"=>"true")));
?>
<div class="content-container">
  <?php get_template_part('frontier', 'header'); ?>
  <section class="featured-banner theme-arctic frontier-video">
    <div class="overlay">
      <img src="wp-content/themes/abt-core-custom/img/l_rtp-frontier-logo.png" />
      <?php echo $video_content; ?>
    </div>
    <?php if ( !$detect->isMobile() ) : ?>
      <video preload="auto" webkit-playsinline="" autoplay="" loop>
        <source src="<?php echo $theme_dir; ?>/video/frontier-intro.mp4" type="video/mp4" />
        <source src="<?php echo $theme_dir; ?>/video/frontier-intro.webm" type="video/webm" />
        <source src="<?php echo $theme_dir; ?>/video/frontier-intro.ogv" type="video/ogg" />
        <p>To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
      </video>
    <?php endif; ?>
  </section>
  <section class="featured-banner theme-frosty frontier-innovate">
    <div>
      <?php if ($innovate_heading) : ?>
        <h2><?php echo $innovate_heading; ?></h2>
      <?php endif; ?>
      <?php echo $innovate_content; ?>
    </div>
  </section>
  <section class="featured-banner theme-ocean frontier-events">
    <div>
      <?php if ($events_heading) : ?>
        <h2><?php echo $events_heading; ?></h2>
      <?php endif; ?>
      <?php echo $events_content; ?>
    </div>
  </section>
  <section class="featured-banner theme-frosty frontier-about">
    <div>
      <?php if ($about_us_heading) : ?>
        <h2><?php echo $about_us_heading; ?></h2>
      <?php endif; ?>
      <?php echo $about_us_content; ?>
    </div>
  </section>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>