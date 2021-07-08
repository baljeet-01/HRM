<?php

require_once('db_operations.php');
require_once('core.php');

class resignation extends core {

	public function add_resignation()
	{
		return insert_values($this->tbl_resignation, $this->fld_resignation, $_POST);
	}

	public function find_resignation($id)
	{
		$sql = 'select * from '.$this->tbl_employees.' a join  '.$this->tbl_resignation.' b on a.id = b.employee where a.status = 1 and a.id = '.$id;
		return query_result($sql);
	}

	public function get_applied_resignation()
	{
		$sql = 'select a.*, b.reason, b.date as resdate, b.id as resid from '.$this->tbl_employees.' a join  '.$this->tbl_resignation.' b on a.id = b.employee where a.status = 1';
		$result =  query_result($sql);
		if($result)
		{
			if(count_rows($result) > 0)
			{
				return fetch_all($result);
			}
			else
			{
				return FALSE;
			}			
		}
	}

	public function accept_reject_resignation($id, $resid, $type)
	{
		$data['operation'] = 0;
		$sql = 'update '.$this->tbl_resignation.' set status = 0 where id = '.$resid;
		$result =  query_result($sql);
		if($result)
		{
			$data['operation'] = 1; 
			if($type == 1)
			{
				$sql1 = 'update '.$this->tbl_employees.' set status = 0 where id = '.$id;
				$result1 = query_result($sql1);
				if($result1)
				{
					$data['operation'] = 2; 
				}	
			}
		}
		return $data;
	}


}