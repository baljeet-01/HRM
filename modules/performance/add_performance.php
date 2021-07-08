<?php

require('../roots.php');
require($root. 'include/variables.php');
require($root.'include/language/default.php');
require($root.'include/document_files.php');
require($root2.'classes/performance.php');
$class_pay = new performance();
$list = $class_pay->get_employees_in_notin_performance('NOT IN');
?>

<!doctype html>
<!DOCTYPE html>
<html lang="en">
<head>

  <title><?php echo $PFMadd; ?></title>

  <?php include_all_css(); ?>

</head>
<body>

    <div class="wrapper d-flex align-items-stretch">
     <?php include($root.'include/sidebar.php') ?>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <?php include($root.'include/header.php'); ?>
        
        <div class="container">
              <form id="AddPerformance" method="POST">
                <fieldset class="border p-2">
                  <legend class="w-auto p-2">Basic Details:</legend>
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12">
                              <div class="form-group">
                                  <label for="emp_id" class="col-sm-6 col-form-label">Employee Code</label>
                                  <select type="text" class="form-control" name="emp_id" id="emp_id" validate="true">
                                    <option value="">Employee Code</option>
                                    <?php 
                                    while($row = fetch_row($list))
                                    {
                                      echo '<option value = '.$row['id'].'>'.$row['id'].'</option>';                           
                                    }
                                    ?>
                                  </select>
                                   <div id="message_for_emp_id" class="validation-error-message" msg="Employee ID is required"></div>
                              </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-12">
                              <div class="form-group">
                                  <label for="emp_name" class="col-sm-6 col-form-label">Employee Name</label>
                                  <input type="text" class="form-control" id="emp_name" name="emp_name" readonly placeholder="Employee Name" validate="true">
                                  <div id="message_for_emp_name" class="validation-error-message" msg="Employee Name is Required"></div>
                              </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-12">
                              <div class="form-group">
                                  <label for="designation" class="col-sm-6 col-form-label">Deparment</label>
                                  <input type="text" class="form-control" id="department" name="department" readonly placeholder="Deparment" validate="true">
                                  <div id="message_for_department" class="validation-error-message" msg="Deparment is Required"></div>
                              </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-12">
                              <div class="form-group">
                                  <label for="designation" class="col-sm-6 col-form-label">designation</label>
                                  <input type="text" class="form-control" id="designation" name="designation" readonly placeholder="Designation">
                              </div>
                          </div>
                    </div>
                </fieldset>
                <fieldset class="border p-2">
                  <legend class="w-auto p-2">Payroll Detail</legend>
                    <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="basic_pay" class="label col-sm-6 col-form-label input-label">Job Knowlegde</label>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6">
                              <div class="star-rating"></div>
                              <input type="hidden" name="job_knowledge" validate="true" id="job_knowledge" />
                               <div id="message_for_job_knowledge" class="validation-error-message" msg="Please Select a Valid Input"></div>
                          </div>
                    </div>
                    <hr>
                    <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="basic_pay" class="label col-sm-6 col-form-label input-label">Work Quality</label>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6">
                              <div class="star-rating"></div>
                              <input type="hidden" name="work_quality" validate="true" id="work_quality" />
                              <div id="message_for_work_quality" class="validation-error-message" msg="Please Select a Valid Input"></div>
                          </div>
                    </div>
                    <hr>
                    <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="basic_pay" class="label col-sm-6 col-form-label input-label">Attendance</label>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6">
                              <div class="star-rating"></div>
                              <input type="hidden" name="attendance" validate="true" id="attendance" />
                            <div id="message_for_attendance" class="validation-error-message" msg="Please Select a Valid Input"></div>
                          </div>
                    </div>
                    <hr>
                    <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="basic_pay" class="label col-sm-6 col-form-label input-label">Punctuality</label>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6">
                              <div class="star-rating"></div>
                              <input type="hidden" name="punctuality" validate="true" id="punctuality" />
                              <div id="message_for_punctuality" class="validation-error-message" msg="Please Select a Valid Input"></div>
                          </div>
                    </div>
                    <hr>
                    <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="basic_pay" class="label col-sm-6 col-form-label input-label">Productivity</label>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6">
                              <div class="star-rating"></div>
                              <input type="hidden" name="productivity" validate="true" id="productivity"/>
                              <div id="message_for_productivity" class="validation-error-message" msg="Please Select a Valid Input"></div>
                          </div>
                    </div>
                    <hr>
                    <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="basic_pay" class="label col-sm-6 col-form-label input-label">Communication Skills</label>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6">
                              <div class="star-rating"></div>
                              <input type="hidden" name="communication_skills" validate="true" id="communication_skills" />
                              <div id="message_for_communication_skills" class="validation-error-message" msg="Please Select a Valid Input"></div>
                          </div>
                    </div>
                    <hr>
                    <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="basic_pay" class="label col-sm-6 col-form-label input-label">Listening Skills</label>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6">
                              <div class="star-rating"></div>
                              <input type="hidden" name="listening_skills" validate="true" id="listening_skills"/>
                              <div id="message_for_listening_skills" class="validation-error-message" msg="Please Select a Valid Input"></div>
                          </div>
                    </div>
                    <hr>
                    <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6">
                            <label for="basic_pay" class="label col-sm-6 col-form-label input-label">Dependability</label>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6">
                              <div class="star-rating"></div>
                              <input type="hidden" name="dependability" validate="true" id="dependability" />
                              <div id="message_for_dependability" class="validation-error-message" msg="Please Select a Valid Input"></div>
                          </div>
                    </div>
                    <hr>
                </fieldset>
                  <input type="submit" value = "<?php echo $LNGsave ?>" class="btn btn-primary float-right mt-3" id="add_performance">
              </form>
        </div>
      </div>
    </div>
        
    <?php include_all_js(); ?>
    <script type="text/javascript" src="<?php echo 'assets/js/Module-JS/performance.js'?>"></script>
  </body>
</html>