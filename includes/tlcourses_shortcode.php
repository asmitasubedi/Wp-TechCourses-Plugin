<?php

if (!is_admin())
{
   add_filter('widget_text', 'do_shortcode');
}
add_shortcode('tlcourses', 'tlcourses_shortcode');

//tlcourses shortcode
function tlcourses_shortcode($atts){
    global $wpdb;
	$result = '';
    $course_id = $atts['ids'];

    $course_data = get_courses_data($course_id);
	
	$debug_marker = "<!-- TL Courses Plugin-->";
	$result .= "\n".$debug_marker."\n";
  
	  $result .='<div class="wrap" style="height:317px; width:242px">';
	  $result .='<div class="course-item" style="background: rgb(247, 247, 247) none repeat scroll 0% 0%; width:222px; height: 297px;">';
	  $result .='<div class="course-discount" style="background: #ffd300; color: #000000" width="50%"> '.$course_data->dis_percent.' OFF </div>' ;

	  $result .='<div class="course-image" style="width: 100%">';
	  $result .='<img alt="'.$course_data->course_name.'" src="'.$course_data->course_banner_url.'" width="222px" height="167px"></a>';
	  $result .='</div>';
	  
	  $result .='<a class="course-buy" href="#tlCourse-openModal"><div type="button" class="courses-enroll-now" data-course-id="'.$course_data->course_id.'" data-course-name="'.$course_data->course_name.'" data-course-description="'.$course_data->course_description.'" 
			data-banner-url="'.$course_data->course_banner_url.'" data-banner-url-large="'.$course_data->large_course_banner_url.'">'.
	  			'<span class="course-enroll" style="background: green; color: white;">ENROLL NOW</span>' . '</div></a>';
			
	   $result .='<div class="course-price">';
	   $result .='<del><span class="course-price-original">'.$course_data->actual_price.'</span> </del>  <span>'.$course_data->discounted_price.'</span> </div>';

	  $result .='<div class="course-title" style="font-size:20px; width:100%">';
	 
	  $result .='<span class="course-name-span">'.$course_data->course_name.'</span>';

	$result .='</div>';
	$result .='</div>';
	$result .='</div>';	
	
	$result .='<div id="tlCourse-openModal" class="tlCourse-modalDialog">
			<div><a href="#tlCourse-close" title="Close" class="tlCourse-close">X</a>

				<div id="tlcourse-course-title"><p><span id="tlcourse-title"> </span> </p></div>

		<table>
  		<tr>
			
			<td>
			
			<div id="tlcourse-banner-url">
				
				<img id="banner" alt="Course Banner" width="50%" height="50%"> 
			</div>
			
			</td>
			
			<td><div id="tlcourse-main-form">
				<form id="tlcourseForm" name="enrollform" method="post" enctype="text/plain">

					<div class="tlcourse-form-field"> <label for="tlcourse-field-name">Name</label> <input id="tlcourse-field-name-input" type="text" required="required" minlength="3" maxlength="50" placeholder="Enter your full name" name="name"></div>
					
					<div class="tlcourse-form-field"> <label for="tlcourse-field-email">Email</label> <input id="tlcourse-field-name-input" type="email" required="required" placeholder="Enter your email address" name="email"></div>

					<div class="tlcourse-form-field"> <label for="tlcourse-field-location">Location</label> <input id="tlcourse-field-name-input" type="text" required="required" minlength="3" maxlength="50" placeholder="Enter your address (address and city)" name="location"></div>

					<div class="tlcourse-form-field"> <label for="tlcourse-field-contact">Phone</label> <input id="tlcourse-field-name-input" type="tel" required="required" minlength="7" maxlength="15" placeholder="Enter your phone number (9813XXXXXX or 01-44XXXXX)" name="phone"></div>

					<div id="tlcourse-sumit-div">
						<div id="tlcourse-sumbit">
							<input  type="button" value="Submit">
						</div>
					</div>

				</form>

				<div id="tlcourse-text">We value your privacy. Your details are secure with us.</div>
				
			</div></td>
			
			</tr>
		</table>
		</div>
	</div>
	
		<div id="tlCourse-openSuccessDialog" class="tlCourse-successDialog">
				<div id="tlcourse-success-internal">
					<a href="#tlCourse-close" title="Close" class="tlCourse-close">X</a>

					<div id="tlcourse-success-box">
						<div id="tlcourse-title"><p>Query received successfully!</p></div>

						<div id="tlcourse-main-form">
							<h3>We will call you shortly to provide more details.</h3>
							<h4>Have a good day!</h4>
						</div>
					</div>

				</div>
		</div>';
	
    return $result;
}

?>
