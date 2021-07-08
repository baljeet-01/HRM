<?php

require_once('db_operations.php');
require_once('core.php');

class performance extends core {

	public function add_performance()
	{
		return insert_values($this->tbl_performance, $this->fld_performance, $_POST);
	}

	public function get_employees_in_notin_performance($string = 'IN')
	{

		$subquery = 'select distinct employee from '.$this->tbl_performance;
		$sql = 'select id from '.$this->tbl_employees.' where id '.$string.'('.$subquery.') order by id';
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

	public function get_performance($id)
	{
		$sql = 'select a.*, b.f_name, b.l_name, b.designation, c.name as department from '.$this->tbl_performance.' a join '.$this->tbl_employees.' b on a.employee = b.id join '.$this->tbl_departments.' c on b.department = c.id where a.employee = "'.$id.'"';
		$result = query_result($sql);
		if($result)
		{
			if(count_rows($result) > 0)
			{
				$result = fetch_all($result);
				return $result;
			}
			else
			{
				return FALSE;
			}			
		}
	}

}