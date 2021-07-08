<?php

require('../roots.php');
require($root2.'classes/employees.php');
require($root. 'include/variables.php');

$class_emp = new employees();


if($mode == 'add_employee')
{
	$_POST['dob'] = $_POST['dob'] != '' ? date('Y-m-d', strtotime($_POST['dob'])) : '';
	$_POST['joining_date'] = $_POST['joining_date'] != '' ? date('Y-m-d', strtotime($_POST['joining_date'])) : '';
	$_POST['status'] = 1;
	echo $class_emp->add_employee();
}

if($mode == "get_employee")
{
	if(isset($type))
	{
		$result['data'] = $class_emp->get_employees($type);	
	}
	echo json_encode($result);
}



if($mode == 'view')
{
	$data['error'] = 1;
	$result = $class_emp->get_employee_join($id);

	if($result)
	{
		$data = fetch_row($result);		
		$data['error'] = 0;
	}
	
	echo json_encode($data);
}

if($mode == 'change')
{
	if(isset($id) && isset($status))
	{
		$status = $status == 1? 0 : 1;
		echo $class_emp->change_status($id, $status);		
	}
	else
	{
		echo FALSE;
	}
}

if($mode == 'submit_update')
{
	$_POST['dob'] = $_POST['dob'] != '' ? date('Y-m-d', strtotime($_POST['dob'])) : '';
	$_POST['joining_date'] = $_POST['joining_date'] != '' ? date('Y-m-d', strtotime($_POST['joining_date'])) : '';
	echo $class_emp->update_employee();
}

?>