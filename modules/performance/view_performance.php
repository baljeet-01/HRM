<?php

require('../roots.php');
require($root. 'include/variables.php');
require($root.'include/language/default.php');
require($root.'include/document_files.php');
require($root2.'classes/performance.php');
$class_pay = new performance();
$list = $class_pay->get_employees_in_notin_performance('IN');
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
                      <label for="employee_id_view_performance" class="col-sm-6 col-form-label">Employee Code</label>
                      <select type="text" class="form-control" name="employee" id="employee_id_view_performance" validate="true">
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
          </div>
          <div id="table_holder">            
          </div>
        </div>
      </div>
        
    <?php include_all_js(); ?>
    <script type="text/javascript" src="<?php echo 'assets/js/Module-JS/performance.js'?>"></script>
  </body>
</html>