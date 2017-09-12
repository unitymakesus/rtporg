<?php if ( post_type_exists('showcases') ): ?>
	<section id="featured-showcases" class="featured-showcases">

		<?php query_posts( array(
			'post_type' => 'showcases'
		));

			if ( have_posts() ) : ?>

			<div class="flexslider">
				<ul class="slides">

				<?php while ( have_posts() ) : the_post(); ?>

					<li>
						<a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail( $post->ID ) ): ?>
			        		<figure class="post-image"><?php the_post_thumbnail(); ?></figure>
			        	<?php endif; ?>

			        		<h3 class="visuallyhidden"><?php the_title(); ?></h3>
						</a>
					</li>

				<?php endwhile; ?>

				</ul>
			</div>

		<?php endif; wp_reset_query(); ?>

	</section>
<?php endif; ?>