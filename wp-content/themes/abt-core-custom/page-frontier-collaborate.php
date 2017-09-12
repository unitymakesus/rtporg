<?php
/**
* Template Name: Frontier - Collaborate
*
* @package WordPress
* @subpackage ABT_CORE
* @since ABT Core v0.9.3
*/
get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php
  $theme_dir  = get_stylesheet_directory_uri();
  
  $intro_heading = types_render_field("frontier-collaborate-intro-heading", array("raw"=>"true"));
  $intro_text = types_render_field("frontier-collaborate-intro-text", array("raw"=>"true"));
  
  $rooms_heading = types_render_field("frontier-collaborate-rooms-heading", array("raw"=>"true"));
  
  $room1_photo = types_render_field("frontier-collaborate-room1-photo", array("raw"=>"true"));
  $room1_title = types_render_field("frontier-collaborate-room1-title", array("raw"=>"true"));
  $room1_subtitle = types_render_field("frontier-collaborate-room1-subtitle", array("raw"=>"true"));
  $room1_text = types_render_field("frontier-collaborate-room1-text", array("raw"=>"true"));
  $room1_link = types_render_field("frontier-collaborate-room1-link", array("raw"=>"true"));
  
  $room2_photo = types_render_field("frontier-collaborate-room2-photo", array("raw"=>"true"));
  $room2_title = types_render_field("frontier-collaborate-room2-title", array("raw"=>"true"));
  $room2_subtitle = types_render_field("frontier-collaborate-room2-subtitle", array("raw"=>"true"));
  $room2_text = types_render_field("frontier-collaborate-room2-text", array("raw"=>"true"));
  $room2_link = types_render_field("frontier-collaborate-room2-link", array("raw"=>"true"));
  
  $room3_photo = types_render_field("frontier-collaborate-room3-photo", array("raw"=>"true"));
  $room3_title = types_render_field("frontier-collaborate-room3-title", array("raw"=>"true"));
  $room3_subtitle = types_render_field("frontier-collaborate-room3-subtitle", array("raw"=>"true"));
  $room3_text = types_render_field("frontier-collaborate-room3-text", array("raw"=>"true"));
  $room3_link = types_render_field("frontier-collaborate-room3-link", array("raw"=>"true"));
  
  $room4_photo = types_render_field("frontier-collaborate-room4-photo", array("raw"=>"true"));
  $room4_title = types_render_field("frontier-collaborate-room4-title", array("raw"=>"true"));
  $room4_subtitle = types_render_field("frontier-collaborate-room4-subtitle", array("raw"=>"true"));
  $room4_text = types_render_field("frontier-collaborate-room4-text", array("raw"=>"true"));
  $room4_link = types_render_field("frontier-collaborate-room4-link", array("raw"=>"true"));
  
  $room5_photo = types_render_field("frontier-collaborate-room5-photo", array("raw"=>"true"));
  $room5_title = types_render_field("frontier-collaborate-room5-title", array("raw"=>"true"));
  $room5_subtitle = types_render_field("frontier-collaborate-room5-subtitle", array("raw"=>"true"));
  $room5_text = types_render_field("frontier-collaborate-room5-text", array("raw"=>"true"));
  $room5_link = types_render_field("frontier-collaborate-room5-link", array("raw"=>"true"));
?>
<div class="content-container">
  <?php get_template_part('frontier', 'header'); ?>
  <?php get_template_part('featured', 'banners'); ?>
  <section class="featured-banner theme-frosty frontier-collaborate-intro">
    <div>
      <?php if ($intro_heading) : ?>
        <h2><?php echo $intro_heading; ?></h2>
      <?php endif; ?>
      <?php echo $intro_text; ?>
    </div>
  </section>
  <section class="featured-banner frontier-rooms">
    <?php if ($rooms_heading) : ?>
      <h2><?php echo $rooms_heading; ?></h2>
    <?php endif; ?>
    <div>
      <article class="room small">
        <div class="thumbnail"><img src="<?php echo $room1_photo; ?>" /></div>
        <div class="info">
          <h3><?php echo $room1_title; ?> <small><?php echo $room1_subtitle; ?></small></h3>
          <p><?php echo $room1_text; ?></p>
          <ul class="features">
            <li class="tooltip" title="WiFi">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_wifi.svg" />
              <span>WiFi</span>
            </li>
            <li class="tooltip" title="Whiteboard">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_marker.svg" />
              <span>Whiteboard</span>
            </li>
            <li class="tooltip" title="Lounge">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_sofa.svg" />
              <span>Lounge</span>
            </li>
          </ul>
          <a class="button primary" href="<?php echo $room1_link; ?>">Reserve Room</a>
        </div>
      </article>
      <article class="room small">
        <div class="thumbnail"><img src="<?php echo $room2_photo; ?>" /></div>
        <div class="info">
          <h3><?php echo $room2_title; ?> <small><?php echo $room2_subtitle; ?></small></h3>
          <p><?php echo $room2_text; ?></p>
          <ul class="features">
            <li class="tooltip" title="WiFi">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_wifi.svg" />
              <span>WiFi</span>
            </li>
            <li class="tooltip" title="Whiteboard">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_marker.svg" />
              <span>Whiteboard</span>
            </li>
            <li class="tooltip" title="TV">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_tv.svg" />
              <span>TV</span>
            </li>
            <li class="tooltip" title="HDMI hookup">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_hdmi.svg" />
              <span>HDMI hookup</span>
            </li>            
          </ul>
          <a class="button primary" href="<?php echo $room2_link; ?>">Reserve Room</a>
        </div>
      </article>
      <article class="room small">
        <div class="thumbnail"><img src="<?php echo $room3_photo; ?>" /></div>
        <div class="info">
          <h3><?php echo $room3_title; ?> <small><?php echo $room3_subtitle; ?></small></h3>
          <p><?php echo $room3_text; ?></p>
          <ul class="features">
            <li class="tooltip" title="WiFi">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_wifi.svg" />
              <span>WiFi</span>
            </li>
            <li class="tooltip" title="Whiteboard">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_marker.svg" />
              <span>Whiteboard</span>
            </li>
            <li class="tooltip" title="TV">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_tv.svg" />
              <span>TV</span>
            </li>
            <li class="tooltip" title="HDMI hookup">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_hdmi.svg" />
              <span>HDMI hookup</span>
            </li>
          </ul>
          <a class="button primary" href="<?php echo $room3_link; ?>">Reserve Room</a>
        </div>
      </article>
      <article class="room medium">
        <div class="thumbnail"><img src="<?php echo $room4_photo; ?>" /></div>
        <div class="info">
          <h3><?php echo $room4_title; ?> <small><?php echo $room4_subtitle; ?></small></h3>
          <p><?php echo $room4_text; ?></p>
          <ul class="features">
            <li class="tooltip" title="WiFi">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_wifi.svg" />
              <span>WiFi</span>
            </li>
            <li class="tooltip" title="Whiteboard">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_marker.svg" />
              <span>Whiteboard</span>
            </li>
            <li class="tooltip" title="Formal meeting room">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_formal.svg" />
              <span>Formal meeting room</span>
            </li>
            <li class="tooltip" title="Teleconference">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_phone.svg" />
              <span>Teleconference</span>
            </li>
          </ul>
          <a class="button primary" href="<?php echo $room4_link; ?>">Reserve Room</a>
        </div>
      </article>
      <article class="room large">
        <div class="thumbnail"><img src="<?php echo $room5_photo; ?>" /></div>
        <div class="info">
          <h3><?php echo $room5_title; ?> <small><?php echo $room5_subtitle; ?></small></h3>
          <p><?php echo $room5_text; ?></p>
          <ul class="features">
            <li class="tooltip" title="WiFi">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_wifi.svg" />
              <span>WiFi</span>
            </li>
            <li class="tooltip" title="Whiteboard">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_marker.svg" />
              <span>Whiteboard</span>
            </li>
            <li class="tooltip" title="TV">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_tv.svg" />
              <span>TV</span>
            </li>
            <li class="tooltip" title="HDMI hookup">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_hdmi.svg" />
              <span>HDMI hookup</span>
            </li>
            <li class="tooltip" title="Configurable layouts">
              <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_layouts.svg" />
              <span>Configurable layouts</span>
            </li>         
          </ul>
          <a class="button primary" href="<?php echo $room5_link; ?>">Reserve Room</a>
        </div>
      </article>
    </div>
  </section>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>