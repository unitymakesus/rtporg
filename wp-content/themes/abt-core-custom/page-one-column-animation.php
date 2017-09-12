<?php
/**
 * Template Name: One Column (no sidebar) - With Animation
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 *
 */

get_header(); ?>

<?php
  $theme_dir = get_stylesheet_directory_uri();

  $page_theme = types_render_field("page-theme", array("raw"=>"true"));
  $page_background = types_render_field("page-background", array("raw"=>"true"));
  $page_animation = types_render_field("page-animation", array("raw"=>"true"));

?>
  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div class="content-container">
      <section class="featured-banner section-generosity <?php echo $page_theme; ?>" style="background-image: url(<?php echo $page_background; ?>);">
        <div class="flex-container">
          <div class="flex-content text-center">
            <h1><?php the_title(); ?></h1>
            <hr />

            <?php
              if($page_animation != "no-animation") {
                include (STYLESHEETPATH . '/'. $page_animation .'.php');
              }
            ?>
          </div>
        </div>
      </section>
      <div class="breadcrumbs">
          <?php if(function_exists('bcn_display')) {
            bcn_display();
          } ?>
      </div>
      <div class="content">
        <?php the_content(); ?>
      </div>
    </div>
  <?php endwhile; ?>

  <script>
  $(document).ready(function() {
    $('.featured-banner .flex-content').css("opacity", 0);
      setInterval(function () {
        $('.featured-banner .flex-content').css("opacity", 1);
          $('.featured-banner').addClass('animate-section')
      }, 600);
    });
  </script>

<?php get_footer(); ?>