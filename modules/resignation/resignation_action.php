<?php

require('../roots.php');
require($root. 'include/variables.php');
require($root.'include/language/default.php');
require($root.'include/document_files.php');
require($root2.'classes/resignation.php');
$class_emp = new resignation();
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <title><?php echo $RESlist; ?></title>

  <?php include_all_css(); ?>
  
</head>
<body>

    <div class="wrapper d-flex align-items-stretch">
     <?php include($root.'include/sidebar.php') ?>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <?php include($root.'include/header.php'); ?>
        
        <div class="container">          
          <div id="table_holder">
              <table id="resignation_list"></table>        
          </div>
        </div>
      </div>
        
    <?php include_all_js(); ?>
    <script type="text/javascript" src="<?php echo 'assets/js/Module-JS/resignation.js'?>"></script>
  </body>
</html>