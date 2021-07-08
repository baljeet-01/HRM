<?php

require_once('db_operations.php');
require_once('core.php');

class navigations extends core {


	public function get_sidebar()
	{
		$sql = 'select * from '.$this->tbl_sidebar.' where status = 1';
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

}