<?php

require('../roots.php');
require($root. 'include/variables.php');
require($root.'include/language/default.php');
require($root.'include/document_files.php');
require($root2.'classes/payroll.php');
$class_pay = new payroll();
$list = $class_pay->get_employees_in_notin_payroll('IN');
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <title><?php echo $PAYupdate; ?></title>
  
  <?php include_all_css(); ?>

</head>
<body>


    <div class="wrapper d-flex align-items-stretch">
     <?php include($root.'include/sidebar.php') ?>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <?php include($root.'include/header.php'); ?>
        
        <div class="container">                
                <form id="payrollRegistration" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                  <fieldset class="border p-2">
                    <legend class="w-auto p-2">Basic Details:</legend>
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="emp_id_modify" class="col-sm-6 col-form-label">Employee Code</label>
                                <select type="text" class="form-control" name="emp_id_modify" id="emp_id_modify" validate="true">
                                  <option value="">Employee Code</option>
                                  <?php 
                                  while($row = fetch_row($list))
                                  {
                                    echo '<option value = '.$row['id'].'>'.$row['id'].'</option>';                           
                                  }
                                  ?>
                                </select>
                                <div id="message_for_emp_id_modify" class="validation-error-message" msg="Employee ID is required"></div>
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
                          <div class="col-lg-6 col-md-6 col-sm-12">
                              <div class="form-group">
                                  <label for="basic_pay" class="col-sm-6 col-form-label">Basic Pay</label>
                                  <input type="text" class="form-control" id="basic_pay" name="basic_pay" placeholder="Basic Pay" validate="true">
                                  <div id="message_for_emp_name" class="validation-error-message" msg="Basic Pay is Required"></div>
                              </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-12">
                              <div class="form-group">
                                  <label for="deductions" class="col-sm-6 col-form-label">Deductions</label>
                                  <input type="text" class="form-control" id="deductions" name="deductions" placeholder="Deductions" validate="true">
                                  <div id="message_for_deductions" class="validation-error-message" msg="Deductions is Required"></div>
                              </div>
                          </div>
                    </div>
                  </fieldset>

                    <input type="hidden" name="payroll_id" id="payroll_id" value="">

                    <input type="submit" value = "<?php echo $LNGupdate ?>" class="btn btn-primary float-right mt-3" id="update_payroll">
                </form>
        </div>  

      </div>
        
    <?php include_all_js(); ?>
    <script type="text/javascript" src="<?php echo 'assets/js/Module-JS/payroll.js'?>"></script>
  </body>
</html>