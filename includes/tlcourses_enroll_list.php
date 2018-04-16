<?php

//list enrolled users information(view enabled) in a table
function tlcourses_enrolled_list(){
global $wpdb;
$table_name= courses_enrolled_tablename();

$sql = "SELECT * FROM $table_name WHERE visible='Visible'";
//$sql = "SELECT * FROM $table_name";
$users_list = $wpdb->get_results($sql);

echo '<div class="wrap">';
echo '<h2>Enrolled Users List</h2>';

?>
 <table  id="EnrolledUsersTable" class="display" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Course Name</th>
        <th>User Name</th>
		<th>Email</th>
		<th>Address</th>
		<th>Phone</th>
        <th>Status</th>
        <th>Enrolled Date</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Course Name</th>
        <th>User Name</th>
		<th>Email</th>
		<th>Address</th>
		<th>Phone</th>
        <th>Status</th>
        <th>Enrolled Date</th>
      </tr>
    </tfoot>
    <tbody>
    <?php
      foreach ($users_list as $user){
        
        echo '<td><a class="button-primary" href="admin.php?page=tlcourses-courses-add&courseids='.$user->course_id.'"><strong>'.$user->course_name.'</strong></a></td>';
        echo '<td><a href="admin.php?page=tlcourses-enrolled-list&userid='.$user->user_id.'"><strong>'.$user->user_name.'</strong></a></td>';
       	echo '<td>'.$user->user_email.'</td>';
		echo '<td>'.$user->user_address.'</td>';
		echo '<td>'.$user->user_phone.'</td>';
		echo '<td><div class="tooltip">'.$user->course_enroll_status.'<span class="tooltiptext">'.$user->remarks.'</span></div></td>';
        echo '<td>'.$user->enrolled_date.'</td>';
        echo '</tr>';
      }
    ?>
    </tbody>
  </table>
  <?php
  echo '</div><!--wrap-->';
  
  //get user's details and add to the view
  if(isset($_GET['userid'])){
	$user_id = $_GET['userid'];
	enrolleduser_details_add_view($user_id);
  }

  //update and save user details
	if(isset($_GET['act']) && $_GET['act']=='update'){
        enrolleduser_details_save();
        redirecttoEnrolledList();
	}
}
?>