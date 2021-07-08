$(document).ready(function(){

  var table;

  /*Starts Add Training*/
  $('#add_training').on('click', function(e){
    e.preventDefault();
    var form = $(this).closest('form');    
    var error = validateFormAjax(form.attr('id'));
    if(error == 0)
    {
      var input = form.serializeArray(); 
      input.push({name: "mode", value: "add_training"});

      $.ajax({
        url: 'modules/training/training_ajax.php',
        method: 'POST',
        dataType: 'json',
        data: input,
        success: function(result){
          var str = '';
          if(result == true)
          {
            str += '<div class="alert alert-success" id="alert">';
            str += 'Training Successfully Added.';
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
  /*Ends Add Training*/

  /* Starts Add Employee Nav Bar click AJAX to Fill Select*/    
    $.ajax({
      url: 'modules/training/training_ajax.php',
      method: 'POST',
      dataType: 'json',
      data: {
        mode: 'find_training_sessions'
      },
      success: function(result){    

        var str = '';
        if(result != false)
        {
          var str = '<option value="">Select Training</option>';
          $.each(result, function(key, value) {
            str += '<option value = "'+value['id']+'">'+value['name']+'</option>';
          });          

          $('#AddEmployee').find('#training_name').html(str);        
        }
      }
    });
  /* Ends Add Employee Nav Bar click AJAX to Fill Select*/

  /*Starts AJAX for change in Training Select in Add Employee*/
  $('#AddEmployee #training_name').on('change', function(){
    var value = $(this).val();

    if(value != '')
    {
        $.ajax({
          url: 'modules/training/training_ajax.php',
          method: 'post',
          dataType: 'json',
          data: {
            id: value,
            mode: 'list_employees_for_training'
          },
          success: function(result){
            var str = '';            
            var already_exist = [];

            $.each(result['already_exist'], function(key, value){
              already_exist.push(value['employee']); 
            });

            $.each(result['emp_list'], function(key, value) {              
                if(already_exist.includes(value['id']))
                {
                  str += '<option value = "'+value['id']+'" selected>'+value['f_name']+' '+value['l_name']+'</option>';            
                }
                else
                {    
                  str += '<option value = "'+value['id']+'">'+value['f_name']+' '+value['l_name']+'</option>';
                }        
            });

            $('#AddEmployee').find('#employees').html(str).selectpicker("refresh");
          }

        });

    }
    else
    {
      $('#AddEmployee').find('#employees').html('').selectpicker("refresh");
    }
  });
  /*Ends AJAX for change in Training Select in Add Employee*/

  /*Starts AJAX for linking Training and Employee*/
  $('#add_employee').on('click', function(e){
    e.preventDefault();
    var form = $(this).closest('form');
    //var error = validateFormAjax(form.attr('id'));
    error = 0;
    if(error == 0)
    {
      var training = $(form).find('#training_name').val();
      var employees = $(form).find('#employees').val();
      $.ajax({
        url: 'modules/training/training_ajax.php',
        method: 'POST',
        dataType: 'json',
        data: {
          training: training,
          employee: employees,
          mode: 'link_employee_to_training'
        },
        success: function(result){
          var str = '';
          if(result['error'] == 0)
          {
            str += '<div class="alert alert-success" id="alert">';
            str += result['add']+' employee(s) are Enrolled for Training ';
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

  /* Starts Show Training Employee Datatable Nav Bar */
   function createDatatable()
   {
      $('#table_holder').html('<table class="table" id="training_status_table" style="width:100%"> </table>');

      table = $('#training_status_table').DataTable({
        "ajax": {
          url: 'modules/training/training_ajax.php',
          type: 'POST',
          data: {
            mode: 'list_training_sessions_datatable'
          }
        },
        "columns": [
        {'title': 'ID', 'name': 'ID', "data": "id"},
        {'title': 'Name', 'name': 'name', "data": "name"},
        {'title': 'Department', 'name': 'department', "data": "d_name"},
        {'title': 'Start', 'name': 'start', "data": "start"},
        {'title': 'End', 'name': 'end', "data": "end"},
        {'title': 'Status' , 'name': 'status', "data": "status"},
        {'title': 'Action' , 'name': 'Action', "sortable": false, data: null, 
          render: function(data, type, row, meta)
          {
            var date = new Date(row['start']);
            var difference = date.getTime() - Date.now();
            var str = '';
            str += '<button data-id="'+row['id']+'"  class="btn btn-sm m-1 btn-info view_employee" title="View Employees"><i class="fa fa-eye" aria-hidden="true"></i></button>';
            if(row['status'] == 1)
            {
              if(difference > -1)
              {
                str += '<button class="btn btn-primary btn-sm m-1 update_training" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
                str += '<button class="btn btn-danger btn-sm m-1 change_status" title="Deactivate"><i class="fa fa-ban" aria-hidden="true"></i></button>';
              }
            }
            else
            {
              if(difference > -1)
              {
                str += '<button class="btn btn-success btn-sm m-1 change_status" title="Activate"><i class="fa fa-check" aria-hidden="true"></i></button>';
              }
            }
            return str;
          }
        }      
        ]
     });

   }

  /* Ends Show Training Employee Datatable Nav Bar */


  /* Starts Change Status AJAX */

    $(document).on('click', '.change_status', function(){
      var row = table.row($(this).parents('tr')).data();     

      $.ajax({
        url: 'modules/training/training_ajax.php',
        method: 'post',
        data: {
          mode: 'change_status',
          status: row['status'],
          id: row['id']
        },
        success: function(result)
        {
          table.ajax.reload();
        }
      });
    });

  /* Ends Change Status AJAX */


  /* Starts View Employees in Training */

    $(document).on('click', '.view_employee', function(){
      
      var row = table.row($(this).parents('tr')).data();

      $.ajax({
        url: 'modules/training/training_ajax.php',
        method: 'post',
        dataType: 'json',
        data: {
          id: row['id'],
          mode: 'view_employees_in_training'
        },
        success: function(result){
          
          var modal = '';
          modal += '<div id="view_employee_modal" class="modal fade" role="dialog">';
          modal += '<div class="modal-dialog">';
          modal += 'Modal content';
          modal += '<div class="modal-content">';
          modal += '<div class="modal-header">';
          modal += '<h4 class="modal-title">'+row['name']+'</h4>';
          modal += '<button type="button" class="close" data-dismiss="modal">&times;</button>';
          modal += '</div>';
          modal += '<div class="modal-body">';

          if(result)
          {
            modal += '<table class="table table-bordered">';
            modal += '<tr><th>ID</th><th>Name</th></tr>'

              $.each(result, function(key, value){
                modal += '<tr><td>'+value['id']+'</td><td>'+value['f_name']+' '+value['l_name']+'</td></tr>';
              });

            modal += '</table>';
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
          $('#view_employee_modal').modal('show');
          
          $('#view_employee_modal').on('hidden.bs.modal', function(){
            table.ajax.reload();
            $('#view_employee_modal').remove();
            });
        }

      });
    });

  /* Ends View Employees in Training */


  /* Starts View Employees in Training */

    $(document).on('click', '.update_training', function(){
      
      var row = table.row($(this).parents('tr')).data();

      $.ajax({
        url: 'modules/training/training_ajax.php',
        method: 'post',
        dataType: 'json',
        data: {
          id: row['id'],
          mode: 'find_training_with_id'
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
            modal += '<div id="update_training_modal" class="modal fade" role="dialog">';
            modal += '<div class="modal-dialog">';
            modal += 'Modal content';
            modal += '<div class="modal-content">';
            modal += '<div class="modal-header">';
            modal += '<h4 class="modal-title">'+row['name']+'</h4>';
            modal += '<button type="button" class="close" data-dismiss="modal">&times;</button>';
            modal += '</div>';

            modal += '<form id="update_training_modal_form">';
            modal += '<div class="modal-body">';
            modal += '<div class="row">';
            modal += '<div class="col-lg-12 col-md-12 col-sm-12 form-group">';
            modal += '<div class="form-group">';
            modal += '<label for="name" class="col-sm-6 col-form-label">Name</label>';
            modal += '<input type="text" class="form-control" id="name" name="name" placeholder="Name" validate="true" value = "'+result['name']+'">';
            modal += '<div id="message_for_name" class="validation-error-message" msg="Please Fill this Field"></div>'
            modal += '</div>';
            modal += '</div>';
            modal += '<div class="col-lg-12 col-md-12 col-sm-12 form-group">';
            modal += '<label for="schedule" class="col-sm-6 col-form-label">schedule</label>';
            modal += '<div class="input-daterange form-group input-group" id="schedule">';
            modal += '<input type="text" class="input-sm form-control" name="start" placeholder="Start" value="'+result['start']+'" validate="true"/>';
            modal += '<span class="input-group-text">to</span>';
            modal += '<input type="text" class="input-sm form-control" name="end" placeholder="End" value="'+result['end']+'" validate="true" />';
            modal += '</div>';
            modal += '</div>';
            modal += '<input type="hidden" class="input-sm form-control" name="training_id" value="'+result['id']+'" />';
            modal += '</div>';

            modal += '</div>';
            modal += '<div class="modal-footer">';
            modal += '<input type="submit" value = "Update" id="update_training_button" class="btn btn-primary m-1">';
            modal += '<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>';
            modal += '</div>';
            modal += '</form>';
            modal += '</div>';
            modal += '</div>';
          }

          $('body').append(modal);
          $('#update_training_modal').modal('show');

          $('#update_training_modal').on('hidden.bs.modal', function(){
            table.ajax.reload();
            $('#update_training_modal').remove();
            });
        }

      });
    });

  /* Ends View Employees in Training */


  /* Starts Update Training - Modal Button */

    $(document).on('click', '#update_training_button', function(e){
        e.preventDefault();
        var form = $(this).closest('form');
        var error = validateFormAjax(form.attr('id'));
        if(error == 0)
        {
          var input = form.serializeArray(); 
          input.push({name: "mode", value: "update_training"});
          $.ajax({
            url: 'modules/training/training_ajax.php',
            method: 'POST',
            dataType: 'json',
            data: input,
            success: function(result){
              var str = '';
              form.closest('.modal').modal('hide');
              if(result == true)
              {
                str += '<div class="alert alert-success" id="alert">';
                str += 'Training Successfully Updated.';
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

  /* Ends Update Training - Modal Button */

  /* Create Datatable on Tab Click */
  $('#nav-trainingStatus-tab').on('click', function(){
    createDatatable();
  });
  /* Create Datatable on Tab Click */



});
