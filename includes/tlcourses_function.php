<?php

//redirect users
function redirecttoCourseList(){
    ?>
    <script>
        window.location.assign("admin.php?page=tlcourses-courses-list")
    </script>
    <?php
}

//add courses
function tlcourses_courses_add(){
    global $wpdb;
    $course_ids=0;
    if(isset($_GET['courseids'])){
        $course_ids = $_GET['courseids'];
    }

    $table_name=courses_tablename();
    if(isset($_GET['act']) && $_GET['act']=='addcourse'){
        $course_ids=tlcourses_courses_save();
        redirecttoCourseList();
    }
    if($course_ids!=0){
		$sql=$wpdb->prepare("SELECT * FROM $table_name WHERE course_id=%d LIMIT 1",$course_ids);
        
        $data['course_results'] = $wpdb->get_row($sql);
    }
    $data['courseid']=(Object)array('course_id'=>$course_ids);
    courses_add_view($data);
}

//save and update course
function tlcourses_courses_save(){
    global $wpdb;
    $table_name=courses_tablename();

    $data=array(
        'course_name'                        => ($_POST['course_name']),
		'course_category'					=> ($_POST['course_category']=='category1' ? 'Programming & Database' : ($_POST['course_category']=='category2' ? 'Design & Animation' : ($_POST['course_category']=='category3' ? 'DNetworking & Security' : 'Domain Applications'))),
		'course_type'						=> ($_POST['course_type']),
		'course_banner_url'					=> ($_POST['course_banner_url']),
		'large_course_banner_url' 			=> ($_POST['large_course_banner_url']),
		'level'								=> ($_POST['level'] == 'level1' ? 'Beginner' : ($_POST['level'] == 'level2' ? 'Intermediate' : 'Advanced')),
		'credit_hrs'						=> ($_POST['credit_hrs']),
		'actual_price'						=> ($_POST['actual_price']),
		'discounted_price'					=> ($_POST['discounted_price']),
		'dis_percent'						=> ($_POST['dis_percent']),
		'course_description'				=> ($_POST['course_description']),
		'instructor_name'					=> ($_POST['instructor_name']),
		'instructor_description'			=> ($_POST['instructor_description']),
		'days_info'							=> ($_POST['days_info']),
		'schedules'							=> ($_POST['schedules'])
    );
	
    if($_POST['course_id']!=0){
        $where = array('course_id'=>$_POST['course_id']);
        $wpdb->update($table_name, $data,$where);
        $course_id =$_POST['course_id'];
    }else{
        $wpdb->insert( $table_name, $data);
        $course_id = $wpdb->insert_id;
    }
    return $course_id;
}


//delete courses
function tlcourses_courses_delete(){
    global $wpdb;
    $table_name=courses_tablename();
    $delete_course_data = $_GET['course_delete'];
    $delete_course_data = explode('_',$delete_course_data);

    if(($delete_course_data[0]=='delete')){
		$sql=$wpdb->prepare("DELETE FROM $table_name WHERE course_id=%d",$delete_course_data[1]);
        $wpdb->query($sql);
    }
}

//get courses details
function get_courses_data($course_id){
    global $wpdb;
    $table_name=courses_tablename();
	$sql=$wpdb->prepare("SELECT * FROM $table_name WHERE course_id=%d LIMIT 1",$course_id);
    $result = $wpdb->get_row($sql);
    return $result;
}

?>
