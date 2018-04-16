<?php

function tlcourses_courses_list(){
global $wpdb;
$table_name= courses_tablename();

if(isset($_GET['course_delete'])){
	tlcourses_courses_delete();
	redirecttoCourseList();
}

$sql = "SELECT * FROM $table_name";
$course_list = $wpdb->get_results($sql);

echo '<div class="wrap">';
echo '<h2>Courses List</h2>';
echo '<a class="button-primary" href="admin.php?page=tlcourses-courses-add"><strong>Add New Course</strong></a>';
?>
 <table  id="CourseTable" class="display" cellspacing="0" width="100%">
    <thead>
      <tr>
		<th>Course Banner</th>
        <th>Course Name</th>
        <th>Course Description</th>
		<th>Instructor Name</th>
		<th>Schedule</th>
		<th>Discounted Price</th>
        <th>Shortcode</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
		<th>Course Banner</th>
        <th>Course Name</th>
        <th>Course Description</th>
		<th>Instructor Name</th>
		<th>Schedule</th>
		<th>Discounted Price</th>
        <th>Shortcode</th>
        <th>Actions</th>
      </tr>
    </tfoot>
    <tbody>
    <?php
      foreach ($course_list as $course){
        
		echo '<td><img src='.$course->course_banner_url.' alt="Course Banner" width="100%" height="50%"></td>';
		echo '<td>'.$course->course_name.'</td>';
		echo '<td>'.$course->course_description.'</td>';
		echo '<td>'.$course->instructor_name.'</td>';
		echo '<td>'.$course->days_info.'<br/>'.$course->schedules.'</td>';
		echo '<td>'.$course->discounted_price.'</td>';
		echo '<td>[tlcourses ids="'.$course->course_id.'"]</td>';
        echo '<td><a href="admin.php?page=tlcourses-courses-add&courseids='.$course->course_id.'">Edit</a> | <a href="admin.php?page=tlcourses-courses-list&course_delete=delete_'.$course->course_id.'" onclick="return  confirm(\'Do you want to delete Y/N?\')">Delete</a></td>';
        echo '</tr>';
      }
    ?>
    </tbody>
  </table>
  <?php
  echo '</div><!--wrap-->';
}
?>