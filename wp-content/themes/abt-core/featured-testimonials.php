<?php if ( post_type_exists('testimonials') ): ?>

	<?php
		query_posts( array(
			'post_type' => 'testimonials',
			'posts_per_page' => '1'
		) );
		if ( have_posts() ) : while ( have_posts() ) : the_post();

		$cite             = types_render_field("testimonial_cite", array("raw"=>"true"));
		$job_title        = types_render_field("testimonial_job_title", array("raw"=>"true"));
		$company          = types_render_field("testimonial_company", array("raw"=>"true"));
		$website          = types_render_field("testimonial_website", array("raw"=>"true"));
		$website_target   = types_render_field("testimonial_website_target", array("raw"=>"true"));
	?>

		<blockquote class="featured-testimonial">
			<?php the_content(); ?>
			<footer>
			<?php if ( has_post_thumbnail( $post->ID ) ): ?>
	        	<figure class="post-image"><?php the_post_thumbnail(); ?></figure>
	        <?php endif; ?>

			<?php if ($cite) : ?>
				<h4><a href="<?php the_permalink(); ?>"><?php echo $cite; ?></a></h4>
			<?php endif; ?>

				<p><small>
				<?php if ($job_title) : ?>
					<?php echo $job_title; ?>,
				<?php endif; ?>
				<?php if ($website) : ?>
					<a href="<?php echo $website; ?>" <?php if ($website_target == "2") : ?>target="_blank"<?php endif; ?>><?php echo $company; ?></a>
				<?php endif; ?>
				</small></p>
			</footer>
		</blockquote>

	<?php endwhile; endif; wp_reset_query(); ?>

<?php endif; ?>