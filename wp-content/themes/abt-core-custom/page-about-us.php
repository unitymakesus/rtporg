<?php
/**
 * Template Name: About Us
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 *
 */

get_header(); ?>

<?php
	$theme_dir = get_stylesheet_directory_uri();
	//wp_enqueue_script('chartjs', $theme_dir . '/js/chart.min.js', array('jquery'), null, true );
?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="content-container">
			<div class="content-wrapper">
		    	<div class="content">
					<?php
						// Titles
						$section1_title           = types_render_field("about-us-section-1-title", array("raw"=>"true"));
						$section2_title           = types_render_field("about-us-section-2-title", array("raw"=>"true"));
						$section3_title           = types_render_field("about-us-section-3-title", array("raw"=>"true"));
						$section4_title           = types_render_field("about-us-section-4-title", array("raw"=>"true"));
						$section5_title           = types_render_field("about-us-section-5-title", array("raw"=>"true"));
						$section6_title           = types_render_field("about-us-section-6-title", array("raw"=>"true"));
						$section7_title           = types_render_field("about-us-section-7-title", array("raw"=>"true"));
						$section8_title           = types_render_field("about-us-section-8-title", array("raw"=>"true"));
						$section9_title           = types_render_field("about-us-section-9-title", array("raw"=>"true"));
						$section10_title          = types_render_field("about-us-section-10-title", array("raw"=>"true"));
						$section11_title          = types_render_field("about-us-section-11-title", array("raw"=>"true"));

						// Content
						$section1_content         = do_shortcode(types_render_field("about-us-section-1-content", array("raw"=>"true")));
						$section2_content         = do_shortcode(types_render_field("about-us-section-2-content", array("raw"=>"true")));
						$section3_content         = do_shortcode(types_render_field("about-us-section-3-content", array("raw"=>"true")));
						$section4_content         = do_shortcode(types_render_field("about-us-section-4-content", array("raw"=>"true")));
						$section5_content         = do_shortcode(types_render_field("about-us-section-5-content", array("raw"=>"true")));
						$section6_content         = do_shortcode(types_render_field("about-us-section-6-content", array("raw"=>"true")));
						$section7_content         = do_shortcode(types_render_field("about-us-section-7-content", array("raw"=>"true")));
						$section8_content         = do_shortcode(types_render_field("about-us-section-8-content", array("raw"=>"true")));
						$section9_content         = do_shortcode(types_render_field("about-us-section-9-content", array("raw"=>"true")));
						$section10_content        = do_shortcode(types_render_field("about-us-section-10-content", array("raw"=>"true")));
						$section11_content        = do_shortcode(types_render_field("about-us-section-11-content", array("raw"=>"true")));

						// Backgrounds
						$section1_bg              = types_render_field("about-us-section-1-background", array("raw"=>"true"));
						$section2_bg              = types_render_field("about-us-section-2-background", array("raw"=>"true"));
						$section3_bg              = types_render_field("about-us-section-3-background", array("raw"=>"true"));
						$section4_bg              = types_render_field("about-us-section-4-background", array("raw"=>"true"));
						$section5_bg              = types_render_field("about-us-section-5-background", array("raw"=>"true"));
						$section6_bg              = types_render_field("about-us-section-6-background", array("raw"=>"true"));
						$section7_bg              = types_render_field("about-us-section-7-background", array("raw"=>"true"));
						$section8_bg              = types_render_field("about-us-section-8-background", array("raw"=>"true"));
						$section9_bg              = types_render_field("about-us-section-9-background", array("raw"=>"true"));
						$section10_bg             = types_render_field("about-us-section-10-background", array("raw"=>"true"));
						$section11_bg             = types_render_field("about-us-section-11-background", array("raw"=>"true"));

						// Stats
						$section9_stat1_value     = types_render_field("about-us-section-9-stat-1-value", array("raw"=>"true"));
						$section9_stat2_value     = types_render_field("about-us-section-9-stat-2-value", array("raw"=>"true"));

						$section9_stat1_label     = types_render_field("about-us-section-9-stat-1-label", array("raw"=>"true"));
						$section9_stat2_label     = types_render_field("about-us-section-9-stat-2-label", array("raw"=>"true"));
					?>
					<div class="pagination-vertical">
						<a href="#section-intro">.01</a>
						<a href="#section-our-home">.02</a>
						<a href="#section-our-story">.03</a>
						<a href="#section-long-shot">.04</a>
						<a href="#section-potential">.05</a>
						<a href="#section-generosity">.06</a>
						<a href="#section-the-vision">.07</a>
						<a href="#section-momentum">.08</a>
						<a href="#section-the-promise">.09</a>
						<a href="#section-purpose">.10</a>
						<a href="#section-next-chapter">.11</a>
					</div>
					<section id="section-intro" class="featured-banner theme-frosty section-intro" <?php if (!empty($section1_bg)) { ?>style="background-image: url(<?php echo $section1_bg; ?>);"<?php } ?>>
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.01</small> <?php echo $section1_title; ?></h1>
								<hr />
								<?php echo $section1_content; ?>
							</div>
						</div>
					</section>
					<section id="section-our-home" class="featured-banner theme-frosty section-our-home" <?php if (!empty($section2_bg)) { ?>style="background-image: url(<?php echo $section2_bg; ?>);"<?php } ?>>
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.02</small> <?php echo $section2_title; ?></h1>
								<hr />
								<?php echo $section2_content; ?>
							</div>
						</div>
					</section>
					<section id="section-our-story" class="featured-banner theme-ocean section-our-story" <?php if (!empty($section3_bg)) { ?>style="background-image: url(<?php echo $section3_bg; ?>);"<?php } ?>>
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.03</small> <?php echo $section3_title; ?></h1>
								<hr />
								<?php echo $section3_content; ?>
							</div>
						</div>
					</section>
					<section id="section-long-shot" class="featured-banner theme-creamsicle section-long-shot" <?php if (!empty($section4_bg)) { ?>style="background-image: url(<?php echo $section4_bg; ?>);"<?php } ?>>
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.04</small> <?php echo $section4_title; ?></h1>
								<hr />
								<div id="tobacco" class="tobacco">
									<img class="active" src="<?php echo $theme_dir; ?>/img/g_tobacco-01.svg" />
									<img src="<?php echo $theme_dir; ?>/img/g_tobacco-02.svg" />
									<img src="<?php echo $theme_dir; ?>/img/g_tobacco-03.svg" />
									<img src="<?php echo $theme_dir; ?>/img/g_tobacco-04.svg" />
									<img src="<?php echo $theme_dir; ?>/img/g_tobacco-05.svg" />
									<img src="<?php echo $theme_dir; ?>/img/g_tobacco-06.svg" />
								</div>
								<?php echo $section4_content; ?>
							</div>
						</div>
					</section>
					<section id="section-potential" class="featured-banner theme-frosty section-potential" <?php if (!empty($section5_bg)) { ?>style="background-image: url(<?php echo $section5_bg; ?>);"<?php } ?>>
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.05</small> <?php echo $section5_title; ?></h1>
								<hr />
								<div class="orbiting-potential">
									<canvas id="orbit-raleigh" class="orbit orbit-raleigh"></canvas>
									<canvas id="orbit-durham" class="orbit orbit-durham"></canvas>
									<canvas id="orbit-chapel-hill" class="orbit orbit-chapel-hill"></canvas>
									<i class="plot-raleigh"></i>
									<i class="plot-durham"></i>
									<i class="plot-chapel-hill"></i>
									<img class="svg knockout" src="<?php echo $theme_dir; ?>/img/g_logo-rtp-boundary.svg" />
								</div>
								<?php echo $section5_content; ?>
							</div>
						</div>
					</section>
					<section id="section-generosity" class="featured-banner theme-frosty section-generosity" <?php if (!empty($section6_bg)) { ?>style="background-image: url(<?php echo $section6_bg; ?>);"<?php } ?>>
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.06</small> <?php echo $section6_title; ?></h1>
								<hr />
								<div class="community">
									<i class="plot-raleigh"></i>
									<i class="plot-durham"></i>
									<i class="plot-chapel-hill"></i>
									<img class="svg logo" src="<?php echo $theme_dir; ?>/img/l_rtp-logo.svg" />
									<img class="svg dots" src="<?php echo $theme_dir; ?>/img/g_logo-rtp-boundary-dots.svg" />
									<img class="svg knockout" src="<?php echo $theme_dir; ?>/img/l_rtp-logo-shape.svg" />
								</div>
								<?php echo $section6_content; ?>
							</div>
						</div>
					</section>
					<section id="section-the-vision" class="featured-banner theme-ocean section-the-vision" <?php if (!empty($section7_bg)) { ?>style="background-image: url(<?php echo $section7_bg; ?>);"<?php } ?>>
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.07</small> <?php echo $section7_title; ?></h1>
								<hr />
								<div class="state-vision">
									<div class="logo tooltip" title="The Vision Starts Here"><img class="svg knockout" src="<?php echo $theme_dir; ?>/img/l_rtp-logo.svg" /></div>
									<img class="svg knockout dots" src="<?php echo $theme_dir; ?>/img/g_nc-boundary-dots.svg" />
									<img class="svg knockout" src="<?php echo $theme_dir; ?>/img/g_nc-boundary.svg" />
								</div>
								<?php echo $section7_content; ?>
							</div>
						</div>
					</section>
					<section id="section-momentum" class="featured-banner theme-ibm section-momentum" <?php if (!empty($section8_bg)) { ?>style="background-image: url(<?php echo $section8_bg; ?>);"<?php } ?>>
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.08</small> <?php echo $section8_title; ?></h1>
								<hr />
								<?php echo $section8_content; ?>
							</div>
						</div>
					</section>
					<section id="section-the-promise" class="featured-banner theme-dark-forest section-the-promise" <?php if (!empty($section9_bg)) { ?>style="background-image: url(<?php echo $section9_bg; ?>);"<?php } ?>>
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.09</small> <?php echo $section9_title; ?></h1>
								<hr />
								<ul class="stats-recognition">
									<li>
										<strong>0</strong>
										<hr>
										<img class="svg knockout" src="<?php echo $theme_dir; ?>/img/icons/i_building.svg" />
										<span><?php echo $section9_stat1_label; ?></span>
									</li>
									<li>
										<strong>0</strong>
										<hr>
										<img class="svg knockout" src="<?php echo $theme_dir; ?>/img/icons/i_about-us.svg" />
										<span><?php echo $section9_stat2_label; ?></span>
									</li>
								</ul>

								<div class="fields-expertise">
									<h2>Fields of Expertise</h2>
									<ul>
										<li class="active">
											<strong>Microelectronics</strong>
											<img class="svg knockout" src="<?php echo $theme_dir; ?>/img/g_area-microelectronics.svg" />
										</li>
										<li>
											<strong>Telecommunications</strong>
											<img class="svg knockout" src="<?php echo $theme_dir; ?>/img/g_area-telecommunications.svg" />
										</li>
										<li>
											<strong>Biotechnology</strong>
											<img class="svg knockout" src="<?php echo $theme_dir; ?>/img/g_area-biotechnology.svg" />
										</li>
										<li>
											<strong>Chemicals</strong>
											<img class="svg knockout" src="<?php echo $theme_dir; ?>/img/g_area-chemicals.svg" />
										</li>
										<li>
											<strong>Pharmaceuticals</strong>
											<img class="svg knockout" src="<?php echo $theme_dir; ?>/img/g_area-pharma.svg" />
										</li>
										<li>
											<strong>Environmental Sciences</strong>
											<img class="svg knockout" src="<?php echo $theme_dir; ?>/img/g_area-environmental.svg" />
										</li>
									</ul>
								</div>
								<?php echo $section9_content; ?>
							</div>
						</div>
					</section>
					<section id="section-purpose" class="featured-banner theme-ocean section-purpose" <?php if (!empty($section10_bg)) { ?>style="background-image: url(<?php echo $section10_bg; ?>);"<?php } ?>>
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.10</small> <?php echo $section10_title; ?></h1>
								<hr />
								<?php echo $section10_content; ?>
							</div>
						</div>
					</section>
					<section id="section-next-chapter" class="featured-banner theme-creamsicle section-next-chapter" <?php if (!empty($section11_bg)) { ?>style="background-image: url(<?php echo $section11_bg; ?>);"<?php } ?>>
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.11</small> <?php echo $section11_title; ?></h1>
								<hr />
								<?php echo $section11_content; ?>
							</div>
						</div>
					</section>
					<div id="scroll-indicator" class="scroll-indicator">
						<div class="group">
							<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_search-submit.svg" />
							<span>Scroll Down</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			$(document).ready(function() {

				var container = $(document),
						midpoint = $(window).height() / 2,
						stats_animated = false,
						tobacco_animated = false;

				$(window).load(function() {
					// Invert Scroll Indicator
					if ( $('.theme-frosty.animate-section').length ) {
            $('#scroll-indicator').addClass('inverted');
          } else {
          	$('#scroll-indicator').removeClass('inverted');
          }
				});

				/* Scrolling functions
			    ------------------------------------------------------------------------ */
				container.on('scroll', throttle(function () {

					// Animate Stats
					var section_stats_offset = $('#section-the-promise')[0].getBoundingClientRect().top;
					if (section_stats_offset <= midpoint && stats_animated == false) {
						$('.stats-recognition li:first-child strong:not(.counted)').countTo({
							from: 0,
							to: <?php echo $section9_stat1_value; ?>,
							speed: 1000,
							refreshInterval: 20
						}).addClass('counted');
						$('.stats-recognition li:last-child strong:not(.counted)').countTo({
							from: 0,
							to: <?php echo $section9_stat2_value; ?>,
							speed: 1000,
							refreshInterval: 20
						}).addClass('counted');

					 	stats_animated = true;
					}

					// Animate Tobacco
					var tobacco_offset = $('#tobacco')[0].getBoundingClientRect().top;
					// console.log(midpoint);
					// console.log(tobacco_offset);
					if (tobacco_offset <= midpoint && tobacco_animated == false) {

						// console.log('lets do it');
						var loop,
          			i = 0;

            if ($('#tobacco img:first-child').is('.active')) {
              loop = setInterval(function() {
                if (i < 5) {
                  i++;
                  $('#tobacco img').removeClass().css('opacity', 0);
                  $('#tobacco img').eq(i).addClass('active').css('opacity', 1);
                } else {
                  $('#tobacco img').removeClass().css('opacity', 0);
                  $('#tobacco img').eq(5).addClass('active').css('opacity', 1);
                  $('#tobacco').addClass('animate-tobbaco');
                }
              }, 100);
            } else {
              return;
            }

					 	tobacco_animated = true;
					}

					// Invert Scroll Indicator
					if ( $('.theme-frosty.animate-section').length ) {
            $('#scroll-indicator').addClass('inverted');
          } else {
          	$('#scroll-indicator').removeClass('inverted');
          }

				}, 100));

			});
		</script>
	<?php endwhile; ?>

<?php get_footer(); ?>
