<?php
/**
 * Template Name: Contact Us
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 *
 */

get_header(); ?>

<?php
	$theme_dir           = get_stylesheet_directory_uri();
	$adr_street_physical = ot_get_option( 'street_address_physical' );
	$adr_street_mailing  = ot_get_option( 'street_address_mailing' );
	$city                = ot_get_option( 'city' );
	$state               = ot_get_option( 'state' );
	$zip                 = ot_get_option( 'zip_code' );
	$email               = ot_get_option( 'email_address' );
	$phone               = ot_get_option( 'phone_number' );
	$fax                 = ot_get_option( 'fax_number' );
	$download_label      = ot_get_option( 'download_label' );
	$download_file       = ot_get_option( 'download_file' );
	$download_label_2     = ot_get_option( 'download_label_2' );
	$download_file_2       = ot_get_option( 'download_file_2' );
	$download_label_3      = ot_get_option( 'download_label_3' );
	$download_file_3       = ot_get_option( 'download_file_3' );
	$download_label_4      = ot_get_option( 'download_label_4' );
	$download_file_4       = ot_get_option( 'download_file_4' );
	$download_label_5      = ot_get_option( 'download_label_5' );
	$download_file_5       = ot_get_option( 'download_file_5' );
?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="content-container">
			<?php get_template_part('featured', 'banners'); ?>
			<div class="breadcrumbs">
			    <?php if(function_exists('bcn_display')) {
			    	bcn_display();
			    } ?>
			</div>			
	    	<div class="content-wrapper">
		    	<div class="content">					
					<?php if ($banner_title) : ?>
						<h2><?php the_title(); ?></h2>
					<?php else : ?>
						<h1><?php the_title(); ?></h1>
					<?php endif; ?>
					<?php the_content(); ?>								
				</div>

		        <aside class="aside">
					<div class="vcard">
						<h2 class="fn org visuallyhidden">Research Triangle Park</h2>
						
						<h3>Physical Address</h3>
						<div class="adr location-physical">
							<span class="street-address"><?php echo $adr_street_physical; ?></span>
							<span class="locality"><?php echo $city; ?></span>, <span class="region"><?php echo $state; ?></span> <span class="postal-code"><?php echo $zip; ?></span>
						</div>
						<a class="button secondary" href="http://maps.google.com/maps?rlz=1C5CHFA_enUS503US503&es_sm=119&q=12+Davis+Drive+Research+Triangle+Park,+NC+27709&um=1&ie=UTF-8&hq=&hnear=0x89acef954c64b3bd:0x3cc90f24c301600b,12+Davis+Dr,+Durham,+NC+27703&gl=us&daddr=12+Davis+Dr,+Durham,+NC+27703&sa=X&ei=qg9yU4v8IsTMsQT81oDQAQ&ved=0CCgQwwUwAA" target="_blank">Get Directions</a>

						<h3>Mailing Address</h3>
						<div class="adr location-mailing">
							<span class="street-address"><?php echo $adr_street_mailing; ?></span>
							<span class="locality"><?php echo $city; ?></span>, <span class="region"><?php echo $state; ?></span> <span class="postal-code"><?php echo $zip; ?></span>
						</div>

						<h3>General Information</h3>
						<div class="email"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div>

						<h3>Main Phone</h3>
						<div class="tel"><?php echo $phone; ?></div>

						<h3>Main Fax</h3>
						<div class="fax"><?php echo $fax; ?></div>
						
						<?php if($download_file) : ?>
							<div class="download"><a href="<?php echo $download_file; ?>" target="_blank"><?php echo $download_label; ?></a></div>
						<?php endif; ?>
						<?php if($download_file_2) : ?>
							<div class="download"><a href="<?php echo $download_file_2; ?>" target="_blank"><?php echo $download_label_2; ?></a></div>
						<?php endif; ?>
						<?php if($download_file_3) : ?>
							<div class="download"><a href="<?php echo $download_file_3; ?>" target="_blank"><?php echo $download_label_3; ?></a></div>
						<?php endif; ?>
						<?php if($download_file_4) : ?>
							<div class="download"><a href="<?php echo $download_file_4; ?>" target="_blank"><?php echo $download_label_4; ?></a></div>
						<?php endif; ?>
						<?php if($download_file_5) : ?>
							<div class="download"><a href="<?php echo $download_file_5; ?>" target="_blank"><?php echo $download_label_5; ?></a></div>
						<?php endif; ?>
					</div>
				</aside>
			</div>
		</div>
	<?php endwhile; ?>

<?php get_footer(); ?>