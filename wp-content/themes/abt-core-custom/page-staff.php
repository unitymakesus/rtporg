<?php
/**
 * Template Name: Staff
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
	<div class="content-container">
		<?php get_template_part('featured', 'banners'); ?>
		<div class="breadcrumbs">
			<?php if(function_exists('bcn_display')) {
				bcn_display();
			} ?>
		</div>
		<div class="content">
			<?php wp_reset_query(); ?>
            <?php
                /*  Custom query below.
                 *
                 *  Grab the child_of value from option tree option (or default to term id 5).
                 *
                 *  Then for each child category, do a term/taxonomy query to pull people results.
                 *
                 */
            ?>
		    <?php
				// Get categories within 'Staff'
				$cats = get_categories( array(
					'taxonomy' => 'division',
          'child_of' => ot_get_option( 'term_division_staff', 5 )
				) );
            ?>
            <?php if(empty($cats) || !$cats || count($cats)<1): ?>
                <?php /* Put what you want here. This means something went wrong and there were not results. */ ?>
                <h1><?php _e('This page cannot be found.'); ?></h1>
            <?php endif; ?>
			<?php foreach ($cats as $cat) : ?>
                <?php $term = get_term($cat->term_id,'division', OBJECT); ?>
                <?php
                    // Get posts from 'People' with specified categories
                    $args = array(
                        'post_type'      => 'people',
                        'taxonomy'		 	 => 'division',
                        'term'           => $term->slug,
                        'post_status'    => 'publish',
                        'orderby'        => 'title',
                        'order'          => 'ASC',
                        'posts_per_page' => -1
                    );
                ?>
                <?php query_posts($args); ?>
                <?php if (have_posts()) : ?>
				<h2 class="people-category"><?php echo $cat->name; ?></h2>
				<ul class="people">
					<?php while (have_posts()) : the_post(); ?>
						<?php
							// Person Fields
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
							$thumb_url = $thumb['0'];
							$job_title = types_render_field("person-job-title", array("raw"=>"true"));
							$company = types_render_field("person-company", array("raw"=>"true"));
						?>
						<li class="vcard has-profile">
							<a href="<?php the_permalink(); ?>">
								<?php if ( has_post_thumbnail( $post->ID ) ): ?>
									<div class="photo" style="background-image: url(<?php echo $thumb_url; ?>);"></div>
								<?php else : ?>
									<div class="photo placeholder" style="background-image: url(<?php echo $theme_dir; ?>/img/bg_no-profile.png);"></div>
								<?php endif; ?>

									<h3 class="fn"><?php the_title(); ?></h3>

								<?php if($job_title) : ?>
									<p class="role"><?php echo $job_title; ?></p>
								<?php endif; ?>

								<?php if($company) : ?>
									<p class="org"><?php echo $company; ?></p>
								<?php endif; ?>

								<img class="svg more" src="<?php echo $theme_dir; ?>/img/icons/i_search-submit.svg" />
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
			<?php endif; wp_reset_query(); ?>
			<?php endforeach; ?>
		</div>
	</div>

<?php get_footer(); ?>
