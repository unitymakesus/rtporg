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
	<?php if( have_rows('mission_section') ): ?>
		<div class="content-container">
			<div class="content-wrapper">
				<div class="content">
					<div class="pagination-vertical">
						<?php while ( have_rows('mission_section') ) : the_row(); ?>
							<a href="#mission-<?php echo get_row_index(); ?>">.0<?php echo get_row_index(); ?></a>
						<?php endwhile ?>
					</div>

					<?php while ( have_rows('mission_section') ) : the_row();
					 	$index = get_row_index();
						$image = get_sub_field('background_image');
						$caption = get_sub_field('caption');
						$headline = get_sub_field('headline');
						$link = get_sub_field('button_link');
					?>

					<section id="mission-<?php echo $index; ?>" class="featured-banner theme-ocean" style="background-image: url(<?php echo $image; ?>);">
						<div class="flex-container">
							<div class="flex-content">
								<h1><small>.0<?php echo $index; ?></small> <?php echo $headline; ?></h1>
								<hr>
								<h3><?php echo $caption; ?></h3>
								<?php if($link): ?>
									<a style="margin-top: 2em;" class="button primary" href="<?php echo $link; ?>">Learn More</a>
								<?php endif ?>
							</div>
						</div>
					</section>
				<?php endwhile; ?>

					<div id="scroll-indicator" class="scroll-indicator">
						<div class="group">
							<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_search-submit.svg" />
							<span>Scroll Down</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif?>
<?php get_footer(); ?>
