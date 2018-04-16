var tlcourse_id, tlcourse_courseName;
	jQuery(document).ready(function($)
		{
			//global url
			$url= window.location.href;
			console.log($url);
			//alert("hii");

			$(".courses-enroll-now").click(function()
			{
					//set data to variable name
					tlcourse_id = $(this).data("course-id");
					tlcourse_courseName = $(this).data("course-name");
					//alert(tlcourse_courseName);
				var	tlcourse_bannerURL = $(this).data("banner-url-large");
				
					//put Course name on popup title
					$('#tlcourse-title').html(tlcourse_courseName);
					//$('#tlcourse-banner').html(tlcourse_bannerURL);
					document.getElementsById("banner").src = tlcourse_bannerURL;
					
									
			});
			
			//submit button action
		$("#tlcourse-sumbit").click(function(){
			FormObject = document.forms['tlcourseForm'];
			var name = FormObject.elements["name"].value;
			var email = FormObject.elements["email"].value;
			var location = FormObject.elements["location"].value;
			var phone = FormObject.elements["phone"].value;
			
			var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
			
			function isAlphabetic(val)
			{
				if (val.match(/^[a-z A-Z]+$/))
				{
					return true;
				}
				else
				{
					return false;
				}	
			}
			
			//if empty throw error
			if(name == "" || email == "" || location == "" || phone ==""){
				alert("Please, fill up all the fields.");
			}
			else if (!isAlphabetic(name)|| name.length < 3 || name.length > 50) {
				alert("Please enter a valid name");
				$("#name").focus();
			}
			else if (!emailPattern.test(email)){
				alert("Please enter a valid email");
			}
			else if (!isAlphabetic(location)|| location.length < 3 || location.length > 50) {
				alert("Please enter valid location.");
				$('#location').focus();
			}
			else if (isNaN(phone) || phone.length < 7 || phone.length > 15) {
				alert("Please enter a valid phone number");
				$('#phone').focus();
			} 
			
			//on success
			else {
				//client side ajax script	
				var $j = jQuery.noConflict();
				console.log(tlcourse_courseName);
				$j.post(tlcourse.course_ajax_url, {         							//POST request
          				 _ajax_nonce: tlcourse.course_nonce,     							//nonce
           				 action: "save_to_enrolled_db",           						 //action
							tlcourse_id : tlcourse_id,
							tlcourse_courseName : tlcourse_courseName,				//data
							user_name : name, 
							user_email : email,
							user_location : location, 
							user_phone :  phone},       		
   					 	function(response) {                    				//callback
						console.log(response);
        		});
				//cleaning the $url
				$url=window.location.origin+window.location.pathname;
				window.location = $url+'#tlCourse-openSuccessDialog';
			}
			console.log("Name: " + name + " Location: " + location + " Phone: "+ phone);
		});
		
		
			$(".tlCourse-close").click(function(){
			console.log(window.location.origin+window.location.pathname);
			//cleaning the $url
			$url=window.location.origin+window.location.pathname;
		});
		
	});
	
	
