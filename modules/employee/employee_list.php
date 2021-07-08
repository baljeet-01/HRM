<?php

require('../roots.php');
require($root. 'include/variables.php');
require($root.'include/language/default.php');
require($root.'include/document_files.php');
require($root2.'classes/employees.php');
$class_emp = new employees();
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <title><?php echo $EMPlist; ?></title>

  <?php include_all_css(); ?>
  
</head>
<body>

    <div class="wrapper d-flex align-items-stretch">
     <?php include($root.'include/sidebar.php') ?>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <?php include($root.'include/header.php'); ?>
        
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="form-group">
                      <label for="employee_type" class="col-sm-6 col-form-label">Employee Code</label>
                      <select type="text" class="form-control" name="employee_type" id="employee_type">
                        <option value="">Select</option>
                        <option value="present">Present Employees</option>
                        <option value="ex">Ex Employees</option>
                        <option value="await">Awaited Employees</option>
                      </select>
                  </div>
              </div>
          </div>
          <div id="table_holder">
                      
          </div>
        </div>
      </div>
        
    <?php include_all_js(); ?>
    <script type="text/javascript" src="<?php echo 'assets/js/Module-JS/employee.js'?>"></script>
  </body>
</html>