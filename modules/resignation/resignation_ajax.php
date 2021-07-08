<?php

require('../roots.php');
require($root. 'include/variables.php');
require($root2.'classes/resignation.php');
$class_res = new resignation();

if($mode == 'add_resignation')
{
	$_POST['employee'] = $_SESSION['emp_id'];
	$_POST['date'] = date("Y-m-d H:i:s");
	$_POST['status'] = 1;
	$result = $class_res->add_resignation();
	echo json_encode($result);
}

if($mode == 'get_applied_resignation')
{
	$result['data'] =  $class_res->get_applied_resignation();
	echo json_encode($result);
}

if($mode == 'accept_reject_resignation')
{
	$result = [];
	if(isset($type) && $resid && $id)
	{
		$result = $class_res->accept_reject_resignation($id, $resid, $type);
	}
	echo json_encode($result);
}

?>