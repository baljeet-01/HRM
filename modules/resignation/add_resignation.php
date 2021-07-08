<?php

require('../roots.php');
require($root. 'include/variables.php');
require($root.'include/language/default.php');
require($root.'include/document_files.php');
require($root2.'classes/employees.php');
require($root2.'classes/resignation.php');
$class_emp = new employees();
$class_res = new resignation();
$user = $class_emp->get_employee_join($_SESSION['emp_id']);
$user = ($user)? fetch_row($user) : false;
$alert = (!$user)? 'danger' : false;
$alert_orgin = ($alert)? 'wrong' : false;
$resignation = $class_res->find_resignation($_SESSION['emp_id']);
$resignation = ($resignation)? fetch_row($resignation) : false;
$alert = ($resignation)? 'success' : false;
$alert_orgin = ($alert)? 'alreadyexists' : false;

?>

<!doctype html>
<!DOCTYPE html>
<html lang="en">
<head>

  <title><?php echo $RESadd; ?></title>

  <?php include_all_css(); ?>

</head>
<body>

    <div class="wrapper d-flex align-items-stretch">
     <?php include($root.'include/sidebar.php') ?>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <?php include($root.'include/header.php'); ?>
        <div class="container" id="alert_prepend">
          <form id="addresignation" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <?php
            if($alert)
            {
              echo '<div class="alert alert-'.$alert.'">';
              if($alert_orgin = 'alreadyexists')
              {
                echo ${'RES'.$alert.'_'.$alert_orgin};
              }
              else
              {
                echo ${'LNG'.$alert.'_'.$alert_orgin};
              }
              echo '</div>';          
            }
            else if($user)
            {
            ?>
              <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                            <?php 
                            echo 'Dear '.$user['f_name'].' '.$user['l_name'].','; 
                            echo '<br/>';
                            echo 'TEXT';
                            ?>
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <label for="reason" class="col-form-label">Reason</label>
                  <textarea type="text" class="form-control" id="textarea" name="reason" placeholder="Reason" validate="true"></textarea>
                  <div id="message_for_textarea" class="validation-error-message"  msg="This Field is Required"></div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <input type="hidden" name="id" value="<?php echo $_SESSION['emp_id']; ?>" id="user_id" /> 
                  <input type="checkbox" id="tnc" name="tnc" /> I have read all the terms and conditions
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <input type="submit" value = "<?php echo $LNGsave ?>" class="btn btn-primary float-right mt-3" id="add_resignation">
                </div>
              </div>

            <?php } ?>
          </form>
        </div>  

      </div>
        
    <?php include_all_js(); ?>
    <script type="text/javascript" src="<?php echo 'assets/js/Module-JS/resignation.js'?>"></script>
  </body>
</html>