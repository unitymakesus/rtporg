<?php
/**
* Template Name: Frontier - Companies - NEW
*
* @package WordPress
* @subpackage ABT_CORE
* @since ABT Core v0.9.3
*/
get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php
  $theme_dir  = get_stylesheet_directory_uri();

  $intro_heading = types_render_field("frontier-about-intro-heading", array("raw"=>"true"));
  $intro_content = do_shortcode(types_render_field("frontier-about-intro-content", array("raw"=>"true")));

  $maps_heading = types_render_field("frontier-about-map-heading", array("raw"=>"true"));
  $maps_content = do_shortcode(types_render_field("frontier-about-map-content", array("raw"=>"true")));

  $links_heading = types_render_field("frontier-about-links-heading", array("raw"=>"true"));
  $links_content = do_shortcode(types_render_field("frontier-about-links-content", array("raw"=>"true")));

  $team_heading = types_render_field("frontier-about-team-heading", array("raw"=>"true"));
?>
<div class="content-container">
  <?php get_template_part('frontier', 'header'); ?>
  <?php get_template_part('featured', 'banners'); ?>


  <?php if( have_rows('new_building') ): ?>
  <section class="featured-banner frontier-innovate-pricing">
    <?php while( have_rows('new_building') ): the_row();?>
      <div class="tier">
        <div class="summary" style="background-size: cover; background-position: center; background:url('<?php echo get_sub_field('image'); ?>')">
          <div class="price"><?php echo get_sub_field('name'); ?></div>
        </div>
        <div class="info">
          <?php echo get_sub_field('features'); ?>
        </div>
        <div class="action">
          <a class="button primary " href="<?php echo get_sub_field('link'); ?>">View Companies</a>
        </div>
      </div>
    <?php endwhile; ?>
  </section>
  <?php endif ?>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>
