<?php
/**
 * Declare the interface ModelClassInterface that will be extended in Model class
 */
interface ModelClassInterface
{
	public function close();
	public function error($text);
	public function sql_start($sql);
	public function sql_end($sql);
	public function display_sql_log($last_record_only = false);
	public function select($sql="",$mode = 1);
	public function count_of($sql="");
	public function selectunion($sql="");
	public function newselect($sql="");
	public function affected($sql="");
	public function insert ($sql="",$throw_exception = TRUE);
	public function adder($sql="");
	public function edit($sql="",$throw_exception = TRUE);
	public function sql_query($sql="");
	public function sql_query_special($sql="");
	public function sql_query_structure($sql="");
	public function mysql_data_encode($data, $check = false);
	public function sql_single_query($sql="",$throw_exception = true,$mode = 1);
	public function call_procedure($sql="");
	public function delete($sql="",$throw_exception = TRUE);
	public function create_database($sql="");
	public function create_table($sql="");
	public function drop_table($sql="",$throw_exception = true);
	public function rename_table($sql="");
	public function alter_table($sql="",$throw_exception = true);
	public function start_transaction();
	public function commit_transaction();
	public function rollback_savepoint($msg);
	public function get_table_mapping($table_name,$database = '',$mode = 1);
	public function memcache_select_query($function_name,$query);
	public function get_sql_string($data, $saperator = ', ');
	public function get_mysql_version();
	public function get_mysql_version_info();
}

?>