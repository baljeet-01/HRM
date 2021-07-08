<?php

session_start();

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
	if($_GET)
	{
		extract($_GET);	
	}
}
else if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if($_POST)
	{
		extract($_POST);		
	}
}


$mode = isset($mode)? $mode : '';
$alert = isset($alert)? $alert : '';
$method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : '';


if(!isset($_SESSION['emp_id']) && !strpos($_SERVER['PHP_SELF'], 'login.php'))
{
	header('location: ../login/logout.php');
	exit;
}
else if(!strpos($_SERVER['PHP_SELF'], 'login.php'))
{
	$session_emp_id = $_SESSION['emp_id'];
}

?>