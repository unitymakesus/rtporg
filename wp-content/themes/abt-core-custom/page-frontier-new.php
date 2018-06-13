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

    <div class="frontier-map">
      <img src="wp-content/themes/abt-core-custom/img/frontiermap.svg"/ >

      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 976.83 648">
        <a xlink:href="https://www.google.co.uk/">
          <polygon class="a" points="76.53 222.46 159.79 181.8 161.22 184.76 177.21 176.77 179.05 179.76 195.41 171.34 199.3 177.81 218.65 168.63 239.56 209.68 296.88 181.41 320.5 225.95 303.85 234.08 304.62 236.79 289.52 244.53 290.29 247.63 240.72 272.63 239.17 269.32 222.52 277.84 220.97 275.13 204.71 283.65 178.76 234.47 135.43 256.71 133.07 252.67 116.47 261.35 114.87 258.48 97.83 267 76.53 222.46"/><text class="b" transform="translate(208.92 228.2)">BUILDING<tspan class="f"><tspan x="-0.13" y="18.51">7</tspan><tspan class="g" x="11.96" y="18.51">0</tspan><tspan class="h" x="27.14" y="18.51">0</tspan></tspan></text>
        </a>
        <a xlink:href="https://www.google.co.uk/">
          <polygon class="a" points="326.72 163.28 409.98 122.62 411.41 125.58 427.4 117.58 429.24 120.58 445.61 112.16 449.49 118.63 467.16 156.11 469.44 155.25 486.91 190 529.7 168.31 531.49 170.94 547.82 162.68 549.96 165.88 566.15 157.64 587.4 201.23 505.5 242.86 503.75 239.76 487.68 247.89 486.33 245.18 469.99 253.06 428.95 175.28 385.62 197.53 383.26 193.48 366.66 202.16 365.06 199.29 348.57 207.54 326.72 163.28"/><text class="b" transform="translate(472.54 205.13)">BUILDING<tspan class="i"><tspan x="-1.22" y="18.51">6</tspan><tspan class="j" x="13.05" y="18.51">0</tspan><tspan x="28.23" y="18.51">0</tspan></tspan></text>
        </a>
        <a xlink:href="https://www.google.co.uk/">
          <polygon class="a" points="643.25 308.28 633.76 312.73 623.5 319.7 541.01 360.94 541.01 383.23 536.37 384.95 564.64 439.94 577.42 434.13 578.97 437.62 595.38 429.49 597.17 432.2 612.92 425.39 615.61 427.64 672.68 402.84 672.68 380.44 678.78 377.78 643.25 308.28"/><text class="b" transform="translate(588.32 377.4)">BUILDING<tspan class="c"><tspan x="-1" y="18.51">8</tspan><tspan class="d" x="12.83" y="18.51">0</tspan><tspan class="e" x="28.01" y="18.51">0</tspan></tspan></text>
        </a>
        <a xlink:href="https://www.google.co.uk/">
          <polygon class="a" points="915.31 466.92 915.31 535.64 841.57 535.64 841.57 518.18 826.71 518.18 826.71 502.21 811.3 502.21 811.3 466.92 856.43 466.92 856.43 476.58 863.3 476.58 863.3 485.12 886.89 485.12 886.89 466.92 915.31 466.92"/><text class="b" transform="translate(856.76 501.28)">BUILDING<tspan class="i"><tspan x="-1.39" y="18.51">4</tspan><tspan class="j" x="13.22" y="18.51">0</tspan><tspan class="k" x="28.4" y="18.51">0</tspan></tspan></text>
        </a>
      </svg>

      <section>
        <p>Available office space up to 121,000 SF.</p>
        <p>Startup and emerging company office space.</p>
        <p>Free coworking andmeeting spaces.<br>Affordable startup offices and event spaces.</p>
        <p>Flexible, full-service startup lab and office space.</p>
      </section>
    </div>

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
