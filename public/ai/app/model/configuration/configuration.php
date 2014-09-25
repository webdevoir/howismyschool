<?php
class configuration{

	private $db_connection = NULL;
	private $table_name = '';

	public function __construct($db_obj) {
		$this->db_connection = $db_obj;
		$this->table_name = $this->db_connection->get_table_mapping('site_configurations');
	}

	public function load_configuration_details(){
		$query = 'SELECT * FROM '.$this->table_name;
		return $this->db_connection->sql_single_query($query);
	}

	public function save_configuration_data($dataArray){
		$query = 'UPDATE '.$this->table_name;
		$setString = '';
		foreach ($dataArray as $key => $value) {
			if($setString!=''){
				$setString .= ',';
			}
			$setString .= $key.'="'.$value.'"';
		}
		$query .= ' SET '.$setString;
		$this->db_connection->edit($query);
		return true;
	}
}
?>