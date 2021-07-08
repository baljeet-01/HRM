<?php

class core {

protected $tbl_departments = 'departments';
protected $tbl_designations = 'designations';
protected $tbl_employees = 'employees';
protected $tbl_payroll = 'payroll';
protected $tbl_training = 'training';
protected $tbl_employees_trainings = 'employees_trainings';
protected $tbl_performance = 'performance';
protected $tbl_leaves = 'leaves';
protected $tbl_resignation = 'resignation';
protected $tbl_sidebar = 'sidebar';



protected $fld_departments = array('name', 'status', 'created_by', 'updated_by');

protected $fld_designations = array('name', 'department', 'created_by', 'updated_by');

protected $fld_payroll = array('employee', 'basic_pay', 'deductions', 'status', 'created_by', 'updated_by');

protected $fld_employees = array('f_name', 'l_name', 'fathers_name', 'mothers_name', 'dob', 'gender', 'marital_status', 'nationality', 'disability', 'blood_group', 'comm_address', 'perm_address', 'email', 'mobile', 'department', 'Designation', 'joining_date', 'status', 'created_by', 'updated_by');

protected $fld_training = array('name', 'department', 'start', 'end', 'status', 'created_by', 'updated_by');

protected $fld_employees_trainings = array('employee', 'training');

protected $fld_performance = array('employee', 'date', 'job_knowledge', 'work_quality', 'attendance', 'punctuality', 'productivity', 'communication_skills', 'listening_skills', 'dependability', 'created_by', 'updated_by');

protected $fld_leaves = array('department', 'designation', 'sick_leave', 'vacation', 'holiday', 'status', 'created_by', 'updated_by');

protected $fld_resignation = array('employee', 'date', 'reason', 'status', 'created_by', 'updated_by');

protected $fld_sidebar = array('id', 'name', 'parent', 'class', 'href', 'status');

}

?>