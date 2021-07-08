<?php

require('../roots.php');
require($root. 'include/variables.php');
require($root.'include/language/default.php');
require($root.'include/document_files.php');
require($root2.'classes/payroll.php');
$class_pay = new payroll();
$result = $class_pay->get_paydetails($_SESSION['emp_id']);
if(count_rows($result) == 1)
{
	$result = fetch_row($result);
}
else
{
	$alert = 'danger';
	$alert_orgin = 'view';
}
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
        	<?php
        	if($alert)
        	{
        	  echo '<div class="alert alert-'.$alert.'">';
        	  echo ${'PAY'.$alert.'_'.$alert_orgin};
        	  echo '</div>';          
        	}
        	else
        	{
        	?>	

    			<fieldset class="border p-2">
    			  <legend class="w-auto p-2">Payroll Detail</legend>
    			    <div class="row p-2">
    			        <div class="col-lg-6 col-md-6 col-sm-12">
    			            <div class="form-group">
    			                <span class="view-heading">Basic Pay</span>
    			                <div class="view-content"><?php echo $result['basic_pay']; ?></div>	             
    			            </div>
    			            <div class="form-group">
    			                <span class="view-heading">Deductions</span>
    			                <div class="view-content"><?php echo $result['deductions']; ?></div>	             
    			            </div>
    			        </div>
    			  </div>
    			</fieldset>					

        	<?php
        	}
        	?>
                
        </div>  

      </div>
        
    <?php include_all_js(); ?>
    <script type="text/javascript" src="<?php echo 'assets/js/Module-JS/payroll.js'?>"></script>
  </body>
</html>