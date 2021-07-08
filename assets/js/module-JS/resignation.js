$(document).ready(function(){


	$('#add_resignation').on('click', function(e){
		e.preventDefault();
		$('#temp_alert').remove();
		var user_id = $('#user_id').val()
		var str = '';

		var form = $(this).closest('form'); 
	    var error = validateFormAjax(form.attr('id'));

	    if(error == 0)
	    {
			if($('#tnc').prop('checked') && user_id)
			{
				var reason = $('#textarea').val();
				$.ajax({
				  url: 'modules/resignation/resignation_ajax.php',
				  method: 'POST',
				  dataType: 'json',
				  data: {
				  	employee: user_id,
				  	mode: 'add_resignation',
				  	reason: reason
				  },
				  success: function(result){
				  	if(result)
				  	{ 
				  		window.location.reload();
				  	}
				  	else
				  	{
				  		str += '<div class="alert alert-danger" id="temp_alert">';
				  		str += 'We could not process the request. Please try again or contact HR';
				  		str += '</div>'; 
				  	}
					$('#alert_prepend').prepend(str);
				  }
				 });
			}
			else
			{	
				str += '<div class="alert alert-danger" id="temp_alert">';
				str += 'Please accept terms and condtions before applying for resignation.';
				str += '</div>'; 
				$('#alert_prepend').prepend(str);
			}
	    }
	});


	var table = $('#resignation_list').DataTable({
		   "ajax": {
		     url: 'modules/resignation/resignation_ajax.php',
		     type: 'POST',
		     data: {
		       mode: 'get_applied_resignation'
		     }
		   },
		   responsive: true,
		   "columns": [
		   {'title': 'ID', 'name': 'ID', "data": "id", "width": '5%', "class": 'all compact' },
		   {'title': 'Resignation ID', 'name': 'resid', 'data': 'resid', 'width': '10%', "class": 'all compact'},
		   {'title': 'Name', 'name': 'name', "data": "null", "width": '15%', "class": 'all compact',
		   render: function(data, type, row, meta){
		   	return row['f_name']+' '+row['l_name'];
		   	  }},
		   {'title': 'Mobile' , 'name': 'mobile', "data": "mobile", "width": '10%', "class": 'all compact'},
		   {'title': 'Email' , 'name': 'email', "data": "email", "width": '10%', "class": 'all compact'},
		   {'title': 'Resignation Date & Time', 'name': 'resdate', 'data': 'resdate', 'width': '20%', "class": 'all compact'},
		   {'title': 'Reason', 'name': 'reason', 'data': 'reason', 'width': '10%', "class": 'none compact'},
		   {'title': 'Action' , 'name': 'Action', "sortable": false, "data": null, "width" : "15%", "class": 'all compact',
		     render: function(data, type, row, meta)
		     {
			      var str ='';	
	              str += '<button class="btn btn-danger btn-sm m-1 change_status" data-type="0" title="Reject"><i class="fa fa-ban" aria-hidden="true"></i></button></td>';
	              str += '<button class="btn btn-success btn-sm m-1 change_status" data-type="1" title="Accept"><i class="fa fa-check" aria-hidden="true"></i></button></td>';
				  return str;
		     }
		   }      
		   ]
		});		


	$(document).on('click', '.change_status', function(){
		var row = table.row($(this).parents('tr')).data();
		var type = $(this).data('type');
		$.ajax({
			url: 'modules/resignation/resignation_ajax.php',
			method: 'post',
			dataType: 'json',
			data: {
				type: type,
				id: row['id'],
				resid: row['resid'],
				mode: 'accept_reject_resignation'
			},
			success: function(result)
			{
				var str = '';
				if(result)
				{
					if(result['operation'] == 1)
					{
						str += '<div class="alert alert-success" id="alert">';
						str += 'Resignation is Successfully Rejected';
						str += '</div>';
					}
					else if(result['operation'] == 2)
					{
						str += '<div class="alert alert-success" id="alert">';
						str += 'Resignation is Successfully Accepted';
						str += '</div>';
					}
				}
				else
				{
				  str += '<div class="alert alert-danger" id="alert">';
				  str += 'There was some error! Please Try again Later.';
				  str += '</div>';
				}

				table.ajax.reload();
				scroll_to_top();
				$('#table_holder').prepend(str);
				hidealert(3);
			}
		});
	});

});