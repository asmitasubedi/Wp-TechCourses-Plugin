<?php
/*
Plugin Name: TechLekh Courses Enroll Plugin
Plugin URI:
Description: Courses Enroll Now Plugin
Author: Asmita Subedi
Version: 1.0
Author URI: https://asmitasubediblog.wordpress.com/
*/

define('TECHLEKH_COURSES_ENROLLNOW_VERSION', '1.1');
define('TECHLEKH_COURSES_ENROLLNOW_URL', plugins_url('',__FILE__));
define('TECHLEKH_COURSES_ENROLLNOW_PATH',plugin_dir_path( __FILE__ ));

include 'includes/tlcourses_include.php';

function tlcourses_admin_register_head(){
	$cssurl = TECHLEKH_COURSES_ENROLLNOW_URL.'/admin/css/tlcourses-admin-css.css';
	echo '<link rel=\'stylesheet\' href="'.$cssurl.'" type=\'text/css\' media=\'all\' />';
	echo '<link rel=\'stylesheet\' href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>';
}

function tlcourses_load_admin_js(){
	
	$jsurl = TECHLEKH_COURSES_ENROLLNOW_URL.'/admin/js/tlcourses_script.js';
	echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>';
	echo '<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>';
	echo '<script src="https://apis.google.com/js/platform.js"></script>';
	echo '<script src="'.$jsurl.'"></script>';
}

//load assets
add_action('admin_head', 'tlcourses_admin_register_head');
add_action('admin_enqueue_scripts','tlcourses_load_admin_js');


//add admin panel
add_action('admin_menu', 'register_tlcourses_admin_page');

//create menus in admin panel
function register_tlcourses_admin_page(){
    add_menu_page("TL Courses", "TL Courses", "add_users", __FILE__, "tlcourses_courses_list", plugins_url('/admin/images/tl_btn_buttons_logo.png', __FILE__ ));
	add_submenu_page(__FILE__, "Manage Courses", "Manage Courses", "add_users", "tlcourses-courses-list", "tlcourses_courses_list");
    add_submenu_page(__FILE__, "Add Courses", "Add Courses", "add_users","tlcourses-courses-add", "tlcourses_courses_add");
	add_submenu_page(__FILE__, "Enrolled Queries", "Enrolled Queries", "add_users","tlcourses-enrolled-list", "tlcourses_enrolled_list");
}

//create database on activate
register_activation_hook(__FILE__,'tlcourses_db');
register_activation_hook(__FILE__,'tlcourses_enrolled_db');


//enqueue and localize styles and scripts for frontend ajax calls
add_action( 'wp_enqueue_scripts', 'enqueue_tlcourses_scripts' );

function enqueue_tlcourses_scripts() {
	
	if ( is_page() || is_single() ) {
		
	wp_enqueue_style( 'tlcourses-frontend-style', 
		plugins_url('/public/css/tlcourses_frontend_styles.css', __FILE__)
		);
	
	wp_enqueue_script( 'tlcourses-frontend-script',
        plugins_url( '/public/js/tlcourses_frontend_scripts.js', __FILE__ ),
        array( 'jquery' ));
		
		
	$course_nonce = wp_create_nonce( 'tlcourse-nonce' );
	wp_localize_script( 'tlcourses-frontend-script', 'tlcourse', array(
		'course_ajax_url' => admin_url( 'admin-ajax.php' ),
		'course_nonce'    => $course_nonce,
	));
		
	}
}

//add AJAX action for all users (logged in as well as non users)
add_action( 'wp_ajax_nopriv_save_to_enrolled_db', 'save_to_enrolled_db' );
add_action( 'wp_ajax_save_to_enrolled_db', 'save_to_enrolled_db' );


//Server Side Ajax handler function
function save_to_enrolled_db() {
	check_ajax_referer( 'tlcourse-nonce' );
	$return = array(
			'course_id' => ($_POST['tlcourse_id']),
			'course_name' => $_POST['tlcourse_courseName'], 
			'user_name' => $_POST['user_name'], 
			'user_email' => $_POST['user_email'], 
			'user_address' => $_POST['user_location'], 
			'user_phone' => $_POST['user_phone']
	); 

	global $wpdb;
	$table_name=courses_enrolled_tablename();
    $data=array(
				course_id => ($_POST['tlcourse_id']),
				course_name => $_POST['tlcourse_courseName'], 
				user_name => $_POST['user_name'], 
				user_email => $_POST['user_email'], 
				user_address => $_POST['user_location'], 
				user_phone => $_POST['user_phone']
	); 
    $wpdb->insert( $table_name, $data);
	wp_send_json_success( $return );
	die();
}
?>