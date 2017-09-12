<?php
/**
* Template Name: Frontier - Companies
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
  
  <section class="featured-banner frontier-about-team">
    <?php if ($team_heading) : ?>
      <h2><?php echo $team_heading; ?></h2>   
    <?php endif; ?>
    <?php
      $parent_id = 3019;

      $args = array(
        'post_type' => 'location',
        'order' => 'ASC',
        'orderby' => 'title',
        'posts_per_page' => -1,
        'post_parent' => $parent_id
      );
      $posts = get_posts($args);
    ?>
    <ul class="company-list">
    <?php foreach($posts as $post) : setup_postdata($post); ?>
      <?php
        // Company Fields
        $thumb = types_render_field("location-company-logo", array("raw"=>"true"));
      ?>
      <li class="vcard has-profile">
        <a href="<?php the_permalink(); ?>">
          <?php if ( $thumb ): ?>
            <div class="photo" style="background-image: url(<?php echo $thumb; ?>);"></div>
          <?php else : ?>
            <div class="photo placeholder"></div>
          <?php endif; ?>
            <h3 class="fn"><span><?php the_title(); ?></span></h3>
                 
          <img class="svg more" src="<?php echo $theme_dir; ?>/img/icons/i_search-submit.svg" />
        </a>
      </li>
    <?php endforeach; wp_reset_postdata(); ?>
    </ul>
  </section>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>