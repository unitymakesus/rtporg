<?php
/**
* Template Name: TheLab - About
*
* @package WordPress
* @subpackage ABT_CORE
* @since ABT Core v0.9.3
*/
get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php
  $theme_dir  = get_stylesheet_directory_uri();

  $intro_heading = types_render_field("thelab-about-intro-heading", array("raw"=>"true"));
  $intro_content = do_shortcode(types_render_field("thelab-about-intro-content", array("raw"=>"true")));
  
  $maps_heading = types_render_field("thelab-about-map-heading", array("raw"=>"true"));
  $maps_content = do_shortcode(types_render_field("thelab-about-map-content", array("raw"=>"true")));
  
  $links_heading = types_render_field("thelab-links-heading", array("raw"=>"true"));
  $links_content = do_shortcode(types_render_field("thelab-links-content", array("raw"=>"true")));

?>
<div class="content-container">
  <?php get_template_part('thelab', 'header'); ?>
  <?php get_template_part('featured', 'banners'); ?>
  
  <section class="featured-banner no-theme thelab-about-map">
    <div>
      <?php if ($maps_heading) : ?>
        <h2><?php echo $maps_heading; ?></h2>   
      <?php endif; ?>
      <?php echo $maps_content; ?>
    </div>
  </section>
  <section class="featured-banner theme-frosty thelab-about-links">
    <div>
      <?php if ($links_heading) : ?>
        <h2><?php echo $links_heading; ?></h2>   
      <?php endif; ?>
      <?php echo $links_content; ?>
    </div>
  </section>
  
</div>
<?php endwhile; ?>
<?php get_footer(); ?>