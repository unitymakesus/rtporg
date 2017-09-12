<?php
/**
 * Template Name: Full Page Background
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

<?php						

	$stat1_value     = types_render_field("stat-1-value", array("raw"=>"true"));
	$stat2_value     = types_render_field("stat-2-value", array("raw"=>"true"));
	
	$stat1_label     = types_render_field("stat-1-label", array("raw"=>"true"));
	$stat2_label     = types_render_field("stat-2-label", array("raw"=>"true"));

	$page_theme = types_render_field("page-theme", array("raw"=>"true"));
	$page_background = types_render_field("page-background", array("raw"=>"true"));
	$page_animation = types_render_field("page-animation", array("raw"=>"true"));	

?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="content-container">
			<div class="content-wrapper">
		    	<div class="content">					
					
					<section class="featured-banner section-generosity <?php echo $page_theme; ?>" style="background-image: url(<?php echo $page_background; ?>);">
						<div class="flex-container">
							<div class="flex-content">
								<h1><?php the_title(); ?></h1>
								<hr />

								<?php
									if($page_animation != "no-animation") {
										include (STYLESHEETPATH . '/'. $page_animation .'.php');
									}
								?>
								<?php the_content(); ?>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	<?php endwhile; ?>

	<script>
	$(document).ready(function() {
			
			var stats_recognition = $('.stats-recognition');
			if(stats_recognition.length) {
				$('.stats-recognition li:first-child strong:not(.counted)').countTo({
					from: 0,
					to: <?php echo $stat1_value; ?>,
					speed: 1000,
					refreshInterval: 20
				}).addClass('counted');
				$('.stats-recognition li:last-child strong:not(.counted)').countTo({
					from: 0,
					to: <?php echo $stat2_value; ?>,
					speed: 1000,
					refreshInterval: 20
				}).addClass('counted');
			}

			
			var tobbaco_animation = $('#tobacco');
			if(tobbaco_animation.length) {
				var loop,
		        	i = 0;

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
        	}

        	$('.featured-banner .flex-content').css("opacity", 0);
			setInterval(function () {
				$('.featured-banner .flex-content').css("opacity", 1);
			    $('.featured-banner').addClass('animate-section')
			}, 600);
    });
	</script>
	

<?php get_footer(); ?>