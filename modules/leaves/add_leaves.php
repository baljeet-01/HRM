<?php

require('../roots.php');
require($root. 'include/variables.php');
require($root.'include/language/default.php');
require($root.'include/document_files.php');
require($root2.'classes/leaves.php');
$class_leaves = new leaves();
$list = $class_leaves->get_departments();
?>

<!doctype html>
<!DOCTYPE html>
<html lang="en">
<head>

  <title><?php echo $LEVadd; ?></title>

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
                                  <label for="department" class="col-sm-6 col-form-label">Deparment</label>
                                  <select type="text" class="form-control" name="department" id="department" validate="true">
                                    <option value="">Deparment</option>
                                    <?php 
                                    if($list)
                                    {
                                      while($row = fetch_row($list))
                                      {
                                        echo '<option value = '.$row['id'].'>'.$row['name'].'</option>';                           
                                      }                                      
                                    }
                                    ?>
                                  </select>
                                   <div id="message_for_emp_id" class="validation-error-message" msg="Employee ID is required"></div>
                              </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-12">
                              <div class="form-group" id="designation_holder">
                                  
                              </div>
                          </div>
                    </div>
                </fieldset>
                <fieldset class="border p-2">
                  <legend class="w-auto p-2">Leaves</legend>
                    <div class="row">
                          <div class="col-lg-4 col-md-4 col-sm-12">
                              <div class="form-group">
                                  <label for="sick_leave" class="col-sm-6 col-form-label">Sick Leave</label>
                                  <input type="number" class="form-control leaves-number" id="sick_leave" name="sick_leave" placeholder="Sick Leave" min="0" validate="true">
                                  <div id="message_for_sick_leave" class="validation-error-message" msg="This Field is Required"></div>
                              </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12">
                              <div class="form-group">
                                  <label for="vacation" class="col-sm-6 col-form-label">Vacation</label>
                                  <input type="number" class="form-control leaves-number" id="vacation" name="vacation" placeholder="Vacation" min="0"validate="true">
                                  <div id="message_for_vacation" class="validation-error-message" msg="This Field is Required"></div>
                              </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12">
                              <div class="form-group">
                                  <label for="holiday" class="col-sm-6 col-form-label">Holiday</label>
                                  <input type="number" class="form-control leaves-number" id="holiday" name="holiday" placeholder="Holiday" min="0" validate="true">
                                  <div id="message_for_holiday" class="validation-error-message" msg="This Field is Required"></div>
                              </div>
                          </div>
                    </div>
                </fieldset>
                  <input type="submit" value = "<?php echo $LNGsave ?>" class="btn btn-primary float-right mt-3" id="add_leaves">
              </form>
        </div>  

      </div>
        
    <?php include_all_js(); ?>
    <script type="text/javascript" src="<?php echo 'assets/js/Module-JS/leaves.js'?>"></script>
  </body>
</html>