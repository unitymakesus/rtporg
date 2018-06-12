<?php
/**
* Template Name: Frontier - Home NEW
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

  <div class="content-container" id="frontier-homepage">
    <?php get_template_part('frontier', 'header'); ?>
    <section class="featured-banner theme-arctic frontier-video">
      <div class="overlay">
        <img src="wp-content/themes/abt-core-custom/img/l_rtp-frontier-logo.png" />
        <?php
        $header = get_field('header');
        if( $header ): ?>
        	<?php echo $header['header_content']; ?>
        	<a class="button ghost" href="<?php echo $header['button_link']['url']; ?>"><?php echo $header['button_text']; ?></a>
        <?php endif; ?>
      </div>
    </section>

    <div class="page-content"><?php the_field('page_content'); ?></div>

    <section class="content-grid">
      <?php if( have_rows('content_grid') ): ?>
        <?php while( have_rows('content_grid') ): the_row(); ?>
          <section class="content">
            <img src="<?php the_sub_field('icon'); ?>"/>
            <div>
              <h3><?php the_sub_field('title'); ?></h3>
              <?php the_sub_field('text'); ?>
              <a href="<?php the_sub_field('link'); ?>">Learn More</a>
            </div>
          </section>
        <?php endwhile; ?>
      <?php endif; ?>
    </section>
  </div>

<?php endwhile; ?>
<?php get_footer(); ?>
