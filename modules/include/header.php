<?php

require_once('../roots.php');
require_once($root. 'include/variables.php');
require_once($root.'include/language/default.php');
require_once($root.'include/document_files.php');
require_once($root2.'classes/employees.php');
$class_emp = new employees();
$employee = fetch_row($class_emp->get_employee_join($_SESSION['emp_id']));
?>  


 <!-- header-wrapper Starts -->

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

      <button type="button" id="sidebarCollapse" class="btn btn-header">
        <i class="fa fa-bars"></i>
        <span class="sr-only">Toggle Menu</span>
      </button>
      <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="nav navbar-nav ml-auto">
          <li class="nav-item active">
              <a class="nav-link" href="http://localhost/HRM/modules/employee/employee_list.php">Home</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="http://localhost/HRM/modules/employee/employee_list.php">Contact</a>
          </li>
          <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <?php echo $employee['f_name']; ?>
             </a>
             <div class="dropdown-menu" aria-labelledby="navbarDropdown">
               <a class="dropdown-item" href="#">Action</a>
               <a class="dropdown-item" href="modules/profile/change_password.php">Change Password</a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="<?php echo $base_url.'modules/login/logout.php'; ?>">Logout</a>
             </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- header-wrapper Ends -->