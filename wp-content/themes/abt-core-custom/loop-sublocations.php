<?php
/**
 * The loop that displays posts.
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v0.9.3
 */

global $post;
$slug = get_post( $post )->post_name;
$theme_dir = get_stylesheet_directory_uri();
?>
<?php if ( have_posts() ) : ?>
	<section class="source-local social-grid">
		<h3><?php echo $wp_query->post_count; ?> Spaces Within This Location:</h3>
		<ul class="company-list sub-locations">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				$address1 = types_render_field( "location-address-line-1", array( "raw"=>"true" ) );
				$address2 = types_render_field( "location-address-line-2", array( "raw"=>"true" ) );
				$city     = types_render_field( "location-city", array( "raw"=>"true" ) );
				$zip      = types_render_field( "location-zip-code", array( "raw"=>"true" ) );

				// Photos
				$company_url  = types_render_field( "location-company-logo", array( "raw" => "true" ) );
				$thumb_url    = ($company_url != null) ? 'style="background-image: url(' . $company_url . ');"' : null;
				?>
				<li class="vcard has-profile">
					<a href="<?php the_permalink(); ?>">
						<?php if ( $thumb_url ): ?>
							<div class="photo" <?php echo $thumb_url;?>></div>
						<?php else : ?>
							<div class="photo placeholder"></div>
						<?php endif; ?>
						<h3 class="fn"><span><?php the_title(); ?></span></h3>
						<img class="svg more" src="<?php echo $theme_dir; ?>/img/icons/i_search-submit.svg" />
					</a>
				</li>
			<?php endwhile; ?>
		</ul>
	</section>
<?php endif; ?>

<?php if (function_exists("pagination")) {
	pagination($additional_loop->max_num_pages);
} ?>
