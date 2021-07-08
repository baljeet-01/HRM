<?php

$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "hrm";
$db_port='3307';

// Create connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_name, $db_port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function query_result($sql)
{
	global $conn;
	if($result = $conn->query($sql))
	{
		return $result;
	}
	else
	{
		return FALSE;
	}
}

function escape_string($a)
{
	global $conn;
	return $conn->real_escape_string($a);
}

function fields_and_data_save($data, $fields)
{	
	$finalFields = [];
	$finaldata = [];
	$result = [];

	$data = array_map('escape_string', $data);
	
	foreach($fields as $field_index => $field_name)
	{
		foreach($data as $data_index => $entry)
		{
			if($field_name == $data_index)
			{
				$finalFields[] = $field_name;
				$finaldata[] = "'".$entry."'";
			}
		}
	}

	if($finalFields)
	{
		$result[] = implode(', ', $finalFields);
	}

	if($finaldata)
	{
		$result[] = implode(', ', $finaldata);
	}

	return $result;
}

function fields_and_data_update($data, $fields)
{	
	$result = '';

	$data = array_map('escape_string', $data);
	
	foreach($fields as $field_index => $field_name)
	{
		foreach($data as $data_index => $entry)
		{
			if($field_name == $data_index && $entry != '')
			{
				if($field_name == 'updated_by')
				{
					$result .= ' '.$field_name. ' =  CONCAT('.$field_name.', \''.$entry.'\'),';
				}
				else
				{
					$result .= ' '.$field_name. ' =  \''.$entry.'\',';					
				}
			}
		}
	}

	if($result)
	{
		$result =  substr($result, 0, -1);		
	}

	return $result;
}

function count_rows($data)
{
	return $data->num_rows;
}


function fetch_row($data)
{
	return $data->fetch_assoc();
}

function fetch_all($data)
{
	return $data->fetch_all(MYSQLI_ASSOC);
}

function insert_values($table, $fields, $values)
{
	global $conn;
	$values['created_by'] = $_SESSION['emp_id'].' @('.date('Y-m-d H:i:s').') ||';
	$data = fields_and_data_save($values, $fields);
	$sql = 'insert into '.$table.' ('.$data[0].') VALUES ('.$data[1].')';
	return query_result($sql);
}

function update_values($table, $fields, $values, $id)
{
	global $conn;
	$values['updated_by'] = $_SESSION['emp_id'].' @('.date('Y-m-d H:i:s').') ||';
	$data = fields_and_data_update($values, $fields);
	$sql = 'update '.$table.' set '.$data.' where id = '.$id;
	return query_result($sql);
}

?>