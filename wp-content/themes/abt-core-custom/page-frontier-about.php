<?php
/**
* Template Name: Frontier - About
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
  // $tile1_label = types_render_field("frontier-about-tile1-label", array("raw"=>"true"));
  // $tile1_link = types_render_field("frontier-about-tile1-link", array("raw"=>"true"));
  // $tile2_label = types_render_field("frontier-about-tile2-label", array("raw"=>"true"));
  // $tile2_link = types_render_field("frontier-about-tile2-link", array("raw"=>"true"));
  // $tile3_label = types_render_field("frontier-about-tile3-label", array("raw"=>"true"));
  // $tile3_link = types_render_field("frontier-about-tile3-link", array("raw"=>"true"));
  
  $maps_heading = types_render_field("frontier-about-map-heading", array("raw"=>"true"));
  $maps_content = do_shortcode(types_render_field("frontier-about-map-content", array("raw"=>"true")));
  
  $links_heading = types_render_field("frontier-about-links-heading", array("raw"=>"true"));
  $links_content = do_shortcode(types_render_field("frontier-about-links-content", array("raw"=>"true")));

  $team_heading = types_render_field("frontier-about-team-heading", array("raw"=>"true"));
  $team_members = types_render_field("frontier-about-team-members", array("raw"=>"true"));
?>
<div class="content-container">
  <?php get_template_part('frontier', 'header'); ?>
  <?php get_template_part('featured', 'banners'); ?>
  <section class="featured-banner theme-frosty frontier-about-intro">
    <div>
      <?php if ($intro_heading) : ?>
        <h2><?php echo $intro_heading; ?></h2>   
      <?php endif; ?>
      <?php echo $intro_content; ?>
    </div>
  </section>
  <section class="featured-banner no-theme frontier-about-map">
    <div>
      <?php if ($maps_heading) : ?>
        <h2><?php echo $maps_heading; ?></h2>   
      <?php endif; ?>
      <?php echo $maps_content; ?>
    </div>
  </section>
  <section class="featured-banner theme-frosty frontier-about-links">
    <div>
      <?php if ($links_heading) : ?>
        <h2><?php echo $links_heading; ?></h2>   
      <?php endif; ?>
      <?php echo $links_content; ?>
    </div>
  </section>
  <section class="featured-banner frontier-about-team">
    <?php if ($team_heading) : ?>
      <h2><?php echo $team_heading; ?></h2>   
    <?php endif; ?>
    <?php
      $args = array(
        'post_type' => 'people',
        'order' => 'ASC',
        'orderby' => 'title',
        'post__in' => explode(',', $team_members)
      );
      $posts = get_posts($args);
    ?>
    <ul class="people">
    <?php foreach($posts as $post) : setup_postdata($post); ?>
      <?php
        // Person Fields
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'people-thumb' );
        $thumb_url = $thumb['0'];
        $job_title = types_render_field("person-job-title", array("raw"=>"true"));
        $company = types_render_field("person-company", array("raw"=>"true"));
      ?>
      <li class="vcard has-profile">
        <a href="<?php the_permalink(); ?>">
          <?php if ( has_post_thumbnail( $post->ID ) ): ?>
            <div class="photo" style="background-image: url(<?php echo $thumb_url; ?>);"></div>
          <?php else : ?>
            <div class="photo placeholder" style="background-image: url(<?php echo $theme_dir; ?>/img/bg_no-profile.png);"></div>
          <?php endif; ?>
            <h3 class="fn"><?php the_title(); ?></h3>
          <?php if($job_title) : ?>
            <p class="role"><?php echo $job_title; ?></p>
          <?php endif; ?>
          <?php if($company) : ?>
            <p class="org"><?php echo $company; ?></p>
          <?php endif; ?>          
          <img class="svg more" src="<?php echo $theme_dir; ?>/img/icons/i_search-submit.svg" />
        </a>
      </li>
    <?php endforeach; wp_reset_postdata(); ?>
    </ul>
  </section>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>