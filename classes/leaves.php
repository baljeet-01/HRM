<?php

require_once('db_operations.php');
require_once('core.php');

class leaves extends core {


	public function get_departments()
	{
		$sql = 'select id, name from '.$this->tbl_departments.' order by id';
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

	public function get_designations($id)
	{
		$sql = 'select b.* from '.$this->tbl_departments.' a join '.$this->tbl_designations.' b on a.id = b.department where b.id = "'.$id.'" AND b.id not in (select DISTINCT designation from '.$this->tbl_leaves.') ';
		$result = query_result($sql);
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

	public function add_leaves()
	{
		return insert_values($this->tbl_leaves, $this->fld_leaves, $_POST);
	}

	public function get_leaves($id)
	{
		$sql = 'select a.id, a.sick_leave, a.holiday, a.vacation, a.status, b.name as department, c.name as designation from '.$this->tbl_leaves.' a join '.$this->tbl_departments.' b on a.department = b.id join '.$this->tbl_designations.' c on a.designation = c.id where a.department = "'.$id.'"';
		$result = query_result($sql);
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

	public function change_status($id, $status)
	{
		$sql = 'Update '.$this->tbl_leaves.' set status = '.$status.' where id = '.$id;
		return query_result($sql);
	}

	public function get_leave($id)
	{
		$sql = 'select a.id, a.sick_leave, a.holiday, a.vacation, a.status, b.name  from '.$this->tbl_leaves.' a join '.$this->tbl_designations.' b on a.designation = b.id where a.designation = "'.$id.'"';
		$result = query_result($sql);
		if($result)
		{
			if(count_rows($result) > 0)
			{
				return fetch_row($result);
			}
			else
			{
				return FALSE;
			}			
		}
	}

	public function update_leaves()
	{
		if($_POST['id'])
		{
			return update_values($this->tbl_leaves, $this->fld_leaves, $_POST, $_POST['id']);
		}
		else
		{
			return FALSE;
		}
	}


}

?>