<?php

require_once('../../environment.php');

function include_all_css()
{
	echo '<meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
	echo '<base href= "http://'.$GLOBALS['base_url'].'">';
	echo '<link rel="stylesheet" type="text/css" href="assets/css/font-awesome/css/font-awesome.min.css">';
	echo '<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">';
	echo '<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.standalone.min.css">';
	echo '<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-select.css">';
	echo '<link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css">';
	echo '<link rel="stylesheet" type="text/css" href="assets/css/util.css">';
	echo '<link rel="stylesheet" type="text/css" href="assets/css/style.css">';
	echo '<link rel="stylesheet" type="text/css" href="assets/css/input-group.css">';
	echo '<link rel="stylesheet" type="text/css" href="assets/css/custom.css">';

}

function include_all_js()
{
	echo '<script type="text/javascript" src="assets/js/jquery.min.js"></script>';
	echo '<script type="text/javascript" src="assets/js/bootstrap-datepicker.min.js"></script>';
	echo '<script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>';
	echo '<script type="text/javascript" src="assets/js/bootstrap-select.js"></script>';
	echo '<script type="text/javascript" src="assets/js/datatables.min.js"></script>';
	echo '<script type="text/javascript" src="assets/js/main.js"></script>';	
	echo '<script type="text/javascript" src="assets/js/custom.js"></script>';
}

?>