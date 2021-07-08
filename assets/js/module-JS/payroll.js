$(document).ready(function(){	

	
	$('#emp_id').on('change', function(){

		$('#emp_name').val('');
		$('#department').val('');
		$('#designation').val('');


		var id = $(this).val();

		if(id != '')
		{
			$.ajax({
				url: 'modules/employee/employee_ajax.php',
				method: 'post',
				dataType: 'json',
				data: {
					id: id,
					mode: 'view'
				},
				success: function(result){
					$('#emp_name').val(result['f_name']+' '+result['l_name']);
					$('#department').val(result['d_name']);
					$('#designation').val(result['designation']);
				}
			});	
		}
	});
	
	$('#emp_id_modify').on('change', function(){
		
		$('#emp_name').val('');
		$('#department').val('');
		$('#designation').val('');
		$('#basic_pay').val('');
		$('#deductions').val('');


		var id = $(this).val();

		if(id != '')
		{
			$.ajax({
				url: 'modules/payroll/payroll_ajax.php',
				method: 'post',
				dataType: 'json',
				data: {
					id: id,
					mode: 'get_paydetails'
				},
				success: function(result){
					console.log(result);
					$('#emp_name').val(result['f_name']+' '+result['l_name']);
					$('#department').val(result['d_name']);
					$('#designation').val(result['designation']);
					$('#basic_pay').val(result['basic_pay']);
					$('#deductions').val(result['deductions']);
					$('#payroll_id').val(result['pay_id']);
				}
			});	
		}
	});

	$('#add_payroll').on('click', function(e){
	    e.preventDefault();
	    var form = $(this).closest('form'); 
	    var error = validateFormAjax(form.attr('id'));
	    if(error == 0)
	    {
	      var input = form.serializeArray(); 
	      input.push({name: "mode", value: "add_payroll"});

	      $.ajax({
	        url: 'modules/payroll/payroll_ajax.php',
	        method: 'POST',
	        dataType: 'json',
	        data: input,
	        success: function(result){
	          var str = '';
	          if(result == true)
	          {
	            str += '<div class="alert alert-success" id="alert">';
	            str += 'Payroll Successfully Added.';
	            str += '</div>';
	            page_reload(3);
	          }
	          else
	          {
	            str += '<div class="alert alert-danger" id="alert">';
	            str += 'There was some error! Please Try again Later.';
	            str += '</div>';
	          }
	      		form.prepend(str);
	        	hidealert(3);
	   		}
     		});  
    	}
 	});

	$('#update_payroll').on('click', function(e){
	    e.preventDefault();
	    var form = $(this).closest('form'); 
	    var error = validateFormAjax(form.attr('id'));
	    if(error == 0)
	    {
	      var input = form.serializeArray(); 
	      input.push({name: "mode", value: "udpate_payroll"});

	      $.ajax({
	        url: 'modules/payroll/payroll_ajax.php',
	        method: 'POST',
	        dataType: 'json',
	        data: input,
	        success: function(result){
	          var str = '';
	          if(result == true)
	          {
	            str += '<div class="alert alert-success" id="alert">';
	            str += 'Payroll Updated Successfully.';
	            str += '</div>';
	            form.trigger('reset');
	          }
	          else
	          {
	            str += '<div class="alert alert-danger" id="alert">';
	            str += 'There was some error! Please Try again Later.';
	            str += '</div>';
	          }
	      		form.prepend(str);
	        	hidealert(3);
	   		}
     		});  
    	}
 	});	
});