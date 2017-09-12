<?php if ( post_type_exists( 'heroes' ) ) : ?>

	<section class="owl-carousel owl-theme heroes">
		<?php
			$slide_count = ot_get_option( 'heroes_number_posts' );
			$my_query = new WP_Query(array(
				'post_type' => 'heroes',
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'posts_per_page' => $slide_count
			));

			while ($my_query->have_posts()) : $my_query->the_post();

			$use_link    = types_render_field("hero_link_question", array("raw"=>"true"));
			$link        = types_render_field("hero_link_web_address", array("raw"=>"true"));
			$format      = types_render_field("hero_link_format", array("raw"=>"true"));
			$text        = types_render_field("hero_button_text", array("raw"=>"true"));
		?>

		<div class="item">
			<?php if($use_link == "2") : ?>

		    	<?php if ( has_post_thumbnail( $post->ID ) ): ?>

		        	<?php if($format == "2") : ?>
		            	<figure class="photo"><a href="<?php echo $link; ?>"><?php echo get_the_post_thumbnail( $post->ID, 'hero' ); ?></a></figure>
		            <?php else : ?>
		            	<figure class="photo"><?php echo get_the_post_thumbnail( $post->ID, 'hero' ); ?></figure>
		            <?php endif; ?>

		        <?php endif; ?>

		        <div class="summary">
		       		<h1 class="title"><?php the_title(); ?></h1>
		            <div class="lead-in">
		            	<?php the_content(); ?>

		            	<?php if($format == "1") : ?>
		            		<a href="<?php echo $link; ?>"><?php echo $text; ?></a>
		            	<?php endif; ?>
		            </div>
		        </div>

		    <?php else : ?>

		    	<?php if ( has_post_thumbnail( $post->ID ) ): ?>
		        	<div class="photo"><?php echo get_the_post_thumbnail( $post->ID, 'hero' ); ?></div>
		        <?php endif; ?>

		        <div class="summary">
		       		<h1 class="title"><?php the_title(); ?></h1>
		            <div class="lead-in">
		            	<?php the_content(); ?>
		            </div>
		        </div>

		    <?php endif; ?>
	    </div>

	    <?php endwhile; wp_reset_query(); ?>
	</section>

<?php endif; ?>