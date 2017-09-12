<?php
/**
* Template Name: TheLab - Space
*
* @package WordPress
* @subpackage ABT_CORE
* @since ABT Core v0.9.3
*/
get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php
  $theme_dir  = get_stylesheet_directory_uri();
  $intro_heading = types_render_field("thelab-space-intro-heading", array("raw"=>"true"));
  $intro_text = types_render_field("thelab-space-intro-text", array("raw"=>"true"));
  $tiers_heading = types_render_field("thelab-space-tiers-heading", array("raw"=>"true"));
  $featured_tier_text = types_render_field("thelab-space-featured-tier-text", array("raw"=>"true"));

  $tier1_name = types_render_field("thelab-space-tier1-name", array("raw"=>"true"));
  $tier1_price = types_render_field("thelab-space-tier1-price", array("raw"=>"true"));
  $tier1_feature = types_render_field("thelab-space-tier1-feature", array("raw"=>"true"));
  $tier1_features = '<ul><li>' . do_shortcode('[types field="thelab-space-tier1-feature" separator="</li><li>"][/types]') . '</li></ul>';
  $tier1_action = do_shortcode(types_render_field("thelab-space-tier1-action", array("raw"=>"true")));

  $tier2_name = types_render_field("thelab-space-tier2-name", array("raw"=>"true"));
  $tier2_price = types_render_field("thelab-space-tier2-price", array("raw"=>"true"));
  $tier2_feature = types_render_field("thelab-space-tier2-feature", array("raw"=>"true"));
  $tier2_features = '<ul><li>' . do_shortcode('[types field="thelab-space-tier2-feature" separator="</li><li>"][/types]') . '</li></ul>';
  $tier2_action = do_shortcode(types_render_field("thelab-space-tier2-action", array("raw"=>"true")));

  $band_one_title = types_render_field("band-one-title", array("raw"=>"true"));
  $band_one_text = types_render_field("band-one-text", array("html"=>"true"));

  $band_two_title = types_render_field("band-two-title", array("raw"=>"true"));
  $band_two_text = types_render_field("band-two-text", array("html"=>"true"));

  $band_three_title = types_render_field("band-three-title", array("raw"=>"true"));
  $band_three_text = types_render_field("band-three-text", array("html"=>"true"));
?>
<div class="content-container">
  <?php get_template_part('thelab', 'header'); ?>
  <?php get_template_part('featured', 'banners'); ?>
  <section class="featured-banner theme-frosty thelab-space-intro">
    <div>
      <?php if ($intro_heading) : ?>
        <h2><?php echo $intro_heading; ?></h2>
      <?php endif; ?>
      <?php echo $intro_text; ?>
    </div>
  </section>
  <section class="featured-banner thelab-space-pricing">
    <?php if ($tiers_heading) : ?>
      <h2><?php echo $tiers_heading; ?></h2>
    <?php endif; ?>
    <?php if ($featured_tier_text) : ?>
      <p><?php echo $featured_tier_text; ?></p>
    <?php endif; ?>
    <div>
      <div class="tier">
        <div class="summary">
          <?php if ($tier1_name) : ?>
            <img class="svg" src="<?php echo $theme_dir;?>/img/l_computer.svg"/>
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
        
        <div class="summary">
          <img class="svg" src="<?php echo $theme_dir;?>/img/i_lab.svg"/>
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
      
    </div>
  </section>
  <section class="featured-banner theme-forest thelab-banner-left thelab-space-band1 ">
    <div>
        <?php if ($band_one_title) : ?>
            <h2><?php echo $band_one_title; ?></h2>
          <?php endif; ?>
          <?php if ($band_one_text) : ?>
            <?php echo $band_one_text; ?>
          <?php endif; ?>  
    </div>
  </section>
  <section class="featured-banner theme-frosty thelab-banner-right thelab-space-band2">
    <div>
       <?php if ($band_two_title) : ?>
          <h2><?php echo $band_two_title; ?></h2>
        <?php endif; ?>
        <?php if ($band_two_text) : ?>
          <?php echo $band_two_text; ?>
        <?php endif; ?>
      </div>
  </section>
  <section class="featured-banner theme-creamsicle thelab-banner-left thelab-space-band3">
    <div>
      <?php if ($band_three_title) : ?>
        <h2><?php echo $band_three_title; ?></h2>
      <?php endif; ?>
      <?php if ($band_three_text) : ?>
        <?php echo $band_three_text; ?>
      <?php endif; ?>
    </div>
  </section>

</div>
<?php endwhile; ?>
<?php get_footer(); ?>