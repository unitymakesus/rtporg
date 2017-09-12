<?php
/**
* Template Name: Frontier - Innovate
*
* @package WordPress
* @subpackage ABT_CORE
* @since ABT Core v0.9.3
*/
get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php
  $theme_dir  = get_stylesheet_directory_uri();
  $intro_heading = types_render_field("frontier-innovate-intro-heading", array("raw"=>"true"));
  $intro_text = types_render_field("frontier-innovate-intro-text", array("raw"=>"true"));
  $tiers_heading = types_render_field("frontier-innovate-tiers-heading", array("raw"=>"true"));
  $featured_tier_text = types_render_field("frontier-innovate-featured-tier-text", array("raw"=>"true"));

  $tier1_name = types_render_field("frontier-innovate-tier1-name", array("raw"=>"true"));
  $tier1_price = types_render_field("frontier-innovate-tier1-price", array("raw"=>"true"));
  $tier1_feature = types_render_field("frontier-innovate-tier1-feature", array("raw"=>"true"));
  $tier1_features = '<ul><li>' . do_shortcode('[types field="frontier-innovate-tier1-feature" separator="</li><li>"][/types]') . '</li></ul>';
  $tier1_action = do_shortcode(types_render_field("frontier-innovate-tier1-action", array("raw"=>"true")));

  $tier2_name = types_render_field("frontier-innovate-tier2-name", array("raw"=>"true"));
  $tier2_price = types_render_field("frontier-innovate-tier2-price", array("raw"=>"true"));
  $tier2_feature = types_render_field("frontier-innovate-tier2-feature", array("raw"=>"true"));
  $tier2_features = '<ul><li>' . do_shortcode('[types field="frontier-innovate-tier2-feature" separator="</li><li>"][/types]') . '</li></ul>';
  $tier2_action = do_shortcode(types_render_field("frontier-innovate-tier2-action", array("raw"=>"true")));

  $tier3_name = types_render_field("frontier-innovate-tier3-name", array("raw"=>"true"));
  $tier3_price = types_render_field("frontier-innovate-tier3-price", array("raw"=>"true"));
  $tier3_feature = types_render_field("frontier-innovate-tier3-feature", array("raw"=>"true"));
  $tier3_features = '<ul><li>' . do_shortcode('[types field="frontier-innovate-tier3-feature" separator="</li><li>"][/types]') . '</li></ul>';
  $tier3_action = do_shortcode(types_render_field("frontier-innovate-tier3-action", array("raw"=>"true")));

  $room1_name = types_render_field("frontier-innovate-room1-name", array("raw"=>"true"));
  $room1_text = types_render_field("frontier-innovate-room1-text", array("raw"=>"true"));
  $room1_photo = types_render_field("frontier-innovate-room1-photo", array("raw"=>"true"));

  $room2_name = types_render_field("frontier-innovate-room2-name", array("raw"=>"true"));
  $room2_text = types_render_field("frontier-innovate-room2-text", array("raw"=>"true"));
  $room2_photo = types_render_field("frontier-innovate-room2-photo", array("raw"=>"true"));

  $room3_name = types_render_field("frontier-innovate-room3-name", array("raw"=>"true"));
  $room3_text = types_render_field("frontier-innovate-room3-text", array("raw"=>"true"));
  $room3_photo = types_render_field("frontier-innovate-room3-photo", array("raw"=>"true"));

  $room4_name = types_render_field("frontier-innovate-room4-name", array("raw"=>"true"));
  $room4_text = types_render_field("frontier-innovate-room4-text", array("raw"=>"true"));
  $room4_photo = types_render_field("frontier-innovate-room4-photo", array("raw"=>"true"));

  $room5_name = types_render_field("frontier-innovate-room5-name", array("raw"=>"true"));
  $room5_text = types_render_field("frontier-innovate-room5-text", array("raw"=>"true"));
  $room5_photo = types_render_field("frontier-innovate-room5-photo", array("raw"=>"true"));

  $room6_name = types_render_field("frontier-innovate-room6-name", array("raw"=>"true"));
  $room6_text = types_render_field("frontier-innovate-room6-text", array("raw"=>"true"));
  $room6_photo = types_render_field("frontier-innovate-room6-photo", array("raw"=>"true"));
?>
<div class="content-container">
  <?php get_template_part('frontier', 'header'); ?>
  <?php get_template_part('featured', 'banners'); ?>
  <section class="featured-banner theme-frosty frontier-innovate-intro">
    <div>
      <?php if ($intro_heading) : ?>
        <h2><?php echo $intro_heading; ?></h2>
      <?php endif; ?>
      <?php echo $intro_text; ?>
    </div>
  </section>
  <section class="featured-banner frontier-innovate-pricing">
    <?php if ($tiers_heading) : ?>
      <h2><?php echo $tiers_heading; ?></h2>
    <?php endif; ?>
    <div>
      <div class="tier">
        <div class="summary">
          <?php if ($tier1_name) : ?>
            <h2><?php echo $tier1_name; ?></h2>
          <?php endif; ?>      
          <?php if ($tier1_price) : ?>
            <div class="price"><?php echo $tier1_price; ?></div>
          <?php endif; ?>
        </div>
        <div class="info">
          <?php echo $tier1_features; ?>
        </div>
        <div class="action">
          <?php echo $tier1_action; ?>
        </div>
      </div>
      <div class="tier">
        <?php if ($featured_tier_text) : ?>
          <div class="most-popular"><?php echo $featured_tier_text; ?></div>
        <?php endif; ?>
        <div class="summary">
          <?php if ($tier2_name) : ?>
            <h2><?php echo $tier2_name; ?></h2>
          <?php endif; ?>      
          <?php if ($tier2_price) : ?>
            <div class="price"><?php echo $tier2_price; ?></div>
          <?php endif; ?>
        </div>
        <div class="info">
          <?php echo $tier2_features; ?>
        </div>
        <div class="action">
          <?php echo $tier2_action; ?>
        </div>
      </div>
      <div class="tier">
        <div class="summary">
          <?php if ($tier3_name) : ?>
            <h2><?php echo $tier3_name; ?></h2>
          <?php endif; ?>      
          <?php if ($tier3_price) : ?>
            <div class="price"><?php echo $tier3_price; ?></div>
          <?php endif; ?>
        </div>
        <div class="info">
          <?php echo $tier3_features; ?>
        </div>
        <div class="action">
          <?php echo $tier3_action; ?>
        </div>
      </div>
    </div>
  </section>
  <section class="frontier-innovate-gallery">
    <div id="frontier-innovate-gallery" class="owl-carousel owl-theme">
      <div class="item">
        <img src="<?php echo $room1_photo; ?>" alt="<?php echo $room1_name; ?>">
        <div class="caption">
          <?php if ($room1_name) : ?>
            <h3><?php echo $room1_name; ?></h3>
          <?php endif; ?>
          <?php if ($room1_text) : ?>
            <p><?php echo $room1_text; ?></p>
          <?php endif; ?>
        </div>
      </div>
      <div class="item">
        <img src="<?php echo $room2_photo; ?>" alt="<?php echo $room2_name; ?>">
        <div class="caption">
          <?php if ($room2_name) : ?>
            <h3><?php echo $room2_name; ?></h3>
          <?php endif; ?>
          <?php if ($room2_text) : ?>
            <p><?php echo $room2_text; ?></p>
          <?php endif; ?>
        </div>
      </div>
      <div class="item">
        <img src="<?php echo $room3_photo; ?>" alt="<?php echo $room3_name; ?>">
        <div class="caption">
          <?php if ($room3_name) : ?>
            <h3><?php echo $room3_name; ?></h3>
          <?php endif; ?>
          <?php if ($room3_text) : ?>
            <p><?php echo $room3_text; ?></p>
          <?php endif; ?>
        </div>
      </div>
      <div class="item">
        <img src="<?php echo $room4_photo; ?>" alt="<?php echo $room4_name; ?>">
        <div class="caption">
          <?php if ($room4_name) : ?>
            <h3><?php echo $room4_name; ?></h3>
          <?php endif; ?>
          <?php if ($room4_text) : ?>
            <p><?php echo $room4_text; ?></p>
          <?php endif; ?>
        </div>
      </div>
      <div class="item">
        <img src="<?php echo $room5_photo; ?>" alt="<?php echo $room5_name; ?>">
        <div class="caption">
          <?php if ($room5_name) : ?>
            <h3><?php echo $room5_name; ?></h3>
          <?php endif; ?>
          <?php if ($room5_text) : ?>
            <p><?php echo $room5_text; ?></p>
          <?php endif; ?>
        </div>
      </div>
      <div class="item">
        <img src="<?php echo $room6_photo; ?>" alt="<?php echo $room6_name; ?>">
        <div class="caption">
          <?php if ($room6_name) : ?>
            <h3><?php echo $room6_name; ?></h3>
          <?php endif; ?>
          <?php if ($room6_text) : ?>
            <p><?php echo $room6_text; ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>  
</div>
<?php endwhile; ?>
<?php get_footer(); ?>