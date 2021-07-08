<?php

require('../roots.php');
require($root. 'include/variables.php');
require($root2.'classes/training.php');
$class_training = new training();


if($mode == 'add_training')
{
	$_POST['start'] = $_POST['start'] != '' ? date('Y-m-d', strtotime($_POST['start'])) : date('Y-m-d', strtotime('+2 days'));
	$_POST['end'] = $_POST['end'] != '' ? date('Y-m-d', strtotime($_POST['end'])) : date('Y-m-d', strtotime('+4 days'));
	echo $class_training->add_training();
}

if($mode == 'find_training_sessions')
{
	$result = $class_training->get_trainings();
	echo json_encode($result);
}

if($mode == 'find_training_with_id')
{
	$result = FALSE;
	if(isset($id))
	{
		$result = $class_training->get_trainings($id);		
	}
	echo json_encode($result);
}

if($mode == 'list_employees_for_training')
{
	$data = [];
	$result['emp_list'] = $class_training->list_employees_for_training($id);
	$result['already_exist'] = $class_training->list_exisiting_employees($id);
	echo json_encode($result);
}

if($mode == 'link_employee_to_training')
{
	$return['add'] = 0;
	$return['delete'] = 0;
	$return['error'] = 0;
	$already_exist = [];
	$existing = $class_training->list_exisiting_employees($training);
	
	foreach ($existing as $key => $value) {
		$already_exist[] = $value['employee'];
	}

	$to_Delete = array_diff($already_exist, $employee);
	$to_Add = array_diff($employee, $already_exist);
	
	foreach ($to_Delete as $key => $employee) {
		$result = $class_training->unlink_employee_to_training($training, $employee);
		if($result)
		{
		    $return['delete'] += 1;
		}
		
	}

	foreach ($to_Add as $key => $employee) {
		$result = $class_training->link_employee_to_training($training, $employee);
		if($result)
		{
			$return['add'] += 1;
		}
		else
		{
			$return['error'] = 1;
		}
	}

	echo json_encode($return);
}

if($mode == 'list_training_sessions_datatable')
{
	$result['data'] = $class_training->get_trainings();
	echo json_encode($result);
}

if($mode == 'change_status')
{
	if(isset($id) && isset($status))
	{
		$status = $status == 1? 0 : 1;
		$result =  $class_training->change_status($id, $status);
		echo json_encode($result); 
	}
	else
	{
		echo false;
	}
}

if($mode == 'view_employees_in_training')
{
	if(isset($id))
	{
		$result = $class_training->view_employees_in_training($id);
		echo json_encode($result);
	}
	else
	{
		echo FALSE;
	}
}

if($mode == 'update_training')
{
	$_POST['start'] = $_POST['start'] != '' ? date('Y-m-d', strtotime($_POST['start'])) : '';
	$_POST['end'] = $_POST['end'] != '' ? date('Y-m-d', strtotime($_POST['end'])) : '';
	echo $class_training->update_training();
}

?>