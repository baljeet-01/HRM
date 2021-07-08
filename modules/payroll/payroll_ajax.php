<?php

require('../roots.php');
require($root. 'include/variables.php');
require($root2.'classes/payroll.php');
$class_pay = new payroll();


if($mode == 'get_paydetails')
{
	$data['error'] = 1;
	$result = $class_pay->get_paydetails($id);
	if($result)
	{
		$data = fetch_row($result);
		$data['error'] = 0;
	}

	echo json_encode($data);
}

if($mode == 'add_payroll')
{
	if(isset($emp_id))
	{
		$_POST['employee'] = $_POST['emp_id'];
		echo $class_pay->add_payroll();		
	}
}

if($mode == 'udpate_payroll')
{
	$_POST['id'] = $_POST['payroll_id'];
	echo $class_pay->update_payroll();
}

?>