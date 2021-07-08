<?php

require('../roots.php');
require($root. 'include/variables.php');
require($root2.'classes/performance.php');
$class_performance = new performance();


if($mode == 'add_performance')
{	
	if(isset($emp_id))
	{
		$_POST['employee'] = $_POST['emp_id'];
		$_POST['date'] = date('Y-m-d');
		echo $class_performance->add_performance();
	}
}

if($mode == 'list_performance_datatable')
{
	if($id)
	{
		$result['data'] = $class_performance->get_performance($id);
		echo json_encode($result);
	}
}

?>