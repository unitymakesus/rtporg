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

	<div class="content-container">
    	<div class="wrapper group">
        	<div class="breadcrumbs">
			    <?php if(function_exists('bcn_display')) {
			    	bcn_display();
			    } ?>
			</div>
        	<div class="content">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<?php
						$job_title    = types_render_field("person_job_title", array("raw"=>"true"));
						$email        = types_render_field("person_email", array("raw"=>"true"));
						$phone        = types_render_field("person_phone", array("raw"=>"true"));
						$phone_ext    = types_render_field("person_phone_ext", array("raw"=>"true"));
						$fax          = types_render_field("person_fax", array("raw"=>"true"));
						$facebook     = types_render_field("person_facebook_profile", array("raw"=>"true"));
						$twitter      = types_render_field("person_twitter_profile", array("raw"=>"true"));
						$linkedin     = types_render_field("person_linkedin_profile", array("raw"=>"true"));
						$flickr       = types_render_field("person_flickr_profile", array("raw"=>"true"));
					?>
					<article class="person">
						<header>
							<?php if ( has_post_thumbnail( $post->ID ) ): ?>
	                			<figure class="post-image"><?php the_post_thumbnail(); ?></figure>
	                		<?php endif; ?>

	                		<hgroup>
	                			<h1><?php the_title(); ?></h1>
	                			<h2><?php echo $job_title; ?></h2>
	                		</hgroup>
						</header>
	                	<?php the_content(); ?>
	                	<footer>
	                		<h3>Contact Information</h3>

		                	<?php if($email) : ?>
		                		<div><strong>Email:</strong> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div>
		                	<?php endif; ?>

		                	<?php if($phone) : ?>
		                		<div><strong>Phone:</strong> <?php echo $phone; ?> <?php if($phone_ext) : ?><strong>Ext.</strong> <?php echo $phone_ext; ?><?php endif; ?></div>
		                	<?php endif; ?>

		                	<?php if($fax) : ?>
		                		<div><strong>Fax:</strong> <?php echo $fax; ?></div>
		                	<?php endif; ?>

	                		<h3>Follow Me</h3>
	                		<ul>
	                		<?php if($facebook) : ?>
	                			<li><a href="<?php echo $facebook; ?>">Facebook</a></li>
	                		<?php endif; ?>

	                		<?php if($twitter) : ?>
	                			<li><a href="<?php echo $twitter; ?>">Twitter</a></li>
	                		<?php endif; ?>

	                		<?php if($linkedin) : ?>
	                			<li><a href="<?php echo $linkedin; ?>">Linked In</a></li>
	                		<?php endif; ?>

	                		<?php if($flickr) :?>
	                			<li><a href="<?php echo $flickr; ?>">Flickr</a></li>
	                		<?php endif; ?>
	                		</ul>
	                	</footer>
					</article>
				<?php endwhile; ?>
			</div>
            <aside class="aside">
				<?php the_submenu(); ?>
				<?php get_sidebar(); ?>
			</aside>
		</div>
	</div>

<?php get_footer(); ?>