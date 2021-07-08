$(document).ready(function(){	

	var table;
	/*Start - Dont let Leaves to be Negative*/
	$(document).on('focusout mouseup', '.leaves-number', function(){
		var positive = new RegExp(/^[1-9]d*$/g);
		if(positive.test($(this).val()) == false)
		{
			$(this).val(0)
		}
	});
	/*End - Dont let Leaves to be Negative*/

	/*Start - Department select change function*/

	$('#department').on('change', function(){
		$('#designation_holder').html('');
		var id = $(this).val();
		if(id != '')
		{
			$.ajax({
				url: 'modules/leaves/leaves_ajax.php',
				method: 'post',
				dataType: 'json',
				data: {
					id: id,
					mode: 'load_designations'
				},
				success: function(result){
					var str = '';
					str += '<label for="designation" class="col-sm-6 col-form-label">Designation</label>';
					str += '<select type="text" class="form-control" name="designation" id="designation" validate="true">';
					str += '<option value = "">Select Designation</option>'; 
					$.each(result, function(key, value){
						str += '<option value = '+value['id']+'>'+value['name']+'</option>';                     
					});
					str += '</select>';
					str += '<div id="message_for_designation" class="validation-error-message" msg="Designation is Required"></div>';
					console.log(str);
					$('#designation_holder').html(str);					
				}
			});	
		}
	});

	/*End - Department select change function*/

	/*Start Add Leaves Submit AJAX*/

	$('#add_leaves').on('click', function(e){
	  e.preventDefault();
	  var form = $(this).closest('form');    
	  var error = validateFormAjax(form.attr('id'));
	  if(error == 0)
	  {
	    var input = form.serializeArray(); 
	    input.push({name: "mode", value: "add_leaves"});

	    $.ajax({
	      url: 'modules/leaves/leaves_ajax.php',
	      method: 'POST',
	      dataType: 'json',
	      data: input,
	      success: function(result){
	        var str = '';
	        console.log(result);
	        if(result)
	        {
	          str += '<div class="alert alert-success" id="alert">';
	          str += 'Leaves are Successfully Added.';
	          str += '</div>';
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
	/*Ends Add Leaves Submit AJAX*/


	/*change department on view page Starts*/
	$('#view_department').on('change',function(){
		$('#table_holder').html('');

		var value = $(this).val();
		if(value != '')
		{
			$('#table_holder').html('<table class="table" id="leaves_table" style="width:100%"> </table>');

			table = $('#leaves_table').DataTable({
			   "ajax": {
			     url: 'modules/leaves/leaves_ajax.php',
			     type: 'POST',
			     data: {
			     	id: value,
			       mode: 'list_leaves_datatable'
			     }
			   },
			   "columns": [
			   {'title': 'Designation', 'name': 'designation', "data": "designation"},		   
			   {'title': 'Sick Leaves', 'name': 'sick_leave', "data": "sick_leave"},
			   {'title': 'Holiday', 'name': 'holiday', "data": "holiday"},
			   {'title': 'Vacation' , 'name': 'vacation', "data": "vacation"},
		   	   {'title': 'Action' , 'name': 'Action', "sortable": false,
		   	     render: function(data, type, row, meta)
		   	     {
		   	       var str ='';
		   	       if(row['status'] == 1)
	               {
	                 str += '<button class="btn btn-primary btn-sm m-1 update_leaves" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
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
		else
		{
			$('#table_holder').html('');

		}

	});
	/*change department on view page Ends*/


	/*Ajax for Change Status Starts*/

	$(document).on('click', '.change_status', function(){
		var row = table.row($(this).parents('tr')).data();

		$.ajax({
			url: 'modules/leaves/leaves_ajax.php',
			method: 'post',
			data: {
				id: row['id'],
				mode: 'change_status',
				status: row['status']
			},
			success: function(result)
			{
				table.ajax.reload();
			}
		});
	});

	/*Ajax for Change Status Starts*/


	/* Starts View Leaves to update */

	  $(document).on('click', '.update_leaves', function(){
	    
	    var row = table.row($(this).parents('tr')).data();

	    $.ajax({
	      url: 'modules/leaves/leaves_ajax.php',
	      method: 'post',
	      dataType: 'json',
	      data: {
	        id: row['id'],
	        mode: 'find_leaves_with_id'
	      },
	      success: function(result){
	        var modal = '';

	        if(result)
	        {
	          var start = new Date(result['start']);
	          var end = new Date(result['end']);
	          result['start'] = start.getDate()+'-'+start.getMonth()+'-'+start.getFullYear();
	          result['end'] = end.getDate()+'-'+end.getMonth()+'-'+end.getFullYear();


	          var modal = '';
	          modal += '<div id="update_leaves_modal" class="modal fade" role="dialog">';
	          modal += '<div class="modal-dialog">';
	          modal += 'Modal content';
	          modal += '<div class="modal-content">';
	          modal += '<div class="modal-header">';
	          modal += '<h4 class="modal-title">'+result['name']+'</h4>';
	          modal += '<button type="button" class="close" data-dismiss="modal">&times;</button>';
	          modal += '</div>';

	          modal += '<form id="update_training_modal_form">';
	          modal += '<div class="modal-body">';
	          modal += '<div class="row">';
	          modal += '<div class="col-lg-12 col-md-12 col-sm-12">';
	          modal += '<div class="form-group">';
	          modal += '<label for="sick_leave" class="col-sm-6 col-form-label">Sick Leave</label>';
	          modal += '<input type="number" class="form-control leaves-number" id="sick_leave" name="sick_leave" value="'+result['sick_leave']+'" placeholder="Sick Leave" min="0" validate="true">';
	          modal += '<div id="message_for_sick_leave" class="validation-error-message" msg="This Field is Required"></div>';
	          modal += '</div>';
	          modal += '</div>';
	          modal += '<div class="col-lg-12 col-md-12 col-sm-12">';
	          modal += '<div class="form-group">';
	          modal += '<label for="vacation" class="col-sm-6 col-form-label">Vacation</label>';
	          modal += '<input type="number" class="form-control leaves-number" id="vacation" name="vacation" value="'+result['vacation']+'" placeholder="Vacation" min="0"validate="true">';
	          modal += '<div id="message_for_vacation" class="validation-error-message" msg="This Field is Required"></div>';
	          modal += '</div>';
	          modal += '</div>';
	          modal += '<div class="col-lg-12 col-md-12 col-sm-12">';
	          modal += '<div class="form-group">';
	          modal += '<label for="holiday" class="col-sm-6 col-form-label">Holiday</label>';
	          modal += '<input type="number" class="form-control leaves-number" id="holiday" name="holiday" value="'+result['holiday']+'" placeholder="Holiday" min="0" validate="true">';
	          modal += '<div id="message_for_holiday" class="validation-error-message" msg="This Field is Required"></div>';
	          modal += '</div>';
	          modal += '</div>';
	          modal += '<input type="hidden" value="'+result['id']+'" name="id" />';

	          modal += '</div>';
	          modal += '<div class="modal-footer">';
	          modal += '<input type="submit" value = "Update" id="update_leaves_button" class="btn btn-primary m-1">';
	          modal += '<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>';
	          modal += '</div>';
	          modal += '</form>';
	          modal += '</div>';
	          modal += '</div>';
	        }

	        $('body').append(modal);
	        $('#update_leaves_modal').modal('show');

	        $('#update_training_modal').on('hidden.bs.modal', function(){
	          table.ajax.reload();
	          $('#update_leaves_modal').remove();
	          });
	      }

	    });
	  });
	/* Ends View Leaves to update */

	/* Starts Update Leaves - Modal Button */

	  $(document).on('click', '#update_leaves_button', function(e){
	      e.preventDefault();
	      var form = $(this).closest('form');
	      var error = validateFormAjax(form.attr('id'));
	      if(error == 0)
	      {
	        var input = form.serializeArray(); 
	        input.push({name: "mode", value: "update_leaves"});
	        $.ajax({
	          url: 'modules/leaves/leaves_ajax.php',
	          method: 'POST',
	          dataType: 'json',
	          data: input,
	          success: function(result){
	            var str = '';
	            form.closest('.modal').modal('hide');
	            if(result == true)
	            {
	              str += '<div class="alert alert-success" id="alert">';
	              str += 'Leaves Successfully Updated.';
	              str += '</div>';
	            }
	            else
	            {
	              str += '<div class="alert alert-danger" id="alert">';
	              str += 'There was some error! Please Try again Later.';
	              str += '</div>';
	            }

	            $('#table_holder').prepend(str);
	            hidealert(3);
	            table.ajax.reload();
	          }
	        }); 
	      } 
	  });

	/* Ends Update Leaves - Modal Button */

});