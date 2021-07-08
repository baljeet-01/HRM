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
    <title><?php
        echo $PROchangepassword;
     ?></title>

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
              echo '<div class="alert alert-'.$alert.'" id="alert">';
              echo ${'EMP'.$alert.'_'.$alert_orgin};
              echo '</div>';          
            }
            ?>
            <form id="employeeRegistration" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
              <fieldset class="border p-2">
                <legend class="w-auto p-2">Change Password:</legend>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                              <label for="oldpassword" class="col-sm-6 col-form-label">Old Password</label>
                               <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Old Password" validate="true">
                               <div id="message_for_oldpassword" class="validation-error-message" msg="This Field is Required"></div>
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="form-group">
                              <label for="newpassword" class="col-sm-6 col-form-label">New Password</label>
                              <input type="text" class="form-control" id="newpassword" name="newpassword" placeholder="New Password" validate="true">
                              <div id="message_for_newpassword" class="validation-error-message" msg="This Field is Required"></div>
                          </div>
                      </div>
                          <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="confirmpassword" class="col-sm-6 col-form-label">Confirm Password</label>
                                <input type="text" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" validate="true">
                                <div id="message_for_confirmpassword" class="validation-error-message"  msg="This Field is Required"></div>
                            </div>
                        </div>
                    </div>
              </fieldset>
                
              <input type="submit" value = "<?php echo $LNGupdate ?>" class="btn btn-primary float-right mt-3" id="change_password">
                   
            </form>

          </div>        
      </div>
        
    <?php include_all_js(); ?>
    <script type="text/javascript" src="<?php echo 'assets/js/Module-JS/profile.js'?>"></script>
  </body>
</html>