jQuery(document).ready(function($){
    $('#CourseTable').DataTable();
});

function tlcourses_courses_save(){
  var course_name = $('#course_name').val();
  //var credit_hr = $('#credit_hrs').val();
  //var btn_price = $('#btn_price').val();
  if(course_name==''){
	  alert('Please enter the Course Name');
	  $('#course_name').focus();
	}
  /*else if(btn_text==''){
	  alert('Please enter the Button Text');
	  $('#btn_text').focus();
  }
  else if(btn_price==''){
	  alert('Please enter the Price');
	  $('#btn_price').focus();
  }*/
  else{
	  $('#courses_form').submit();
  }
}

function tlcourses_enrolleddetails_save(){
	  $('#enrolled_users_form').submit();
}

jQuery(document).ready(function($){
    $('#EnrolledUsersTable').DataTable();
});

