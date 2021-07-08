$(document).ready(function(){

	var table;

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


	$('#add_performance').on('click', function(e){
		e.preventDefault();
		var form = $(this).closest('form');    
		var error = validateFormAjax(form.attr('id'));
		if(error == 0)
		{
		  var input = form.serializeArray(); 
		  input.push({name: "mode", value: "add_performance"});

		  $.ajax({
		    url: 'modules/performance/performance_ajax.php',
		    method: 'POST',
		    dataType: 'json',
		    data: input,
		    success: function(result){
		      var str = '';
		      if(result == true)
		      {
		        str += '<div class="alert alert-success" id="alert">';
		        str += 'Performance Successfully Registered.';
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
		      page_reload(3.2);
		    }
		  });  
		}
	});


	$('#employee_id_view_performance').on('change', function(){
		var value = $(this).val();
		if(value != '')
		{
			$('#table_holder').html('<table class="table" id="performance_table" style="width:100%"> </table>');

			table = $('#performance_table').DataTable({
			   "ajax": {
			     url: 'modules/performance/performance_ajax.php',
			     type: 'POST',
			     data: {
			     	id: value,
			       mode: 'list_performance_datatable'
			     }
			   },
			   responsive: true,
			   "columns": [
			   {'title': 'ID', 'name': 'ID', "data": "id", "class": 'all compact'},
			   {'title': 'Name', 'name': 'name', "data": null, "class": 'all compact',
			   	render: function(data, type, row, meta){
			   		return row['f_name']+' '+row['l_name']
			   	 }
				},
			   {'title': 'Designation', 'name': 'designation', "data": "designation", "class": 'all compact'},
			   {'title': 'Department', 'name': 'department', "data": "department", "class": 'all compact'},			   
			   {'title': 'Job Knowledge', 'name': 'job_knowledge', "data": "job_knowledge", "class": 'none compact'},
			   {'title': 'Work Quality', 'name': 'work_quality', "data": "work_quality", "class": 'none compact'},
			   {'title': 'Attendance' , 'name': 'attendance', "data": "attendance", "class": 'none compact'},
			   {'title': 'Punctuality' , 'name': 'punctuality', 'data': 'punctuality', "class": 'none compact'},
			   {'title': 'Productivity', 'name': 'productivity', "data": "productivity", "class": 'none compact'},
			   {'title': 'Communication Skills' , 'name': 'communication_skills', "data": "communication_skills", "class": 'none compact'},
			   {'title': 'Listening Skills' , 'name': 'listening_skills', 'data': 'listening_skills', "class": 'none compact'},
			   {'title': 'Dependability', 'name': 'dependability', "data": "dependability", "class": 'none compact'}		   
			   ],
			   "columnDefs": [ {
			         "targets": [ 4, 5, 6, 7, 8, 9, 10, 11],
			         render: function(data, type, row, meta){
			         	return star_for_view(data);
			         }
			       }]
			});			
		}
		else
		{
			$('#table_holder').html('');

		}
	});


});