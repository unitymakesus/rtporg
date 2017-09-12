<?php
/**
 * Template Name: Our Mission
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 *
 */

get_header(); ?>

	<?php
		$theme_dir = get_stylesheet_directory_uri();
	?>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="content-container">
			<div class="content-wrapper">
				<div class="content">
					<?php
						// Titles
						$section1_title           = types_render_field("our-mission-section-1-title", array("raw"=>"true"));
						$section2_title           = types_render_field("our-mission-section-2-title", array("raw"=>"true"));
						$section3_title           = types_render_field("our-mission-section-3-title", array("raw"=>"true"));
						$section4_title           = types_render_field("our-mission-section-4-title", array("raw"=>"true"));
						$section5_title           = types_render_field("our-mission-section-5-title", array("raw"=>"true"));
						$section6_title           = types_render_field("our-mission-section-6-title", array("raw"=>"true"));
						
						// Content
						$section6_primary_content = do_shortcode(types_render_field("our-mission-section-6-primary-content", array("raw"=>"true")));
						
						// Backgrounds
						$section1_bg              = types_render_field("our-mission-section-1-background", array("raw"=>"true"));
						$section2_bg              = types_render_field("our-mission-section-2-background", array("raw"=>"true"));
						$section3_bg              = types_render_field("our-mission-section-3-background", array("raw"=>"true"));
						$section4_bg              = types_render_field("our-mission-section-4-background", array("raw"=>"true"));
						$section5_bg              = types_render_field("our-mission-section-5-background", array("raw"=>"true"));
						$section6_bg              = types_render_field("our-mission-section-6-background", array("raw"=>"true"));
						
						// Sources
						$section1_src             = types_render_field("our-mission-section-1-source", array("raw"=>"true"));
						$section2_src             = types_render_field("our-mission-section-2-source", array("raw"=>"true"));
						$section3_src             = types_render_field("our-mission-section-3-source", array("raw"=>"true"));
						$section4_src             = types_render_field("our-mission-section-4-source", array("raw"=>"true"));
						$section5_src             = types_render_field("our-mission-section-5-source", array("raw"=>"true"));
						$section6_src             = types_render_field("our-mission-section-6-source", array("raw"=>"true"));
					?>
					<div class="pagination-vertical">
						<a href="#mission-1">.01</a>
						<a href="#mission-2">.02</a>
						<a href="#mission-3">.03</a>
						<a href="#mission-4">.04</a>
						<a href="#mission-5">.05</a>
						<a href="#mission-6">.06</a>
					</div>
					<section id="mission-1" class="featured-banner theme-ocean" style="background-image: url(<?php echo $section1_bg; ?>);">
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.01</small> <?php echo $section1_title; ?></h1>
							</div>
						</div>
						<p class="source"><small><?php echo $section1_src; ?></small></p>
					</section>
					<section id="mission-2" class="featured-banner theme-dark-forest" style="background-image: url(<?php echo $section2_bg; ?>);">
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.02</small> <?php echo $section2_title; ?></h1>
							</div>
						</div>
						<p class="source"><small><?php echo $section2_src; ?></small></p>
					</section>
					<section id="mission-3" class="featured-banner theme-ocean" style="background-image: url(<?php echo $section3_bg; ?>);">
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.03</small> <?php echo $section3_title; ?></h1>
							</div>
						</div>
						<p class="source"><small><?php echo $section3_src; ?></small></p>
					</section>
					<section id="mission-4" class="featured-banner theme-creamsicle" style="background-image: url(<?php echo $section4_bg; ?>);">
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.04</small> <?php echo $section4_title; ?></h1>
							</div>
						</div>
						<p class="source"><small><?php echo $section4_src; ?></small></p>
					</section>
					<section id="mission-5" class="featured-banner theme-forest" style="background-image: url(<?php echo $section5_bg; ?>);">
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.05</small> <?php echo $section5_title; ?></h1>
							</div>
						</div>
						<p class="source"><small><?php echo $section5_src; ?></small></p>
					</section>
					<section id="mission-6" class="featured-banner theme-ocean" style="background-image: url(<?php echo $section6_bg; ?>);">
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.06</small> <?php echo $section6_title; ?></h1>
								<?php echo $section6_primary_content; ?>
							</div>
						</div>
						<p class="source"><small><?php echo $section6_src; ?></small></p>
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
	<?php endwhile; ?>

<?php get_footer(); ?>