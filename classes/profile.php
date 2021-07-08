<?php

require_once('db_operations.php');
require_once('core.php');

class profile extends core {


	public function change_password($oldpassword, $newpassword, $confirmpassword)
	{
		$data = false;
		$sql = 'select * from '.$this->tbl_employees.' where id = '.$_SESSION['emp_id'].' and password = "'.md5($oldpassword).'"';
		$result = query_result($sql);
		if($result)
		{
			if(count_rows($result) > 0)
			{
				if($newpassword == $confirmpassword)
				{
					$newpassword = md5($newpassword);
					$sql1 = 'update '.$this->tbl_employees.' set password = \''.$newpassword.'\' where id = '.$_SESSION['emp_id'];
					$result1 = query_result($sql1);
					if($result1)
					{
						$data['error'] = 0; 
					}
				}
			}
			else
			{
				$data['error'] = 1;
			}			
		}
		else
		{
			$data['error'] = 2;
		}

		return $data;
	}

}
?>