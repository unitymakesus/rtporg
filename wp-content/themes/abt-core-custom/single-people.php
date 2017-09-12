<?php
/**
 * People (Single Entry)
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 *
 */

get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php
			$theme_dir = get_stylesheet_directory_uri();

			$quote = types_render_field("person-featured-quote", array("raw"=>"true"));
			$phone = types_render_field("person-contact-phone-number", array("raw"=>"true"));
			$email = types_render_field("person-contact-email", array("raw"=>"true"));
			$twitter = types_render_field("person-contact-twitter", array("raw"=>"true"));
			$google = types_render_field("person-contact-google-handle", array("raw"=>"true"));
			$linkedin = types_render_field("person-contact-linkedin-handle", array("raw"=>"true"));
		?>
		<div class="content-container">
			<?php get_template_part('featured', 'banners'); ?>
			<div class="breadcrumbs">
			    <?php if(function_exists('bcn_display')) {
			    	bcn_display();
			    } ?>
			</div>			
	    	<div class="content-wrapper">
		    	<div class="content">					
					<?php if ($quote) : ?>
						<blockquote><?php echo $quote; ?></blockquote>
					<?php endif; ?>
					
					<h2>Biography</h2>
					<?php the_content(); ?>											
				</div>

				<?php if ($phone || $email || $twitter || $google || $linkedin) : ?>
			        <aside class="aside">				
						<section class="contact-info">
							<h3>Contact Info</h3>
							
							<?php if ($phone) : ?>
								<p class="contact-phone">
									<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_phone.svg" />
									<span><?php echo $phone; ?></span>
								</p>
							<?php endif; ?>

							<?php if ($email) : ?>
								<p class="contact-email">
									<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_contact-us.svg" />
									<a href="mailto:<?php echo $email; ?>">Email Me</a>
								</p>
							<?php endif; ?>
							
							<?php if ($twitter) : ?>
								<p class="contact-twitter">
									<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_twitter.svg" />
									<a href="https://twitter.com/<?php echo $twitter; ?>" target="_blank">Twitter</a>
								</p>
							<?php endif; ?>

							<?php if ($google) : ?>
								<p class="contact-google">
									<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_google.svg" />
									<a href="https://plus.google.com/+<?php echo $google; ?>" target="_blank">Google+</a></p>
							<?php endif; ?>

							<?php if ($linkedin) : ?>
								<p class="contact-linkedin">
									<img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_linkedin.svg" />
									<a href="http://www.linkedin.com/in/<?php echo $linkedin; ?>" target="_blank">LinkedIn</a></p>
							<?php endif; ?>
						</section>				
					</aside>
				<?php endif; ?>
			</div>
		</div>
	<?php endwhile; ?>

<?php get_footer(); ?>