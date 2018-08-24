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
        <img src="<?php bloginfo('stylesheet_directory'); ?>/img/frontier-logo-new.png" />
        <?php
        $header = get_field('header');
        if( $header ): ?>
        	<?php echo $header['header_content']; ?>
        <?php endif; ?>
      </div>
    </section>

    <div class="page-content"><?php the_field('map_content'); ?></div>

    <div class="frontier-map">
      <img src="<?php bloginfo('stylesheet_directory'); ?>/img/FrontierMapParking.svg"/ >

      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 976.83 498.66">
        <a target="_blank" xlink:href="<?php bloginfo('stylesheet_directory'); ?>/img/frontier-pdf/700-Park-Office-Building.pdf">
          <polygon class="a" points="76.53 145.82 159.79 105.16 161.22 108.13 177.21 100.13 179.05 103.12 195.41 94.71 199.3 101.18 218.65 92 239.56 133.04 296.88 104.77 320.5 149.31 303.85 157.44 304.62 160.15 289.52 167.9 290.29 170.99 240.72 195.99 239.17 192.68 222.52 201.2 220.97 198.49 204.71 207.01 178.76 157.83 135.43 180.07 133.07 176.03 116.47 184.71 114.87 181.84 97.83 190.36 76.53 145.82"/><path class="b" d="M211.85,145.39a1.66,1.66,0,0,1,1.88,1.66,1.39,1.39,0,0,1-.9,1.33,1.45,1.45,0,0,1,1.09,1.46,1.73,1.73,0,0,1-1.91,1.72h-2.39v-6.17Zm-.19,2.55c.55,0,.88-.3.88-.77s-.3-.77-.89-.77h-.84v1.54Zm.13,2.62c.58,0,.93-.3.93-.8a.81.81,0,0,0-.92-.83h-1v1.63Z"/><path class="b" d="M214.88,149.38v-4h1.2v3.9a1.17,1.17,0,1,0,2.34,0v-3.9h1.2v4a2.37,2.37,0,0,1-4.74,0Z"/><path class="b" d="M221,151.56v-6.17h1.22v6.17Z"/><path class="b" d="M223.6,151.56v-6.17h1.2v5h2.76v1.14Z"/><path class="b" d="M228.48,151.56v-6.17h2.21a3.09,3.09,0,0,1,0,6.17Zm2.16-1.11a2,2,0,0,0,0-3.95h-1v3.95Z"/><path class="b" d="M234.78,151.56v-6.17H236v6.17Z"/><path class="b" d="M241.42,151.56l-2.8-4.38v4.38h-1.21v-6.17h1.5l2.57,4.08v-4.08h1.21v6.17Z"/><path class="b" d="M248.71,151.56l-.08-.7a2.1,2.1,0,0,1-1.82.84,3,3,0,0,1-3.08-3.22,3.11,3.11,0,0,1,3.16-3.22,2.78,2.78,0,0,1,2.82,1.9l-1.15.41a1.64,1.64,0,0,0-1.67-1.19,2.12,2.12,0,0,0,0,4.22,1.54,1.54,0,0,0,1.65-1.2h-2v-1.05h3.09v3.21Z"/><path class="b" d="M220.17,157.87a17.75,17.75,0,0,0-5.95,12.2H211A18.24,18.24,0,0,1,216.53,158H208.9v-2.72h11.27Z"/><path class="b" d="M223.12,157.39a5.59,5.59,0,0,1,4.89-2.5,5.53,5.53,0,0,1,4.87,2.5,11.22,11.22,0,0,1,0,10.56,5.54,5.54,0,0,1-4.87,2.49,5.6,5.6,0,0,1-4.89-2.49,11.3,11.3,0,0,1,0-10.56Zm2.65,9.05a2.49,2.49,0,0,0,2.24,1.21,2.42,2.42,0,0,0,2.22-1.21,9.1,9.1,0,0,0,0-7.55,2.42,2.42,0,0,0-2.22-1.21,2.49,2.49,0,0,0-2.24,1.21,9.31,9.31,0,0,0,0,7.55Z"/><path class="b" d="M238.3,157.39a5.59,5.59,0,0,1,4.89-2.5,5.53,5.53,0,0,1,4.87,2.5,11.22,11.22,0,0,1,0,10.56,5.54,5.54,0,0,1-4.87,2.49A5.6,5.6,0,0,1,238.3,168a11.37,11.37,0,0,1,0-10.56Zm2.65,9.05a2.49,2.49,0,0,0,2.24,1.21,2.42,2.42,0,0,0,2.22-1.21,9.1,9.1,0,0,0,0-7.55,2.42,2.42,0,0,0-2.22-1.21,2.49,2.49,0,0,0-2.24,1.21,9.31,9.31,0,0,0,0,7.55Z"/>
        </a>

        <a target="_blank" xlink:href="<?php bloginfo('stylesheet_directory'); ?>/img/frontier-pdf/600-Park-Office-Building.pdf">
          <polygon class="a" points="326.72 86.64 409.98 45.98 411.41 48.94 427.4 40.94 429.24 43.94 445.61 35.52 449.49 41.99 467.16 79.47 469.44 78.61 486.91 113.36 529.7 91.67 531.49 94.3 547.82 86.04 549.96 89.24 566.15 81 587.4 124.59 505.5 166.22 503.75 163.12 487.68 171.25 486.33 168.54 469.99 176.42 428.95 98.64 385.62 120.89 383.26 116.84 366.66 125.52 365.06 122.65 348.57 130.9 326.72 86.64"/><path class="b" d="M475.47,122.32a1.66,1.66,0,0,1,1.88,1.66,1.38,1.38,0,0,1-.9,1.33,1.46,1.46,0,0,1,1.09,1.46,1.74,1.74,0,0,1-1.91,1.73h-2.38v-6.18Zm-.19,2.55c.55,0,.89-.3.89-.77s-.31-.77-.89-.77h-.85v1.54Zm.13,2.62c.58,0,.93-.3.93-.8a.8.8,0,0,0-.92-.83h-1v1.63Z"/><path class="b" d="M478.5,126.31v-4h1.2v3.9a1.17,1.17,0,1,0,2.34,0v-3.9h1.21v4a2.38,2.38,0,0,1-4.75,0Z"/><path class="b" d="M484.59,128.5v-6.18h1.22v6.18Z"/><path class="b" d="M487.22,128.5v-6.18h1.21v5h2.75v1.15Z"/><path class="b" d="M492.1,128.5v-6.18h2.21a3.09,3.09,0,0,1,0,6.18Zm2.16-1.12a2,2,0,0,0,0-3.95h-1v3.95Z"/><path class="b" d="M498.41,128.5v-6.18h1.22v6.18Z"/><path class="b" d="M505,128.5l-2.8-4.39v4.39H501v-6.18h1.5l2.57,4.08v-4.08h1.2v6.18Z"/><path class="b" d="M512.33,128.5l-.07-.71a2.13,2.13,0,0,1-1.83.84,3,3,0,0,1-3.08-3.22,3.11,3.11,0,0,1,3.16-3.22,2.8,2.8,0,0,1,2.83,1.9l-1.15.41a1.66,1.66,0,0,0-1.68-1.19,2.12,2.12,0,0,0,0,4.22,1.56,1.56,0,0,0,1.66-1.2h-1.95v-1h3.08v3.22Z"/><path class="b" d="M482.75,135.07a6.44,6.44,0,0,0-2.45-.52,4.64,4.64,0,0,0-4.91,4.25,4.17,4.17,0,0,1,3.52-1.65,4.75,4.75,0,0,1,5.12,5c0,3-2.47,5.21-5.74,5.21s-6-2.34-6-6.82c0-5.32,3.34-8.7,8.23-8.7a6.54,6.54,0,0,1,3.11.68Zm-4.48,9.62a2.48,2.48,0,1,0-2.61-2.49A2.51,2.51,0,0,0,478.27,144.69Z"/><path class="b" d="M487.83,134.32a5.58,5.58,0,0,1,4.89-2.49,5.52,5.52,0,0,1,4.87,2.49,11.22,11.22,0,0,1,0,10.56,5.54,5.54,0,0,1-4.87,2.49,5.6,5.6,0,0,1-4.89-2.49,11.3,11.3,0,0,1,0-10.56Zm2.65,9.05a2.47,2.47,0,0,0,2.24,1.21,2.42,2.42,0,0,0,2.22-1.21,9.08,9.08,0,0,0,0-7.54,2.41,2.41,0,0,0-2.22-1.22,2.46,2.46,0,0,0-2.24,1.22,9.28,9.28,0,0,0,0,7.54Z"/><path class="b" d="M503,134.32a5.58,5.58,0,0,1,4.89-2.49,5.52,5.52,0,0,1,4.87,2.49,11.22,11.22,0,0,1,0,10.56,5.54,5.54,0,0,1-4.87,2.49,5.6,5.6,0,0,1-4.89-2.49,11.3,11.3,0,0,1,0-10.56Zm2.65,9.05a2.47,2.47,0,0,0,2.24,1.21,2.42,2.42,0,0,0,2.22-1.21,9.08,9.08,0,0,0,0-7.54,2.41,2.41,0,0,0-2.22-1.22,2.46,2.46,0,0,0-2.24,1.22,9.28,9.28,0,0,0,0,7.54Z"/>
        </a>

        <a target="_blank" xlink:href="<?php bloginfo('stylesheet_directory'); ?>/img/frontier-pdf/800-Park-Office-Building.pdf">
          <polygon class="a" points="643.25 231.64 633.76 236.09 623.5 243.06 541.01 284.31 541.01 306.59 536.37 308.31 564.64 363.31 577.42 357.5 578.97 360.98 595.38 352.85 597.17 355.56 612.92 348.75 615.61 351 672.68 326.2 672.68 303.8 678.78 301.14 643.25 231.64"/><path class="b" d="M591.25,294.58a1.66,1.66,0,0,1,1.88,1.66,1.38,1.38,0,0,1-.89,1.33,1.45,1.45,0,0,1,1.08,1.46,1.73,1.73,0,0,1-1.9,1.73H589v-6.18Zm-.18,2.55c.55,0,.88-.3.88-.77s-.31-.77-.89-.77h-.85v1.54Zm.12,2.62c.58,0,.93-.3.93-.8a.8.8,0,0,0-.91-.82h-1v1.62Z"/><path class="b" d="M594.28,298.57v-4h1.2v3.9a1.18,1.18,0,1,0,2.35,0v-3.9H599v4a2.38,2.38,0,0,1-4.75,0Z"/><path class="b" d="M600.38,300.76v-6.18h1.22v6.18Z"/><path class="b" d="M603,300.76v-6.18h1.2v5H607v1.15Z"/><path class="b" d="M607.88,300.76v-6.18h2.22a3.09,3.09,0,0,1,0,6.18Zm2.16-1.12a2,2,0,0,0,0-3.95h-1v3.95Z"/><path class="b" d="M614.19,300.76v-6.18h1.22v6.18Z"/><path class="b" d="M620.83,300.76,618,296.37v4.39h-1.2v-6.18h1.5l2.57,4.09v-4.09h1.2v6.18Z"/><path class="b" d="M628.12,300.76l-.08-.71a2.13,2.13,0,0,1-1.82.84,3,3,0,0,1-3.09-3.22,3.11,3.11,0,0,1,3.17-3.22,2.79,2.79,0,0,1,2.82,1.9l-1.15.41a1.65,1.65,0,0,0-1.67-1.19,2.12,2.12,0,0,0,0,4.22,1.55,1.55,0,0,0,1.65-1.2h-2v-1h3.08v3.22Z"/><path class="b" d="M588.21,315.26a3.91,3.91,0,0,1,2.63-3.61,3.61,3.61,0,0,1-2.33-3.31c0-2.49,2.22-4.25,5.3-4.25s5.31,1.76,5.31,4.25a3.61,3.61,0,0,1-2.31,3.31,3.9,3.9,0,0,1,2.6,3.61c0,2.56-2.21,4.35-5.6,4.35S588.21,317.82,588.21,315.26Zm8.12-.32a2.23,2.23,0,0,0-2.52-2.1,2.11,2.11,0,1,0,0,4.16C595.46,317,596.33,316,596.33,314.94Zm-.32-6.37a2.2,2.2,0,1,0-2.2,1.94A2,2,0,0,0,596,308.57Z"/><path class="b" d="M603.39,306.58a5.61,5.61,0,0,1,4.89-2.49,5.52,5.52,0,0,1,4.87,2.49,11.15,11.15,0,0,1,0,10.56,5.54,5.54,0,0,1-4.87,2.49,5.63,5.63,0,0,1-4.89-2.49,11.37,11.37,0,0,1,0-10.56Zm2.65,9.05a2.49,2.49,0,0,0,2.24,1.21,2.42,2.42,0,0,0,2.22-1.21,9.08,9.08,0,0,0,0-7.54,2.41,2.41,0,0,0-2.22-1.22,2.47,2.47,0,0,0-2.24,1.22,9.28,9.28,0,0,0,0,7.54Z"/><path class="b" d="M618.57,306.58a5.61,5.61,0,0,1,4.89-2.49,5.52,5.52,0,0,1,4.87,2.49,11.15,11.15,0,0,1,0,10.56,5.54,5.54,0,0,1-4.87,2.49,5.63,5.63,0,0,1-4.89-2.49,11.37,11.37,0,0,1,0-10.56Zm2.65,9.05a2.49,2.49,0,0,0,2.24,1.21,2.42,2.42,0,0,0,2.22-1.21,9.08,9.08,0,0,0,0-7.54,2.41,2.41,0,0,0-2.22-1.22,2.47,2.47,0,0,0-2.24,1.22,9.28,9.28,0,0,0,0,7.54Z"/>
        </a>

        <a target="_blank" xlink:href="<?php bloginfo('stylesheet_directory'); ?>/img/frontier-pdf/400-Park-Office-Building.pdf">
          <polygon class="a" points="915.31 390.28 915.31 459 841.57 459 841.57 441.54 826.71 441.54 826.71 425.57 811.3 425.57 811.3 390.28 856.43 390.28 856.43 399.94 863.3 399.94 863.3 408.48 886.89 408.48 886.89 390.28 915.31 390.28"/><path class="b" d="M860.68,421.83a1.67,1.67,0,0,1,1.88,1.66,1.38,1.38,0,0,1-.89,1.33,1.45,1.45,0,0,1,1.08,1.46,1.74,1.74,0,0,1-1.9,1.73h-2.39v-6.18Zm-.18,2.55c.55,0,.88-.3.88-.77s-.31-.77-.89-.77h-.85v1.54Zm.12,2.63c.58,0,.93-.31.93-.81a.8.8,0,0,0-.91-.82h-1V427Z"/><path class="b" d="M863.71,425.82v-4h1.2v3.9a1.18,1.18,0,1,0,2.35,0v-3.9h1.2v4a2.38,2.38,0,0,1-4.75,0Z"/><path class="b" d="M869.81,428v-6.18H871V428Z"/><path class="b" d="M872.44,428v-6.18h1.2v5h2.75V428Z"/><path class="b" d="M877.31,428v-6.18h2.22a3.09,3.09,0,0,1,0,6.18Zm2.16-1.12a2,2,0,0,0,0-3.95h-1v3.95Z"/><path class="b" d="M883.62,428v-6.18h1.22V428Z"/><path class="b" d="M890.26,428l-2.81-4.39V428h-1.2v-6.18h1.5l2.57,4.09v-4.09h1.2V428Z"/><path class="b" d="M897.55,428l-.08-.71a2.13,2.13,0,0,1-1.82.84,3,3,0,0,1-3.09-3.22,3.11,3.11,0,0,1,3.17-3.22,2.79,2.79,0,0,1,2.82,1.9l-1.15.41a1.65,1.65,0,0,0-1.67-1.19,2.12,2.12,0,0,0,0,4.22,1.55,1.55,0,0,0,1.65-1.2h-1.95v-1h3.08V428Z"/><path class="b" d="M857.09,440.05l6.24-8.37h3.89v9h2.45v2.7h-2.45v3.17h-3.11v-3.17h-7Zm7-5.08-4.23,5.67h4.23Z"/><path class="b" d="M873.21,433.83a5.6,5.6,0,0,1,4.89-2.49,5.54,5.54,0,0,1,4.87,2.49,11.15,11.15,0,0,1,0,10.56,5.54,5.54,0,0,1-4.87,2.49,5.6,5.6,0,0,1-4.89-2.49,11.37,11.37,0,0,1,0-10.56Zm2.65,9.05a2.49,2.49,0,0,0,2.24,1.21,2.42,2.42,0,0,0,2.22-1.21,9.08,9.08,0,0,0,0-7.54,2.4,2.4,0,0,0-2.22-1.21,2.47,2.47,0,0,0-2.24,1.21,9.28,9.28,0,0,0,0,7.54Z"/><path class="b" d="M888.39,433.83a5.6,5.6,0,0,1,4.89-2.49,5.54,5.54,0,0,1,4.87,2.49,11.15,11.15,0,0,1,0,10.56,5.54,5.54,0,0,1-4.87,2.49,5.6,5.6,0,0,1-4.89-2.49,11.37,11.37,0,0,1,0-10.56Zm2.65,9.05a2.49,2.49,0,0,0,2.24,1.21,2.42,2.42,0,0,0,2.22-1.21,9.08,9.08,0,0,0,0-7.54,2.4,2.4,0,0,0-2.22-1.21,2.47,2.47,0,0,0-2.24,1.21,9.28,9.28,0,0,0,0,7.54Z"/>
        </a>
      </svg>

      <section>
        <p>Available office space up to 121,000 SF.</p>
        <p>Startup and emerging company office space.</p>
        <p>Free coworking and meeting spaces.<br>Affordable startup offices and event spaces.</p>
        <p>Flexible, full-service startup lab and office space.</p>
      </section>
    </div>

    <div class="page-content"><?php the_field('page_content'); ?></div>

    <section class="content-grid">
      <?php if( have_rows('content_grid')):
        $count = 0;
        $group = 0;

        while( have_rows('content_grid')): the_row();
          if ($count % 2 == 0) {
            $group++;
            echo '<div class="row">';
          } ?>

            <article>
              <img src="<?php the_sub_field('icon'); ?>"/>
              <div>
                <h3><?php the_sub_field('title'); ?></h3>
                <?php the_sub_field('text'); ?>
                <a class="button secondary" href="<?php the_sub_field('link'); ?>">Learn More</a>
              </div>
            </article>

          <?php
          if ($count % 2 == 1) {
            echo '</div>';
          }
          $count++;
        endwhile;
      endif;?>
    </section>

  </div>

<?php endwhile; ?>

<?php get_footer(); ?>
