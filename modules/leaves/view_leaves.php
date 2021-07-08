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

  <title><?php echo $LEVview; ?></title>

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
                          <label for="view_department" class="col-sm-6 col-form-label">Deparment</label>
                          <select type="text" class="form-control" name="view_department" id="view_department" validate="true">
                            <option value="">Select Deparment</option>
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
            </div>
             <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 form-group" id="table_holder">
              </div>
            </div>
        </div>  

      </div>
        
    <?php include_all_js(); ?>
    <script type="text/javascript" src="<?php echo 'assets/js/Module-JS/leaves.js'?>"></script>
  </body>
</html>