<?php

require_once('db_operations.php');
require_once('core.php');

class login extends core {

	public function verify_login($emp_id, $password)
	{
		$sql = 'Select * from '.$this->tbl_employees. ' where id = "'.$emp_id.'" AND password = "'.md5($password).'"' ;
		$result = query_result($sql);
		if($result)
		{
			if(count_rows($result) > 0)
			{
				return $result;
			}
			else
			{
				return FALSE;
			}			
		}
	}
}


?>