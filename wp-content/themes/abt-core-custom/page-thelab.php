<?php
/**
* Template Name: TheLab - Home
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
?>
<div class="content-container">
  <?php get_template_part('thelab', 'header'); ?>
  <section class="featured-banner theme-creamsicle thelab-featured">
    <div class="overlay">
      <img src="<?php echo $theme_dir; ?>/img/l_rtp-thelab-logo.png" />
      <?php echo $video_content; ?>
    </div>
    
  </section>
  <section class="featured-banner theme-frosty thelab-companies">
    <div>
      <?php if ($innovate_heading) : ?>
        <h2><?php echo $innovate_heading; ?></h2>
      <?php endif; ?>
      <?php echo $innovate_content; ?>
    </div>
  </section>
  <section class="featured-banner theme-forest thelab-banner-right thelab-space">
    <div>
      <?php if ($events_heading) : ?>
        <h2><?php echo $events_heading; ?></h2>
      <?php endif; ?>
      <?php echo $events_content; ?>
    </div>
  </section>
  
</div>
<?php endwhile; ?>
<?php get_footer(); ?>