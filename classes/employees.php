<?php

require_once('db_operations.php');
require_once('core.php');

class employees extends core {

	public function get_departments()
	{
		$sql = 'Select * from '.$this->tbl_departments;
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

	public function get_employees($type)
	{
		if($type == 'present')
		{
			$sql = 'select * from '.$this->tbl_employees.' where status = 1';			
		}
		else if($type == 'ex')
		{
			$sql = 'select * from '.$this->tbl_employees.' where status = 0';
		}
		else if($type == 'await')
		{
			$sql = 'select a.* from '.$this->tbl_employees.' a join '.$this->tbl_resignation.' b on a.id=b.employee where a.status = 1';
		}
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

	public function get_employee_join($id)
	{
		$sql = 'select 
				a.id, a.f_name, a.l_name, a.fathers_name, a.mothers_name, a.dob, a.gender, a.marital_status, a.nationality, a.disability, a.blood_group, a.comm_address, a.perm_address, a.email, a.mobile, a.department, a.designation, a.joining_date, a.status, b.name as d_name 
				from '.$this->tbl_employees.' a JOIN '.$this->tbl_departments.' b on a.department = b.id where a.id = '.$id;
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

	public function add_employee()
	{
		return insert_values($this->tbl_employees, $this->fld_employees, $_POST);
	}

	public function update_employee()
	{
		return update_values($this->tbl_employees, $this->fld_employees, $_POST, $_POST['id']);
	}

	public function change_status($id, $status)
	{
		$sql = 'Update '.$this->tbl_employees.' set status = '.$status.' where id = '.$id;
		return query_result($sql);
	}
}

?>