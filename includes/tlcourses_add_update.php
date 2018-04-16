<?php

function courses_add_view($data){
  $courseid = $data['courseid']->course_id;
  isset($data['course_results'])? $courseobj = $data['course_results']: $courseobj='';
    ?>

    <div class="wrap">
        <h2>Courses Add/Edit</h2>
		
        <form name="courses_form" id="courses_form" method="post" action="admin.php?page=tlcourses-courses-add&act=addcourse" enctype="multipart/form-data">
          <input type="hidden" name="course_id" value="<?php echo $courseid; ?>"/>
            <div class="stuffbox">
            <h3><label for="link_name">Quick Usage Instruction</label></h3>
            <div class="inside">
          	<p>Step 1: Enter the name and description for the courses. </p>
           	<p>Step 2: Save the details by clicking the "Save" button.</p>
           	<p>Step 3: Use the appropriate shortcode to place this course on your site.</p>
          </div></div>

		  <div class="stuffbox">
            <h3><label for="link_name">Course Basics</label></h3>
            <div class="inside add-area">
              <table cellpadding="0">
                <tr>
                  <td class="tdlabel">Course Name</td>
                  <td>
                    <input type="text" name="course_name" id="course_name" value="<?php echo $courseobj->course_name; ?>" class="tdinputa" required/>
                    <span class="lblhlp" >Enter the course name</span>
                  </td>
                </tr>
				<tr>
                  <td class="tdlabel">Course Category</td>
                  <td>
    				<select name="course_category" id="course_category" class="tdinputa" required> 
						  <option value="category1" <?php if ($courseobj->course_category=='Programming & Database') echo "selected";?> >Programming & Database</option> 
						  <option value="category2" <?php if ($courseobj->course_category=='Design & Animation') echo "selected";?> >Design & Animation</option>
						  <option value="category3" <?php if ($courseobj->course_category=='Networking & Security') echo "selected";?> >Networking & Security</option>
						  <option value="category4" <?php if ($courseobj->course_category=='Domain Applications') echo "selected";?> >Domain Applications</option>
					</select>
                    <span class="lblhlp" >Enter the course category</span>
                  </td>
                </tr>
				<tr>
                  <td class="tdlabel">Course Type</td>
                  <td>
                    <input type="text" name="course_type" id="course_type" value="<?php echo $courseobj->course_type; ?>" class="tdinputa" required/>
                    <span class="lblhlp" >Enter the course type</span>
                  </td>
                </tr>
				<tr>
                  <td class="tdlabel">Course Banner URL</td>
                  <td>
                    <input type="text" name="course_banner_url" id="course_banner_url" value="<?php echo $courseobj->course_banner_url; ?>" class="tdinputa" required/>
                    <span class="lblhlp" >Enter the Course Banner URL</span>
                  </td>
                </tr>
				<tr>
                  <td class="tdlabel">Large Course Banner URL</td>
                  <td>
                    <input type="text" name="large_course_banner_url" id="large_course_banner_url" value="<?php echo $courseobj->large_course_banner_url; ?>" class="tdinputa" required/>
                    <span class="lblhlp" >Enter the Large Course Banner URL</span>
                  </td>
                </tr>
				<tr>
                  <td class="tdlabel">Level</td>
                  <td>
					<select name="level" id="level" class="tdinputa" required> 
						  <option value="level1" <?php if ($courseobj->level=='Beginner') echo "selected";?> >Beginner</option> 
						  <option value="level2" <?php if ($courseobj->level=='Intermediate') echo "selected";?> >Intermediate</option>
						  <option value="level3" <?php if ($courseobj->level=='Advanced') echo "selected";?> >Advanced</option>
					</select>
                    <span class="lblhlp" >Enter the course level</span>
                  </td>
                </tr>
				</table>
			</div>
		</div>
		
		
		<div class="stuffbox">
            <h3><label for="link_name">Course Details</label></h3>
            <div class="inside add-area">
              <table cellpadding="0">
				<tr>
                  <td class="tdlabel">Credit Hours</td>
                  <td>
                    <input type="text" name="credit_hrs" id="credit_hrs" value="<?php echo $courseobj->credit_hrs; ?>" class="tdinputa" required/>
                    <span class="lblhlp" >Enter the total credit hours for this course</span>
                  </td>
                </tr>
				<tr>
                  <td class="tdlabel">Actual Price</td>
                  <td>
                    <input type="text" name="actual_price" id="actual_price" value="<?php echo $courseobj->actual_price; ?>" class="tdinputa" required/>
                    <span class="lblhlp" >Enter the actual price for the course</span>
                  </td>
                </tr>
				<tr>
                  <td class="tdlabel">Discounted Price</td>
                  <td>
                    <input type="text" name="discounted_price" id="discounted_price" value="<?php echo $courseobj->discounted_price; ?>" class="tdinputa" required/>
                    <span class="lblhlp" >Enter the discounted price for the course</span>
                  </td>
                </tr>
				<tr>
                  <td class="tdlabel">Discount Percent</td>
                  <td>
                    <input type="text" name="dis_percent" id="dis_percent" value="<?php echo $courseobj->dis_percent; ?>" class="tdinputa" required/>
                    <span class="lblhlp" >Enter the discount percentage for the course</span>
                  </td>
                </tr>
                <tr>
                  <td class="tdlabel" valign="top">Course Description</td>
                  <td >
                    <textarea name="course_description" class="tdinputa" required><?php echo $courseobj->course_description; ?></textarea>
                    <span class="lblhlp" >Enter the description for this course</span>
                  </td>
				</tr>
				</table>
			</div>
		</div>
		
		
		<div class="stuffbox">
			<h3><label for="link_name">Instructor Details</label></h3>
			<div class="inside add-area">
				<table cellpadding="0">
				<tr>
                  <td class="tdlabel">Instructor Name</td>
                  <td>
                    <input type="text" name="instructor_name" id="instructor_name" value="<?php echo $courseobj->instructor_name; ?>" class="tdinputa" />
                    <span class="lblhlp" >Enter the instructor for this course</span>
                  </td>
                </tr>
				<tr>
                  <td class="tdlabel" valign="top">Instructor Description</td>
                  <td >
                    <textarea name="instructor_description" class="tdinputa"><?php echo $courseobj->instructor_description; ?></textarea>
                    <span class="lblhlp" >Enter the description of the instructor</span>
                  </td>
				</tr>			
				</table>
			</div>
		</div>
		
		
		<div class="stuffbox">
			<h3><label for="link_name">Course Schedule</label></h3>
			<div class="inside add-area">
				<table cellpadding="0">
				<tr>
                  <td class="tdlabel">Days Info</td>
                  <td>
                    <input type="text" name="days_info" id="days_info" value="<?php echo $courseobj->days_info; ?>" class="tdinputa" />
                    <span class="lblhlp" >Enter the class days for this course separated by comma</span>
                  </td>
                </tr>
				<tr>
                  <td class="tdlabel">Schedule</td>
                  <td>
                    <input type="text" name="schedules" id="schedules" value="<?php echo $courseobj->schedules; ?>" class="tdinputa" />
                    <span class="lblhlp" >Enter the schedules for this course separated by comma</span>
                  </td>
                </tr>
              </table>
            </div>
        </div>

          	<a class="button-primary" onclick="javascript:tlcourses_courses_save()">Save</a>
        </form>
    </div>
    <?php
}
?>