<?php
/*
Template Name: Custom Login
*/
/**
 * Custom Login Page
 * 
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v0.9.3

 * @see Custom Login/Register/Password Code @ http://digwp.com/2010/12/login-register-password-code/
 * @author JRS original by Jeff Starr
 */

require_once(ABT_ECOM_DIR.'/includes/customer/custom-login.php');

new ABT_Custom_Login( true );
?>