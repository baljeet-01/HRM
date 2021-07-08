<?php

require('../roots.php');
require($root. 'include/variables.php');
require($root2.'classes/profile.php');
$class_pro = new profile();

if($mode == 'change_password')
{
	$result = false;
	if($oldpassword && $newpassword && $confirmpassword)
	{
		$result = $class_pro->change_password($oldpassword, $newpassword, $confirmpassword);		
	}
	echo json_encode($result);
}

?>