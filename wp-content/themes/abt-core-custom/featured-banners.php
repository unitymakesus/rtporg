<?php
    // Global variables
    global $post;
    $slug                = get_post( $post )->post_name;
    $theme_dir           = get_stylesheet_directory_uri();

    // Banner titles
    $banner_title        = types_render_field( "banner-title", array( "raw" => "true" ) );
    $banner_subtitle     = types_render_field( "banner-subtitle", array( "raw" => "true" ) );

    // Banner graphics
    if (is_archive() && function_exists( 'cfi_featured_image_url' ) ) {
    $banner_graphic      = cfi_featured_image_url( array( 'size' => 'full' ) );
    }
    else {
    $banner_graphic      = ( is_singular('location') ) ? $theme_dir . "/img/bg_location-banner.jpg" : types_render_field( "banner-graphic", array( "raw" => "true" ) );
    }

    // Banner options
    $banner_theme        = types_render_field( "banner-theme", array( "raw" => "true" ) );
    $banner_type         = types_render_field( "banner-type", array( "raw" => "true" ) );
    $banner_description  = types_render_field( "banner-description", array( "raw" => "true" ) );
    $banner_quote        = types_render_field( "banner-quote", array( "raw" => "true" ) );
    $banner_tagline      = types_render_field( "display-brand-and-tagline", array( "raw" => "true" ) );

    // People variables
    $job_title           = types_render_field( "person-job-title", array( "raw" => "true" ) );
    $company_name        = types_render_field( "person-company", array( "raw" => "true" ) );
    $thumb               = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'people-thumb' );
    $thumb_url           = isset( $thumb['0'] ) ? $thumb['0'] : '';

    // Location overrides
    if ( is_singular('location') ) {
        $banner_theme    = ( $banner_theme != 'no-theme' &&  $banner_theme != '') ? $banner_theme : 'theme-dark-forest';
    }

    // Apply options
    $apply_type          = ($banner_type != '') ? 'type-' . $banner_type . ' ' : '';
    $apply_subtitle      = ($banner_subtitle != '') ? '<small>' . $banner_subtitle . '</small>' : '';
    $apply_description   = ($banner_description != '') ? '<p>' . do_shortcode( $banner_description ) . '</p>' : '';
    $apply_graphic       = ($banner_graphic != '') ? 'style="background-image: url(' . $banner_graphic .');"' : '';
    $apply_graphic_class = ($banner_graphic == '') ? ' no-graphic' : '';
    $apply_theme         = ($banner_theme != '') ? $banner_theme : '';
?>
<?php if ( is_search() ) : ?>
	<div class="featured-banner type-default theme-ocean">
		<h1>Search Results</h1>
		<div class="site-search"><?php get_search_form(); ?></div>
		<div class="results-count">
			<p>We found the following results:</p>
		</div>
	</div>
<?php elseif ( is_archive() ) : ?>
	<div class="featured-banner type-default theme-ocean" <?php echo $apply_graphic; ?>>
		<h1><?php printf( single_cat_title( '', false ) . ' <small>Category Archives</small>' ); ?></h1>
	</div>
<?php elseif ( is_singular( 'people' ) ) : ?>
	<div class="featured-banner <?php echo $apply_type . $apply_theme . $apply_graphic_class; ?>" <?php echo $apply_graphic; ?>>	
		<?php if ( has_post_thumbnail( $post->ID ) ): ?>
			<div class="photo" style="background-image: url(<?php echo $thumb_url; ?>);"></div>
		<?php else : ?>
			<div class="photo placeholder" style="background-image: url(<?php echo $theme_dir; ?>/img/icons/i_about-us.svg);"></div>
		<?php endif; ?>
		<h1><?php the_title(); ?>
			<?php if ( $job_title ) : ?>
				<small><?php echo $job_title; ?>
			<?php endif; ?>
			<?php if ( $company_name ) : ?>
				 - <?php echo $company_name; ?></small>
			<?php else : ?>
				</small>
			<?php endif; ?>
		</h1>		
	</div>
<?php elseif ( is_singular( 'location' ) && $banner_title ) : ?>
    <div class="featured-banner <?php echo $apply_type . $apply_theme . $apply_graphic_class; ?>" <?php echo $apply_graphic; ?>>
        <h1><?php echo $banner_title; ?> <?php echo $apply_subtitle; ?></h1>
        <?php echo $apply_description; ?>
    </div>
<?php elseif ( is_singular( 'location' ) ) : ?>
	<div class="featured-banner <?php echo $apply_type . $apply_theme . $apply_graphic_class; ?>" <?php echo $apply_graphic; ?>>
		<h1><?php the_title(); ?> <?php echo $apply_subtitle; ?></h1>
        <?php echo $apply_description; ?>
	</div>
<?php elseif ( $banner_title ) : ?>
	<div class="featured-banner <?php echo $apply_type . $apply_theme . $apply_graphic_class; ?>" <?php echo $apply_graphic; ?>>
		<?php if ( $banner_type == "quote" ) : ?>
			<q><?php echo $banner_quote; ?></q>
		<?php else : ?>
			<h1><?php echo $banner_title; ?> <?php echo $apply_subtitle; ?></h1>
			<?php echo $apply_description; ?>
		<?php endif; ?>

		<?php if ( is_home() && $banner_tagline == "yes" ) : ?>
			<div class="site-info">
				<small class="site-name"><?php bloginfo( 'name' ); ?></small>
				<small class="site-tagline"><?php bloginfo( 'description' ); ?></small>
			</div>	
		<?php endif; ?>
	</div>
<?php endif; ?>
