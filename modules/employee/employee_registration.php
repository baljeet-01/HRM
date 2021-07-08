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
    <title><?php 
      if($mode == 'update')
      {
        echo $EMPupdate;
      } 
      else
      {
        echo $EMPresgistration;   
      }
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
                <legend class="w-auto p-2">Personal Details:</legend>
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                              <label for="f_name" class="col-sm-6 col-form-label">First Name</label>
                               <input type="text" class="form-control" id="f_name" name="f_name" placeholder="First Name" value = "<?php echo $mode=='update' ? $f_name : '' ; ?>" validate="true">
                               <div id="message_for_f_name" class="validation-error-message" msg="First Name is Required"></div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="form-group">
                              <label for="l_name" class="col-sm-6 col-form-label">Last Name</label>
                              <input type="text" class="form-control" id="l_name" name="l_name" value = "<?php echo $mode=='update' ? $l_name : '' ; ?>" placeholder="Last Name">
                          </div>
                      </div>
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="fathers_name" class="col-sm-6 col-form-label">Father's Name</label>
                                <input type="text" class="form-control" id="fathers_name" name="fathers_name" value = "<?php echo $mode=='update' ? $fathers_name : '' ; ?>" placeholder="Father's Name" validate="true">
                                <div id="message_for_fathers_name" class="validation-error-message"  msg="Father's Name is Required"></div>
                            </div>
                        </div>
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="mothers_name" class="col-sm-6 col-form-label">Mother's Name</label>
                                <input type="text" class="form-control" id="mothers_name" name="mothers_name" value = "<?php echo $mode=='update' ? $mothers_name : '' ; ?>" placeholder="Mother's Name" validate="true">
                                <div id="message_for_mothers_name" class="validation-error-message" msg="Mother's Name is Required"></div>
                            </div>
                        </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                              <label for="dob" class="col-sm-6 col-form-label">Date of Birth</label>
                               <input type="text" class="form-control" id="dob" name="dob" readonly value = "<?php echo $mode=='update' ? $dob : '' ; ?>" onmousedown="showdatepicker('dob');" placeholder="Date of Birth" validate="true">
                               <div id="message_for_dob" class="validation-error-message" msg="Date of Birth is Required"></div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="form-group">
                              <label for="gender" class="col-sm-6 col-form-label">Gender</label>
                              <select class="form-control" id="gender" name="gender" validate="true" value = "<?php echo $mode=='update' ? $gender : '' ; ?>">
                                <option value="" disabled selected>Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            <div id="message_for_gender" class="validation-error-message" msg="Gender is Required"></div>
                          </div>
                      </div>
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="marital_status" class="col-sm-6 col-form-label">Marital Status</label>
                                <select type="text" class="form-control" name="marital_status" id="marital_status">
                          <option value="">Marital Status</option>
                          <option>Married</option>
                          <option>Single</option>
                                </select>
                            </div>
                        </div>
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="nationality" class="col-sm-6 col-form-label">Nationality</label>
                                <input type="text" class="form-control" id="nationality" name="nationality" value = "<?php echo $mode=='update' ? $nationality : '' ; ?>" placeholder="Nationality" validate="true">
                                <div id="message_for_nationality" class="validation-error-message" msg="Nationality is Required"></div>
                            </div>
                        </div>
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="disability" class="col-sm-6 col-form-label">Disability</label>
                                <select type="text" class="form-control" name="disability" id="disability">
                                  <option value="">Disability</option>
                                  <option>Yes</option>
                                  <option>No</option>
                                </select>
                            </div>
                        </div>
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="blood_group" class="col-sm-6 col-form-label">Blood Group</label>
                                <select type="text" class="form-control" id="blood_group" name="blood_group">
                          <option value="">Blood Group</option>
                          <option>A+</option>
                          <option>A-</option>
                          <option>B+</option>
                          <option>B-</option>
                          <option>O+</option>
                          <option>O-</option>
                          <option>AB+</option>
                          <option>AB-</option>
                                </select>
                            </div>
                        </div>
                    </div>
              </fieldset>
              <fieldset class="border p-2">
                    <legend class="w-auto p-2">Contact Information</legend>
                      <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="comm_address" class="col-sm-6 col-form-label">Communication Address</label>
                                <input type="text" class="form-control" id="comm_address" value = "<?php echo $mode=='update' ? $comm_address : '' ; ?>" placeholder="Communication Address" name="comm_address" validate="true">
                                <div id="message_for_comm_address" class="validation-error-message" msg="Communication Address is Required"></div>
                            </div>
                        </div>
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="perm_address" class="col-sm-6 col-form-label">Permanent Resident</label>
                                <input type="text" class="form-control" id="perm_address" name="perm_address" value = "<?php echo $mode=='update' ? $perm_address : '' ; ?>" placeholder="Permanent Resident" validate="true">
                                <div id="message_for_perm_address" class="validation-error-message" msg="Permanent Address is Required"></div>
                            </div>
                        </div>
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="email" class="col-sm-6 col-form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value = "<?php echo $mode=='update' ? $email : '' ; ?>" placeholder="Email" validate="true">
                                <div id="message_for_email" class="validation-error-message" msg="Email is Required"></div>
                            </div>
                        </div>
                          <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="mobile" class="col-sm-6 col-form-label">Mobile</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" value = "<?php echo $mode=='update' ? $mobile : '' ; ?>" placeholder="Mobile Number" validate="true">
                                <div id="message_for_mobile" class="validation-error-message" msg="Mobile Number is Required"></div>
                            </div>
                        </div>
                      </div>
              </fieldset>
              <fieldset class="border p-2">
                  <legend class="w-auto p-2">Employee Status</legend>
                    <div class="row">
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
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="form-group">
                              <label for="designation" class="col-sm-6 col-form-label">Designation</label>
                              <input type="text" class="form-control" id="designation" name="designation" value = "<?php echo $mode=='update' ? $designation : '' ; ?>" placeholder="Designation">
                          </div>
                      </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="form-group">
                              <label for="joining_date" class="col-sm-6 col-form-label">Joining Date</label>
                              <input type="text" class="form-control" id="joining_date" value = "<?php echo $mode=='update' ? $joining_date : '' ; ?>" name="joining_date" onmousedown="showdatepicker('joining_date');" readonly placeholder="Joining Date">
                          </div>
                      </div>
                    </div>
              </fieldset>
              
              <?php echo $mode == 'update'? '<input type="hidden" name="id" value = "'.$id.'">' : ''; ?>
                
              <input type="submit" value = "<?php echo $mode=='update' ? $LNGupdate : $LNGsave ; ?>" data-operation = "<?php echo $mode=='update' ? 'update' : 'save' ; ?>" class="btn btn-primary float-right mt-3" id="add_employee">
                   
            </form>

          </div>        
      </div>
        
    <?php include_all_js(); ?>
    <script type="text/javascript" src="<?php echo 'assets/js/Module-JS/employee.js'?>"></script>
  </body>
</html>