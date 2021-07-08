<?php

require('../roots.php');
require($root. 'include/variables.php');
require($root2.'classes/leaves.php');
$class_leaves = new leaves();

if($mode == 'load_designations')
{
	$result = false;
	if($id)
	{
		$result = $class_leaves->get_designations($id);
	}
	echo json_encode($result);
}

if($mode == 'add_leaves')
{
	$result = false;
	if(isset($holiday) && isset($sick_leave) && isset($vacation) && $designation != '')
	{
		$_POST['holiday'] = ($_POST['holiday'] > 0)? $_POST['holiday'] : '0';
		$_POST['sick_leave'] = ($_POST['sick_leave'] > 0)? $_POST['sick_leave'] : '0';
		$_POST['vacation'] = ($_POST['vacation'] > 0)? $_POST['vacation'] : '0';
		$result = $class_leaves->add_leaves();
	}
	echo json_encode($result);		
}

if($mode == 'list_leaves_datatable')
{
	$result = false;
	if($id)
	{
		$result['data'] = $class_leaves->get_leaves($id);		
	}

	echo json_encode($result);
}

if($mode == 'change_status')
{
	$result = false;
	if(isset($id) && isset($status))
	{
		$status = $status == 1? 0 : 1;
		$result = $class_leaves->change_status($id, $status);		
	}
	echo json_encode($result);
}

if($mode == 'find_leaves_with_id')
{
	$result = false;
	if($id)
	{
		$result = $class_leaves->get_leave($id);
	}
	echo json_encode($result);
}

if($mode == 'update_leaves')
{
	$result = false;
	if($id)
	{
		$_POST['holiday'] = ($_POST['holiday'] > 0)? $_POST['holiday'] : '0';
		$_POST['sick_leave'] = ($_POST['sick_leave'] > 0)? $_POST['sick_leave'] : '0';
		$_POST['vacation'] = ($_POST['vacation'] > 0)? $_POST['vacation'] : '0';
		$result = $class_leaves->update_leaves();
	}
	echo json_encode($result);
}

?>