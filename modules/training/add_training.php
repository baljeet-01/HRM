<?php

require('../roots.php');
require($root. 'include/variables.php');
require($root.'include/language/default.php');
require($root.'include/document_files.php');
require($root2.'classes/employees.php');
$class_emp = new employees();
$list = $class_emp->get_departments();
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <title><?php echo $TRN; ?></title>
  
  <?php include_all_css(); ?>

</head>
<body>
  
    <div class="wrapper d-flex align-items-stretch">
     <?php include($root.'include/sidebar.php') ?>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <?php include($root.'include/header.php'); ?>
        
        <div class="container">
        	<?php
        	if($alert)
        	{
        	  echo '<div class="alert alert-'.$alert.'">';
        	  echo ${'PAY'.$alert.'_'.$alert_orgin};
        	  echo '</div>';          
        	}     
            ?>
            <div id="tabs">
                <div class="col-xs-12 ">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-AddTraining-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Add Training</a>
                            <a class="nav-item nav-link" id="nav-AddEmployee-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Add Employees</a>
                            <a class="nav-item nav-link" id="nav-trainingStatus-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Training Status</a>
                        </div>
                    </nav>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <form id="AddTraining" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                              <fieldset class="border p-2">
                                <legend class="w-auto p-2">Add Training</legend>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                          <div class="form-group">
                                              <label for="name" class="col-sm-6 col-form-label">Name</label>
                                               <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                          </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                          <div class="form-group">
                                              <label for="department" class="col-sm-6 col-form-label">Department</label>
                                               <select type="text" class="form-control" name="department" id="department" validate="true">
                                                 <option value="">Department</option>
                                                 <?php 
                                                 while($row = fetch_row($list))
                                                 {
                                                   if($mode == 'update' && $department == $row['id'])
                                                   {
                                                     echo '<option value = '.$row['id'].' selected>'.$row['name'].'</option>';  
                                                   }
                                                   else
                                                   {
                                                     echo '<option value = '.$row['id'].'>'.$row['name'].'</option>';                           
                                                   }
                                                 }
                                                 ?>
                                               </select>
                                               <div id="message_for_department" class="validation-error-message" msg="Department is Required"></div>
                                          </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                              <label for="schedule" class="col-sm-6 col-form-label">schedule</label>
                                              <div class="input-daterange form-group input-group" id="schedule">
                                                  <input type="text" class="input-sm form-control" name="start" placeholder="Start" validate="true" />
                                                  <span class="input-group-text">to</span>
                                                  <input type="text" class="input-sm form-control" name="end" placeholder="End" validate="true"/>
                                              </div>                                          
                                        </div>                                                   
                                    </div>
                              </fieldset>

                              <input type="submit" value = "<?php echo $LNGsave ; ?>" id="add_training" class="btn btn-primary float-right mt-3">
                            </form>
                        </div>

                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                           <form id="AddEmployee" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                             <fieldset class="border p-2">
                               <legend class="w-auto p-2">Add Employees</legend>
                                   <div class="row">
                                      <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                          <div class="form-group">
                                              <label for="training_name" class="col-sm-6 col-form-label">Select Training</label>
                                              <select type="text" class="form-control" name="training_name" id="training_name" validate="true">
                                              </select>
                                              <div id="message_for_training_name" class="validation-error-message" msg="Please Select a Valid Input"></div>
                                          </div>                                      
                                      </div>
                                    
                                      <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <div class="form-group">
                                            <label for="employees" class="col-sm-6 col-form-label">Select Employees</label>
                                             <select id="employees" class="selectpicker form-control" multiple data-live-search="true" name="employee" validate="true">
                                             </select>
                                             <div id="message_for_employees" class="validation-error-message" msg="Please Select a Valid Input"></div>
                                        </div>
                                      </div> 
                                   </div>
                              </fieldset>
                               <input type="submit" value = "<?php echo $LNGsave ; ?>" id="add_employee" class="btn btn-primary float-right mt-3">
                            </form>

                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                          <div class="row">                             
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" id="table_holder">
                                                         
                            </div>
                          </div>
                        </div>
                    </div>
                
                </div>
            </div>		
                
        </div>  

      </div>
        
    <?php include_all_js(); ?>
    <script type="text/javascript" src="<?php echo 'assets/js/Module-JS/training.js'?>"></script>
  </body>
</html>