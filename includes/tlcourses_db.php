<?php


//create database function
function tlcourses_db(){
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
    $table_name= courses_tablename();
	
	$sql = "CREATE TABLE $table_name (
		course_id int(11) NOT NULL auto_increment,        
        course_name varchar(100) default NULL,
		course_category varchar(100) default NULL,
        course_type varchar(100) default NULL,
		course_banner_url text default NULL,
		large_course_banner_url text default NULL,
        level varchar(100) default NULL,
        credit_hrs varchar(100) default NULL,
		actual_price varchar(100) default NULL,
		discounted_price varchar(100) default NULL,
		dis_percent varchar(10) default NULL,
		course_description longtext default NULL,
		instructor_name varchar(100) default NULL,
		instructor_description varchar(255) default NULL,
		days_info varchar(100) default NULL,
		schedules varchar(200) default NULL,
		
		time_s TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ON UPDATE CURRENT_TIMESTAMP,
		PRIMARY KEY  (course_id)
        )$charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	
}
	

//table name only
function courses_tablename(){
    global $table_prefix;
    $table_name = $table_prefix.'tlcourses_info';
    return $table_name;
}

//create 2nd database table function
function tlcourses_enrolled_db(){
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
    $enrolled_table_name= courses_enrolled_tablename();

	$sql = "CREATE TABLE $enrolled_table_name (
		user_id int(11) NOT NULL auto_increment,
        course_id int(11) default NULL,
		course_name varchar(100) default NULL,
        user_name varchar(100) default NULL,
        user_email varchar(100) default NULL,
        user_address varchar(100) default NULL,
        user_phone varchar(15) default NULL,			
		enrolled_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ON UPDATE CURRENT_TIMESTAMP,
		course_enroll_status varchar(100) NOT NULL DEFAULT 'Not Started',
		visible varchar(20) NOT NULL DEFAULT 'Visible',
		remarks longtext default NULL,
		PRIMARY KEY  (user_id)
        )$charset_collate;";
		
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

}

//courses enrolled table name 
function courses_enrolled_tablename(){
    global $table_prefix;
    $table_name = $table_prefix.'tlcourses_enrolled';
    return $table_name;
}

?>