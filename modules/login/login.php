<?php

 require('../roots.php');
 require($root.'include/variables.php');
 require($root.'include/language/default.php');
 require($root.'include/document_files.php' );
 require($root2.'classes/login.php');
 $class_lgn = new login();
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $LGN; ?></title>
    
    <?php include_all_css(); ?>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    
 </head>
 <body>

    <?php

        if ($mode == 'verify' && $emp_id && $password)
        {
            $result = $class_lgn->verify_login($emp_id, $password);
            if($result)
            {
                $result = fetch_row($result);
                $_SESSION['emp_id'] = $result['id'];
                header('location: ../employee/employee_registration.php');
                exit;
            }
            else
            {
            	$alert = 'danger';
            }
        }

    ?>
	
	<div class="limiter">
		<?php
		if($alert)
		{
		  echo '<div class="alert alert-'.$alert.'" id="alert">';
		  echo ${'LGN'.$alert};
		  echo '</div>';          
		}
		?>
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form class="login100-form" id="loginForm" method="post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
					<span class="login100-form-title p-b-33">
						Account Login
					</span>

					<div class="wrap-input100">
						<input class="input100" type="text" name="emp_id" placeholder="Email" validate="true">
					</div>

					<div class="wrap-input100">
						<input class="input100" type="password" name="password" placeholder="Password" validate="true">
					</div>

					<div class="container-login100-form-btn m-t-20">
						<input type="submit" value="Submit" class="login100-form-btn" onclick="validateForm('loginForm', 'verify');" />
					</div>
				</form>
			</div>
		</div>
	</div>
	

	
<?php include_all_js() ?>
</body>
</html>