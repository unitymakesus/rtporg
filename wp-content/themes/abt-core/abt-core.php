<?php

//  Register the function you want to call when it's time to check for updates
add_action( 'abtcore_check_for_updates', 'abtcore_parent_theme_update' );

/**
 * This function triggers an update check for the parent theme
 * Uses the abt self hosted repository
 */
function abtcore_parent_theme_update()
{
	//  Check For Updates @ Self Hosted Repository
	do_action(
		'abtcore_check_for_theme_updates',
		basename( dirname( __FILE__ ) ),
		__FILE__,
		false
	);
}


//  Register the self hosted repository hook function
//add_action( 'admin_notices', 'abtcore_has_serial' );

/**
 * This function shows/hides the serial # message
 * Leave this in place so that we can alert programming/client/designers
 *   as to whether there is a serial number for this install of CORE
 */
/*function abtcore_has_serial()
{
	$options = abtcore_get_option();

	//  Only show notices/errors when inside the WP admin area
	if ( is_admin() ) {
		?>
			<div class="error" id="abtcore-invalid-serial"
			<?php if ( isset( $options['core_serial_number'] ) &&  $options['core_serial_number'] ) : ?>style="display: none;"<?php endif;?>
			>
				<script type="text/javascript">
					function abtcore_post_init_serial_invalid() {
						jQuery('#abtcore-invalid-serial').show();
					}
					function abtcore_post_init_serial_valid() {
						jQuery('#abtcore-invalid-serial').hide();
					}
				</script>
				<h3>Your ABT Core Serial Number May Be Missing Or Invalid</h3>
				<p>If you have entered a serial number, then it may be invalid.</p>
				<p>Please contact support@atlanticbt.com or go to ABT Core->Core Settings->Serial Number to enter the number.</p>
			</div>
		<?php
	}
}*/