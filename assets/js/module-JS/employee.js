$(document).ready(function(){

	var table;
	
	/*Starts Add Employee*/
	$('#add_employee').on('click', function(e){
	  e.preventDefault();
	  var form = $(this).closest('form');
	  var operation = $(this).data('operation');
	  
	  var error = validateFormAjax(form.attr('id'));
	  if(error == 0)
	  {
		var sucessmsg = '';
	    var input = form.serializeArray(); 
	    if(operation == 'save')
	    {
		    input.push({name: "mode", value: "add_employee"});	
		    sucessmsg = 'Employee Successfully Added.'; 	
	    }
	    else if(operation == 'update')
	    {
	    	input.push({name: "mode", value: "submit_update"});
	    	sucessmsg = 'Employee Successfully Updated.'; 
	    }

	    $.ajax({
	      url: 'modules/employee/employee_ajax.php',
	      method: 'POST',
	      dataType: 'json',
	      data: input,
	      success: function(result){
	        var str = '';
	        if(result == true)
	        {
	          str += '<div class="alert alert-success" id="alert">';
	          str += sucessmsg;
	          str += '</div>';
	        }
	        else
	        {
	          str += '<div class="alert alert-danger" id="alert">';
	          str += 'There was some error! Please Try again Later.';
	          str += '</div>';
	        }

	        scroll_to_top();
	        form.prepend(str);
	        hidealert(3);
	      }
	    });  
	  }
	});
	/*Ends Add Employee*/


	$('#employee_type').on('change', function(){
		$('#table_holder').html('<table class="table" id="employee_list"></table>');
		var value = $(this).val();
		create_datatable(value);
	});

	function create_datatable(type)
	{
		table = $('#employee_list').DataTable({
		   "ajax": {
		     url: 'modules/employee/employee_ajax.php',
		     type: 'POST',
		     data: {
		       mode: 'get_employee',
		       type: type
		     }
		   },
		   "columns": [
		   {'title': 'ID', 'name': 'ID', "data": "id", "width": '5%' },
		   {'title': 'Name', 'name': 'name', "data": "null", "width": '10%',
		   render: function(data, type, row, meta){
		   	return row['f_name']+' '+row['l_name'];
		   	  }},
		   {'title': 'Father\'s Name', 'name': 'fathers_name', "data": "fathers_name", "width": '18%' },
		   {'title': 'Mother\'s Name', 'name': 'mothers_name', "data": "mothers_name", "width": '18%' },
		   {'title': 'DOB', 'name': 'dob', "data": "null", "width": '10%',
		   	render: function(data, type, row, meta){
		   		var dob = 'empty';
		   		if(row['dob'] != '0000-00-00')
		   		{
		   			var date = new Date(row['dob']);
		   			dob = date.getDate()+'-'+date.getMonth()+'-'+date.getFullYear();
		   		}
		   		return dob;
		   	 }
		   },
		   {'title': 'Mobile' , 'name': 'mobile', "data": "mobile", "width": '10%' },
		   {'title': 'Email' , 'name': 'email', "data": "email", "width": '10%' },
		   {'title': 'Action' , 'name': 'Action', "sortable": false, "data": null, "width" : "20%",
		     render: function(data, type, row, meta)
		     {
		       var str ='';
		       str += '<button data-id="'+row['id']+'"  class="btn btn-info btn-sm m-1 view_employee" title="View"><i class="fa fa-eye" aria-hidden="true"></i></button>';
	            if(row['status'] == 1)
	            {
	              str += '<button data-id="'+row['id']+'"  class="btn btn-primary btn-sm m-1 update_emp" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
	              str += '<button class="btn btn-danger btn-sm m-1 change_status" title="Deactivate"><i class="fa fa-ban" aria-hidden="true"></i></button></td>';
	            }
	            else
	            {
	              str += '<button class="btn btn-success btn-sm m-1 change_status" title="Activate"><i class="fa fa-check" aria-hidden="true"></i></button></td>';
	            }

	            return str;
		     }
		   }      
		   ]
		});		
	}
	
	$(document).on('click', '.view_employee', function(){
		var row = table.row($(this).parents('tr')).data(); 
		$.ajax({
			url: 'modules/employee/employee_ajax.php',
			method: 'post',
			dataType: 'json',
			data: {
				id: row['id'],
				mode: 'view'
			},
			success: function(result){
				if(result)
				{				
					var day, month, year, status;
					if(validDate(result['dob']))
					{
						var date = new Date(result['dob']);
						day = date.getDate();
						if(day < 10)
						{
							day = '0' + day;
						}
						month = date.getMonth()+1;
						if(month < 10)
						{
							month = '0' + month;
						}
						year = date.getFullYear();
					}
					else
					{
						day = '00';
						month = '00';
						year = '0000';

					}

					if(result['status'] == 1)
					{
						status = 'Active';
					}
					else
					{
						status = 'InActive';
					}

					var modal = '';
					modal += '<div id="view_employee_modal" class="modal fade" role="dialog">';
						modal += '<div class="modal-dialog">';
						modal += 'Modal content';
						modal += '<div class="modal-content">';
						modal += '<div class="modal-header">';
						modal += '<h4 class="modal-title">'+result['f_name']+' '+result['l_name']+'</h4>';
						modal += '<button type="button" class="close" data-dismiss="modal">&times;</button>';
						modal += '</div>';
						modal += '<div class="modal-body">';
						if(result['error'] == 0)
						{
							modal += '<p><b>Emp ID  :</b>   '+result['id']+'</p>';
							modal += '<p><b>Full Name  :</b>   '+result['f_name']+' '+result['l_name']+'</p>';
							modal += '<p><b>Father\'s Name  :</b>   '+result['fathers_name']+'</p>';
							modal += '<p><b>Mother\'s Name  :</b>   '+result['mothers_name']+'</p>';
							modal += '<p><b>Gender  :</b>   '+result['gender']+'</p>';
							modal += '<p><b>Date of Brith  :</b>   '+day+'-'+month+'-'+year+'</p>';
							modal += '<p><b>Marital Status  :</b>   '+result['marital_status']+'</p>';
							modal += '<p><b>Nationality  :</b>   '+result['nationality']+'</p>';
							modal += '<p><b>Disability  :</b>   '+result['disability']+'</p>';
							modal += '<p><b>Blood Group  :</b>   '+result['blood_group']+'</p>';
							modal += '<p><b>Communication Address  :</b>   '+result['comm_address']+'</p>';
							modal += '<p><b>Permanent Address  :</b>   '+result['perm_address']+'</p>';
							modal += '<p><b>Email  :</b>   '+result['email']+'</p>';
							modal += '<p><b>Mobile  :</b>   '+result['mobile']+'</p>';
							modal += '<p><b>Department  :</b>   '+result['d_name']+'</p>';
							modal += '<p><b>Designation  :</b>   '+result['designation']+'</p>';
							modal += '<p><b>Joining Date  :</b>   '+result['joining_date']+'</p>';
							modal += '<p><b>Status  :</b>   '+status+'</p>';
						}
						else
						{
							modal += '<p>No Record Found.</p>';  								
						}
						modal += '</div>';
						modal += '<div class="modal-footer">';
						modal += '<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>';
						modal += '</div>';
						modal += '</div>';
						modal += '</div>';
						modal += '</div>';

						$('body').append(modal);
						$('#view_employee_modal').on('hidden.bs.modal', function(){
							$('#view_employee_modal').remove();
							table.ajax.reload();
						});
						$('#view_employee_modal').modal('show');
				}
			}

		});
	});

	$(document).on('click', '.change_status', function(){
		var row = table.row($(this).parents('tr')).data();

		$.ajax({
			url: 'modules/employee/employee_ajax.php',
			method: 'post',
			data: {
				id: row['id'],
				mode: 'change',
				status: row['status']
			},
			success: function(result)
			{
				table.ajax.reload();
			}
		});
	});

	$(document).on('click', '.update_emp', function(){
		var row = table.row($(this).parents('tr')).data();
		row['mode'] = 'update';
		redirect_post('employee_registration.php', row);
	});

});