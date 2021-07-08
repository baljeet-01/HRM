<?php

require_once('db_operations.php');
require_once('core.php');

class training extends core {

	public function get_trainings($id = '')
	{		
		$sql = 'select a.id, a.name, a.end, a.start, a.status, b.name as d_name from '.$this->tbl_training.' a join '.$this->tbl_departments.' b  on a.department = b.id';

		if($id != '')
		{
			$sql = $sql.' where a.id = '.$id;
		}
		$result = query_result($sql);

		if($result)
		{
			if(count_rows($result) > 0)
			{
				$result = $id != ''? fetch_row($result) : fetch_all($result);
				return $result;
			}
			else
			{
				return FALSE;
			}			
		}
	}

	public function add_training()
	{
		return insert_values($this->tbl_training, $this->fld_training, $_POST);
	}

	public function list_employees_for_training($training)
	{
		$sql = 'select a.id, a.f_name, a.l_name from '.$this->tbl_employees.' a join '.$this->tbl_training.' b on a.department = b.department where b.id = "'.$training.'"';
		
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

	public function list_exisiting_employees($training)
	{
		$result = [];
		$sql = 'select employee from '.$this->tbl_employees_trainings.' where training = "'.$training.'"';
		$result = query_result($sql);
		if($result)
		{
			$result =  fetch_all($result);			
		}
		return $result;
	}

	public function link_employee_to_training($training, $employee)
	{
		$fields = array('training' => $training, 'employee' => $employee);
		return insert_values($this->tbl_employees_trainings, $this->fld_employees_trainings, $fields); 
	}

	public function unlink_employee_to_training($training, $employee)
	{
		$sql = 'delete from '.$this->tbl_employees_trainings.' where training = "'.$training.'" and employee = "'.$employee.'"';
		return query_result($sql);
	}

	public function change_status($id, $status)
	{
		$sql = 'Update '.$this->tbl_training.' set status = '.$status.' where id = '.$id;
		return query_result($sql);
	}

	public function view_employees_in_training($training) 
	{
		$sql = 'select b.id, b.f_name, b.l_name from employees_trainings a JOIN employees b on a.employee = b.id where a.training ="'.$training.'" order by b.id';
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

	public function update_training()
	{
		if($_POST['training_id'])
		{
			return update_values($this->tbl_training, $this->fld_training, $_POST, $_POST['training_id']);
		}
		else
		{
			return FALSE;
		}
	}

}