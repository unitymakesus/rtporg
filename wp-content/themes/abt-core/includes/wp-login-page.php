<?php



/**

 * Override and theme WP-ADMIN login page

 * @author jeremys

 *

 */

class abtcore_loginpage_override {

	public function __construct(){

		add_action('login_head', array(&$this, 'head'));

		add_filter('login_headertitle', array(&$this, 'headertitle'));

		add_filter('login_headerurl', array(&$this, 'headerurl'));

	}//--	fn	__construct



	/**

	 * Add stuff to the login <head> section

	 */

	public function head(){

		//image needed inline, to get theme directory programmatically

		?>

		<link rel="stylesheet" id="abtcore-admin-css"  href="<?php

		if( file_exists( get_stylesheet_directory() . '/css/login.css' ) ){

			$admin_stylesheet = get_stylesheet_directory_uri();

		}

		else {

			$admin_stylesheet = get_template_directory_uri();

		}

		echo $admin_stylesheet; ?>/css/login.css" type="text/css" media="screen" />

		<?php
		echo '<link rel="shortcut" href="' . get_bloginfo('template_directory') . '/favicon.ico" /><link rel="shortcut icon" href="' . get_bloginfo('template_directory') . '/favicon.ico" />';
	}//--	fn	head



	/**

	 * Change the header title (a title="...")

	 * @param string $value the thing to change

	 */

	public function headertitle($value){

		return $value . ', Customized for ' . get_bloginfo('name');	//change it here

	}//--	fn	headertitle

	/**

	 * Change the header url (a href="...")

	 * @param string $value the thing to change

	 */

	public function headerurl($value){

		return get_bloginfo( 'url' );	//change it here

	}//--	fn	headerurl



}///---	class	abtcore_loginpage_override

new abtcore_loginpage_override();



?>