<?php
/*
 * WordPress Ajax Login
 * https://github.com/dcooney/wordpress-ajax-login
 *
 * Copyright 2014 Connekt Media - http://cnkt.ca/wordpress-ajax-login/
 * Free to use under the GPLv2 license.
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Author: Darren Cooney
 * Twitter: @KaptonKaos
*/
//Path the wp-ajax-login
$wp_ajax_login_path = get_template_directory_uri() . '/wp-ajax-login/';

function wp_ajax_login_init(){	
	//Load Ajax Login CSS
	wp_enqueue_style( 'wp-ajax-login-css', get_template_directory_uri() . '/wp-ajax-login/css/wp-ajax-login.css'); 
	//Enable a user without admin privileges to login via ajax
	add_action( 'wp_ajax_nopriv_ajaxlogin', 'wp_ajax_login_submit' );	 	 
}
// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'wp_ajax_login_init');
}

function wp_ajax_login_submit(){
    // Check the nonce, if it fails the function will break
    check_ajax_referer( 'wordpress-ajax-login-nonce', 'security' );
	
	//Check login values
    $login_arr = array();
    $login_arr['user_login'] = $_POST['username'];
    $login_arr['user_password'] = $_POST['password'];    
    $rememberme = $_POST['remember'];
    
	 if($rememberme == 'forever'){
	 	$remember = true;
	 	$login_arr['remember'] = true;
	 }else{
	 	$remember = false;
	 	$login_arr['remember'] = false;
	 } 

    $ajax_user_signon = wp_signon( $login_arr, false );
    if ( is_wp_error($ajax_user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password, please try again.')));
    } else {
        echo json_encode(array('loggedin'=>true, 'message'=>__('Hello, we are redirecting you now...')));
    }
    die();
}

// SHORTCODE - WP Ajax Login Shortcode
function wp_ajax_login( $atts, $content = null ) {	
	extract(shortcode_atts(array(
		'redirect_url' 		=> get_permalink(),
		'loading_msg' 		=> __('Authenticating user...'),
		'error_msg' 		=> __('Authentication failed. Wrong username or password.'),
		'redirect_msg' 		=> __('Success! We are redirecting you now.'),
		'toggle_password' 	=> true
   ), $atts));	 
   
   //Enqueue JS 
   wp_enqueue_script( 'wp-ajax-login-js', get_template_directory_uri() . '/wp-ajax-login/js/wp-ajax-login.js', array('jquery') );
   
   //Localize the variables	
	wp_localize_script( 'wp-ajax-login-js', 'wp_ajax_login', array( 
	  'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
	  'redirect_url' 	=> $redirect_url,
	  'loading_msg' 	=> $loading_msg,
	  'error_msg' 		=> $error_msg,
	  'redirect_msg' 	=> $redirect_msg,
	  'toggle_password' => $toggle_password
	));
		
	
	
	global $user_login, $user_identity;
	get_currentuserinfo();
	if ($user_login){
		ob_start();
		include $wp_ajax_login_path. 'includes/user-meta.php';
		$content = ob_get_clean();
		return $content;
	}else{	
   		ob_start();
		include $wp_ajax_login_path. 'includes/login-form.php';
		$content = ob_get_clean();
		return $content;	
	}
		
}
add_shortcode('wp_ajax_login', 'wp_ajax_login');

