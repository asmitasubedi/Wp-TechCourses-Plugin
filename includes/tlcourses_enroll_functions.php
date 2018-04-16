<?php

//redirect users
function redirecttoEnrolledList(){
    ?>
    <script>
        window.location.assign("admin.php?page=tlcourses-enrolled-list")
    </script>
    <?php
}

//save and update enrolled user details
function enrolleduser_details_save(){
    global $wpdb;
    $table_name=courses_enrolled_tablename();
	$data=array(
				//'course_id' => ($_POST['tlcourse_id']),
				//'course_name' => $_POST['tlcourse_courseName'], 
				'user_name' => $_POST['user_name'], 
				'user_email' => $_POST['user_email'], 
				'user_address' => $_POST['user_address'], 
				'user_phone' => $_POST['user_phone'],
				
				'course_enroll_status' => ($_POST['status'] == 'status1' ? 'Not Started' : ($_POST['status'] == 'status2' ? 'In Progress' : 'Completed')),
				'visible' => ($_POST['visible'] == 'visible1' ? 'Visible' : 'Invisible'),
				'remarks' => $_POST['remarks']
	);
    
        $where = array('user_id'=>$_POST['user_id']);
        $wpdb->update($table_name, $data, $where);

}

//get enrolled user's details and add to the view
function enrolleduser_details_add_view($user_id){
	global $wpdb;
	$table_name= courses_enrolled_tablename();
	$sql=$wpdb->prepare("SELECT * FROM $table_name WHERE user_id=%d LIMIT 1",$user_id);
	
    $data['results'] = $wpdb->get_row($sql);
		
	isset($data['results'])? $userobj = $data['results']: $userobj='';
	$status = $userobj->course_enroll_status;
	$visible = $userobj->visible;

?>

    <div class="wrap">
        <h2>Manage Enrolled User's Detail</h2>
        <form name="enrolled_users_form" id="enrolled_users_form" method="post" action="admin.php?page=tlcourses-enrolled-list&act=update" enctype="multipart/form-data">
            <input type="hidden" name="course_id" value="<?php echo $userobj->course_id; ?>"/>
			<input type="hidden" name="user_id" value="<?php echo $userobj->user_id; ?>"/>

					
		  <div class="stuffbox">
            <h3><label for="link_name">Quick Usage Instruction</label></h3>
            <div class="inside">
          	<p>Step 1: Enter the status for this enrolled user query. Not Started, In Progress or Completed. </p>
          	<p>Step 2: Set the visibility option. Visible or Invisible</p>
          	<p>Step 4: Save the details by clicking the "Update" button. This will populate changes in the database.</p>
          </div></div>

		  <div class="stuffbox">
            <h3><label for="link_name">Enrolled Course</label></h3>
            <div class="inside add-area">
              <table cellpadding="0">
                <tr>
                  <td class="tdlabel">Course Name</td>
                  <td>
                    <input type="text" name="course_name" id="course_name" value="<?php echo $userobj->course_name; ?>" class="tdinputa" disabled/>
                    <span class="lblhlp" >Enter a name for this course</span>
                  </td>
                </tr>
			  </table>
            </div>
          </div>
          <div class="stuffbox">
            <h3><label for="link_name">User Details</label></h3>
            <div class="inside add-area">
              <table cellpadding="0">
                <tr>
                  <td class="tdlabel">User Name</td>
                  <td>
                    <input type="text" name="user_name" id="user_name" value="<?php echo $userobj->user_name; ?>" class="tdinputa" />
                    <span class="lblhlp" >Enrolled User's name.</span>
                  </td>
                </tr>
				<tr>
                  <td class="tdlabel">User Email</td>
                  <td>
                    <input type="email" name="user_email" id="user_email" value="<?php echo $userobj->user_email; ?>" class="tdinputa" />
                    <span class="lblhlp" >Enter the user's email address.</span>
                  </td>
                </tr>
                <tr>
                  <td class="tdlabel">User Address</td>
                  <td>
                    <input type="text" name="user_address" id="user_address" value="<?php echo $userobj->user_address; ?>" class="tdinputa" />
                    <span class="lblhlp" >Enter the user's address</span>
                  </td>
                </tr>
				<tr>
                  <td class="tdlabel">User Phone Number</td>
                  <td>
                    <input type="tel" name="user_phone" id="user_phone" value="<?php echo $userobj->user_phone; ?>" class="tdinputa" />
                    <span class="lblhlp" >Enter the user's phone number</span>
                  </td>
                </tr>
				</table>
			</div>
		</div>
		<div class="stuffbox">
			<h3><label for="link_name">Query Details</label></h3>
			<div class="inside add-area">
			<table cellpadding="0">
				<tr>
                  <td class="tdlabel">Enrolled Course Status</td>
                  <td>
					<select name="status" id="status" class="tdinputa"> 
						  <option value="status1" <?php if ($status=='Not Started') echo "selected";?> > Not Started</option> 
						  <option value="status2" <?php if ($status=='In Progress') echo "selected";?> >In Progress</option>
						  <option value="status3" <?php if ($status=='Completed') echo "selected";?> >Completed</option>
					</select>
                    <span class="lblhlp" >Enter the enrolled course status.</span>
                  </td>
                </tr>
				<tr>
                  <td class="tdlabel">Visibility</td>
                  <td>
                    <select name="visible" id="visible" class="tdinputa"> 
						  <option value="visible1" <?php if ($visible=='Visible') echo "selected";?> >Visible</option> 
						  <option value="visible2" <?php if ($visible=='Invisible') echo "selected";?> >View Disable</option>
					</select>
	                <span class="lblhlp" >Enter the user's Query Visibility State</span>
                  </td>
                </tr>
				<tr>				
                  <td class="tdlabel" valign="top">Remarks</td>
                  <td >
                    <textarea name="remarks" id="remarks" class="tdinputa"><?php echo $userobj->remarks; ?></textarea>
                    <span class="lblhlp" >Enter remarks for this user query</span>
                  </td>
				</tr>
			</table>
			</div>
		</div>
			<a class="button-primary" onclick="javascript:tlcourses_enrolleddetails_save()">Update</a>
        </form>
    </div>
    <?php
}
?>