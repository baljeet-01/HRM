$(document).ready(function(){


	$('#change_password').on('click', function(e){
		e.preventDefault();
		$('#message_for_confirmpassword').attr('msg', 'This Field is Required');


		var form = $(this).closest('form'); 
	    var error = validateFormAjax(form.attr('id'));
	    
	    var oldpassword = $('#oldpassword').val();
	    var password = $('#newpassword').val();
	    var confirmpassword = $('#confirmpassword').val();
	    if(password != confirmpassword && confirmpassword != "" && oldpassword != "")
	    {
	    	$('#confirmpassword').val("")
	    	$('#message_for_confirmpassword').attr('msg', 'Confirm Password does not Match');
	    	var error = validateFormAjax(form.attr('id'));
	    }
		
		if(error == 0)
		{
			$.ajax({
			  url: 'modules/profile/profile_ajax.php',
			  method: 'POST',
			  dataType: 'json',
			  data: {
			  	mode: 'change_password',
			  	oldpassword: oldpassword,
			  	newpassword: password,
			  	confirmpassword: confirmpassword
			  },
			  success: function(result){

			  	var str = '';

		  		if(result['error'] == 0)
		  		{
			  	  str += '<div class="alert alert-success" id="alert">';
			  	  str += 'Password Changed Successfully';
			  	  str += '</div>';			  			
		  		}
		  		else if(result['error'] == 1)
		  		{
		  			str += '<div class="alert alert-danger" id="alert">';
		  			str += 'Please Enter Correct Password';
		  			str += '</div>';
		  		}
		  		else if(result['error'] == 2)
		  		{
		  			str += '<div class="alert alert-danger" id="alert">';
		  			str += 'Something Went Wrong';
		  			str += '</div>';
		  		}

			  	scroll_to_top();
			  	form.prepend(str);
			  	form.trigger('reset');
			  	hidealert(3);

			  }
			});
		}
	});

});