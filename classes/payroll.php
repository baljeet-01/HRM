<?php

require_once('db_operations.php');
require_once('core.php');

class payroll extends core {

	public function add_payroll()
	{
		return insert_values($this->tbl_payroll, $this->fld_payroll, $_POST);
	}

	public function update_payroll()
	{
		return update_values($this->tbl_payroll, $this->fld_payroll, $_POST, $_POST['id']);
	}


	public function get_employees_in_notin_payroll($string = 'IN')
	{
		$sql = 'select id from '.$this->tbl_employees.' where id '.$string.' (select distinct employee from '.$this->tbl_payroll.') order by id';
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

	public function get_paydetails($id)
	{
		$sql = 'select a.id as emp_id, a.f_name, a.l_name, a.designation, b.basic_pay, b.deductions, c.name as d_name, b.id as pay_id from '.$this->tbl_employees.' a join '.$this->tbl_payroll.' b on a.id = b.employee JOIN '.$this->tbl_departments.' c on a.department = c.id where a.id ='.$id;
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