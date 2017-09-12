<?php
/**
 * Template Name: Why RTP
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 *
 */

get_header(); ?>

<?php
	$theme_dir = get_stylesheet_directory_uri();
	wp_enqueue_script('chartjs', $theme_dir . '/js/chart.min.js', array('jquery'), null, true );
?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="content-container">
			<div class="content-wrapper">
		    	<div class="content">
					<?php

						$site_logo                  = ot_get_option( 'primary_logo' );

						// Titles
						$section1_title             = types_render_field("why-rtp-section-1-title", array("raw"=>"true"));
						$section2_title             = types_render_field("why-rtp-section-2-title", array("raw"=>"true"));
						$section3_title             = types_render_field("why-rtp-section-3-title", array("raw"=>"true"));
						$section4_title             = types_render_field("why-rtp-section-4-title", array("raw"=>"true"));
						$section5_title             = types_render_field("why-rtp-section-5-title", array("raw"=>"true"));
						$section6_title             = types_render_field("why-rtp-section-6-title", array("raw"=>"true"));
						$section7_title             = types_render_field("why-rtp-section-7-title", array("raw"=>"true"));

						// Content
						$section1_primary_content   = do_shortcode(types_render_field("why-rtp-section-1-primary-content", array("raw"=>"true")));
						$section2_primary_content   = do_shortcode(types_render_field("why-rtp-section-2-primary-content", array("raw"=>"true")));
						$section3_primary_content   = do_shortcode(types_render_field("why-rtp-section-3-primary-content", array("raw"=>"true")));
						$section4_primary_content   = do_shortcode(types_render_field("why-rtp-section-4-primary-content", array("raw"=>"true")));
						$section5_primary_content   = do_shortcode(types_render_field("why-rtp-section-5-primary-content", array("raw"=>"true")));
						$section6_primary_content   = do_shortcode(types_render_field("why-rtp-section-6-primary-content", array("raw"=>"true")));
						$section7_primary_content   = do_shortcode(types_render_field("why-rtp-section-7-primary-content", array("raw"=>"true")));

						$section2_secondary_content = do_shortcode(types_render_field("why-rtp-section-2-secondary-content", array("raw"=>"true")));
						$section3_secondary_content = do_shortcode(types_render_field("why-rtp-section-3-secondary-content", array("raw"=>"true")));
						$section4_secondary_content = do_shortcode(types_render_field("why-rtp-section-4-secondary-content", array("raw"=>"true")));
						$section5_secondary_content = do_shortcode(types_render_field("why-rtp-section-5-secondary-content", array("raw"=>"true")));
						$section7_secondary_content = do_shortcode(types_render_field("why-rtp-section-7-secondary-content", array("raw"=>"true")));

						$section2_tertiary_content  = do_shortcode(types_render_field("why-rtp-section-2-tertiary-content", array("raw"=>"true")));

						// Backgrounds
						$section1_bg                = types_render_field("why-rtp-section-1-background", array("raw"=>"true"));
						$section2_bg                = types_render_field("why-rtp-section-2-background", array("raw"=>"true"));
						$section3_bg                = types_render_field("why-rtp-section-3-background", array("raw"=>"true"));
						$section4_bg                = types_render_field("why-rtp-section-4-background", array("raw"=>"true"));
						$section5_bg                = types_render_field("why-rtp-section-5-background", array("raw"=>"true"));
						$section6_bg                = types_render_field("why-rtp-section-6-background", array("raw"=>"true"));
						$section7_bg                = types_render_field("why-rtp-section-7-background", array("raw"=>"true"));

						$section2_bg_ncsu           = types_render_field("why-rtp-section-2-background-ncsu", array("raw"=>"true"));
						$section2_bg_duke           = types_render_field("why-rtp-section-2-background-duke", array("raw"=>"true"));
						$section2_bg_unc            = types_render_field("why-rtp-section-2-background-unc", array("raw"=>"true"));

						$section6_bg_raleigh        = types_render_field("why-rtp-section-6-background-raleigh", array("raw"=>"true"));
						$section6_bg_durham         = types_render_field("why-rtp-section-6-background-durham", array("raw"=>"true"));
						$section6_bg_chapel_hill    = types_render_field("why-rtp-section-6-background-chapel-hill", array("raw"=>"true"));

						// Stats
						$section2_stat1_value       = types_render_field("why-rtp-section-2-stat-1-value", array("raw"=>"true"));
						$section2_stat2_value       = types_render_field("why-rtp-section-2-stat-2-value", array("raw"=>"true"));
						$section2_stat3_value       = types_render_field("why-rtp-section-2-stat-3-value", array("raw"=>"true"));
						$section5_stat1_value       = types_render_field("why-rtp-section-5-stat-1-value", array("raw"=>"true"));
						$section5_stat2_value       = types_render_field("why-rtp-section-5-stat-2-value", array("raw"=>"true"));
						$section5_stat3_value       = types_render_field("why-rtp-section-5-stat-3-value", array("raw"=>"true"));

						$section2_stat1_label       = types_render_field("why-rtp-section-2-stat-1-label", array("raw"=>"true"));
						$section2_stat2_label       = types_render_field("why-rtp-section-2-stat-2-label", array("raw"=>"true"));
						$section2_stat3_label       = types_render_field("why-rtp-section-2-stat-3-label", array("raw"=>"true"));
						$section5_stat1_label       = types_render_field("why-rtp-section-5-stat-1-label", array("raw"=>"true"));
						$section5_stat2_label       = types_render_field("why-rtp-section-5-stat-2-label", array("raw"=>"true"));
						$section5_stat3_label       = types_render_field("why-rtp-section-5-stat-3-label", array("raw"=>"true"));

					?>
					<div class="pagination-vertical">
						<a href="#section-intro">.01</a>
						<a href="#section-education">.02</a>
						<a href="#section-diversity">.03</a>
						<a href="#section-incubators">.04</a>
						<a href="#section-recognition">.05</a>
						<a href="#section-metro">.06</a>
						<a href="#section-foundation">.07</a>
					</div>
					<section id="section-intro" class="featured-banner theme-ocean section-intro" <?php if (!empty($section1_bg)) { ?>style="background-image: url(<?php echo $section1_bg; ?>);"<?php } ?>>
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.01</small> <?php echo $section1_title; ?></h1>
								<hr />
								<?php echo $section1_primary_content; ?>
							</div>
						</div>
					</section>
					<section id="section-education" class="featured-banner theme-dark-forest section-education" <?php if (!empty($section2_bg)) { ?>style="background-image: url(<?php echo $section2_bg; ?>);"<?php } ?>>
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.02</small> <?php echo $section2_title; ?></h1>
								<hr />
								<?php echo $section2_primary_content; ?>

								<ul class="stats-education">
									<li>
										<canvas id="stat-associates" height="88" width="88"></canvas>
										<strong><?php echo $section2_stat1_value; ?>%</strong>
										<span><?php echo $section2_stat1_label; ?></span>
									</li>
									<li>
										<canvas id="stat-bachelors" height="88" width="88"></canvas>
										<strong><?php echo $section2_stat2_value; ?>%</strong>
										<span><?php echo $section2_stat2_label; ?></span>
									</li>
									<li>
										<canvas id="stat-graduates" height="88" width="88"></canvas>
										<strong><?php echo $section2_stat3_value; ?>%</strong>
										<span><?php echo $section2_stat3_label; ?></span>
									</li>
								</ul>
								<?php echo $section2_secondary_content; ?>
								<?php echo $section2_tertiary_content; ?>
								<ul class="universities">
									<li class="tooltip" title="Duke University" data-ref="university-duke">
										<img class="svg duke" src="<?php echo $theme_dir; ?>/img/g_logo-duke.svg" />
										<span></span>
									</li>
									<li class="tooltip" title="NC State University" data-ref="university-ncsu">
										<img class="svg ncsu" src="<?php echo $theme_dir; ?>/img/g_logo-ncsu.svg" />
										<span></span>
									</li>
									<li class="tooltip" title="UNC-Chapel Hill" data-ref="university-unc">
										<img class="svg unc" src="<?php echo $theme_dir; ?>/img/g_logo-unc.svg" />
										<span></span>
									</li>
								</ul>
							</div>
						</div>
						<div class="featured-banner university-scene university-ncsu theme-ncsu" style="background-image: url(<?php echo $section2_bg_ncsu; ?>);"></div>
						<div class="featured-banner university-scene university-duke theme-duke" style="background-image: url(<?php echo $section2_bg_duke; ?>);"></div>
						<div class="featured-banner university-scene university-unc theme-unc" style="background-image: url(<?php echo $section2_bg_unc; ?>);"></div>
					</section>
					<section id="section-diversity" class="featured-banner theme-ocean section-diversity" <?php if (!empty($section3_bg)) { ?>style="background-image: url(<?php echo $section3_bg; ?>);"<?php } ?>>
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.03</small> <?php echo $section3_title; ?></h1>
								<hr />
								<div class="sectors">
									<ul>
										<li class="tooltip" title="Industries">
											<img class="svg knockout" src="<?php echo $theme_dir; ?>/img/icons/i_industries.svg" />
											<span>Industries</span>
										</li>
										<li class="tooltip" title="Government">
											<img class="svg knockout" src="<?php echo $theme_dir; ?>/img/icons/i_government.svg" />
											<span>Government</span>
										</li>
										<li class="tooltip" title="Universities">
											<img class="svg knockout" src="<?php echo $theme_dir; ?>/img/icons/i_education.svg" />
											<span>Universities</span>
										</li>
									</ul>
									<div class="dna strand-top">
										<img class="svg" src="<?php echo $theme_dir; ?>/img/g_dna-strand-top.svg" />
									</div>
									<div class="dna strand-middle">
										<img class="svg" src="<?php echo $theme_dir; ?>/img/g_dna-strand-middle.svg" />
									</div>
									<div class="dna strand-bottom">
										<img class="svg" src="<?php echo $theme_dir; ?>/img/g_dna-strand-bottom.svg" />
									</div>
								</div>
								<?php echo $section3_primary_content; ?>
								<?php echo $section3_secondary_content; ?>
							</div>
						</div>
					</section>
					<section id="section-incubators" class="featured-banner theme-creamsicle section-incubators" <?php if (!empty($section4_bg)) { ?>style="background-image: url(<?php echo $section4_bg; ?>);"<?php } ?>>
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.04</small> <?php echo $section4_title; ?></h1>
								<hr />
								<div class="incubator-chart">
									<span class="hub"><img class="svg" src="<?php echo $site_logo; ?>" /></span>
									<span class="resources tooltip" title="Resources"><img class="svg knockout" src="<?php echo $theme_dir; ?>/img/icons/i_resources.svg" /></span>
									<span class="services tooltip" title="Services"><img class="svg knockout" src="<?php echo $theme_dir; ?>/img/icons/i_services.svg" /></span>
									<span class="network tooltip" title="Networking"><img class="svg knockout" src="<?php echo $theme_dir; ?>/img/icons/i_networking.svg" /></span>
								</div>
								<?php echo $section4_primary_content; ?>
								<?php echo $section4_secondary_content; ?>
							</div>
						</div>
					</section>
					<section id="section-recognition" class="featured-banner theme-forest section-recognition" <?php if (!empty($section5_bg)) { ?>style="background-image: url(<?php echo $section5_bg; ?>);"<?php } ?>>
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.05</small> <?php echo $section5_title; ?></h1>
								<hr />
								<ul class="stats-recognition">
									<li>
										<strong>0</strong>
										<hr>
										<img class="svg knockout" src="<?php echo $theme_dir; ?>/img/icons/i_rocket.svg" />
										<span><?php echo $section5_stat1_label; ?></span>
									</li>
									<li>
										<strong>0</strong>
										<hr>
										<img class="svg knockout" src="<?php echo $theme_dir; ?>/img/icons/i_patents.svg" />
										<span><?php echo $section5_stat2_label; ?></span>
									</li>
									<li>
										<strong>0</strong>
										<hr>
										<img class="svg knockout" src="<?php echo $theme_dir; ?>/img/icons/i_trademark.svg" />
										<span><?php echo $section5_stat3_label; ?></span>
									</li>
								</ul>
								<?php echo $section5_primary_content; ?>
								<?php echo $section5_secondary_content; ?>
							</div>
						</div>
					</section>
					<section id="section-metro" class="featured-banner theme-midnight section-metro" <?php if (!empty($section6_bg)) { ?>style="background-image: url(<?php echo $section6_bg; ?>);"<?php } ?>>
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.06</small> <?php echo $section6_title; ?></h1>
								<hr />
								<ul class="metro-locations">
									<li class="tooltip" title="Raleigh" data-ref="location-raleigh"><span>Raleigh</span></li>
									<li class="tooltip" title="Durham" data-ref="location-durham"><span>Durham</span></li>
									<li class="tooltip" title="Chapel Hill" data-ref="location-chapel-hill"><span>Chapel Hill</span></li>
								</ul>
								<?php echo $section6_primary_content; ?>
							</div>
						</div>
						<div class="featured-banner metro-scene location-raleigh theme-ncsu" style="background-image: url(<?php echo $section6_bg_raleigh; ?>);"></div>
						<div class="featured-banner metro-scene location-durham theme-duke" style="background-image: url(<?php echo $section6_bg_durham; ?>);"></div>
						<div class="featured-banner metro-scene location-chapel-hill theme-unc" style="background-image: url(<?php echo $section6_bg_chapel_hill; ?>);"></div>
					</section>
					<section id="section-foundation" class="featured-banner theme-dark-forest section-foundation" <?php if (!empty($section7_bg)) { ?>style="background-image: url(<?php echo $section7_bg; ?>);"<?php } ?>>
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.07</small> <?php echo $section7_title; ?></h1>
								<hr />
								<div class="rtp-brand">
									<img class="svg icon" src="<?php echo $site_logo; ?>" />
									<img class="svg boundary" src="<?php echo $theme_dir; ?>/img/g_logo-rtp-boundary.svg" />
									<img class="svg boundary" src="<?php echo $theme_dir; ?>/img/g_logo-rtp-boundary.svg" />
								</div>
								<?php echo $section7_primary_content; ?>
								<?php echo $section7_secondary_content; ?>
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

				/* Chart JS
			    ------------------------------------------------------------------------ */
				var container = $(document);
				var chartBaseColor = 'rgba(255,255,255,.25)';
				var chartFillColor = '#fff';
				var statOptions = {
					segmentShowStroke: false,
					percentageInnerCutout: 90,
					animationEasing: 'linear'
				};
				var statAssociatesData = [
					{
						value: <?php echo $section2_stat1_value; ?>,
						color: chartFillColor
					},
					{
						value : 100 - <?php echo $section2_stat1_value; ?>,
						color : chartBaseColor
					}
				];
				var statBachelorsData = [
					{
						value: <?php echo $section2_stat2_value; ?>,
						color: chartFillColor
					},
					{
						value : 100 - <?php echo $section2_stat2_value; ?>,
						color : chartBaseColor
					}
				];
				var statGraduatesData = [
					{
						value: <?php echo $section2_stat3_value; ?>,
						color: chartFillColor
					},
					{
						value : 100 - <?php echo $section2_stat3_value; ?>,
						color : chartBaseColor
					}
				];

				/* Scrolling functions
			    ------------------------------------------------------------------------ */
				var section_stats = $('#section-recognition'),
						section_education = $('#section-education'),
						stats_animated = false,
						charts_animated = false,
						midpoint = $(window).height() / 2;

				container.on('scroll', throttle(function () {

					var section_stats_offset = $(section_stats)[0].getBoundingClientRect().top;

					if (section_stats_offset <= midpoint && stats_animated == false) {
						$('.stats-recognition li:first-child strong:not(.counted)').countTo({
							from: 0,
							to: <?php echo $section5_stat1_value; ?>,
							speed: 1000,
							refreshInterval: 20
						}).addClass('counted');
						$('.stats-recognition li:nth-child(2) strong:not(.counted)').countTo({
							from: 0,
							to: <?php echo $section5_stat2_value; ?>,
							speed: 1000,
							refreshInterval: 20
						}).addClass('counted');
						$('.stats-recognition li:last-child strong:not(.counted)').countTo({
							from: 0,
							to: <?php echo $section5_stat3_value; ?>,
							speed: 1000,
							refreshInterval: 20
						}).addClass('counted');

						stats_animated = true;
					}

					var section_education_offset = $(section_education)[0].getBoundingClientRect().top;

					if (section_education_offset <= midpoint && charts_animated == false) {
						var statAssociates = new Chart(document.getElementById("stat-associates").getContext("2d")).Doughnut(statAssociatesData, statOptions);
						var statBachelors = new Chart(document.getElementById("stat-bachelors").getContext("2d")).Doughnut(statBachelorsData, statOptions);
						var statGraduates = new Chart(document.getElementById("stat-graduates").getContext("2d")).Doughnut(statGraduatesData, statOptions);

						charts_animated = true;
					}

				}, 100));

			});
		</script>
	<?php endwhile; ?>

<?php get_footer(); ?>
