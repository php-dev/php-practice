<?php 

include "db_conn.php";

class Basic_CRUD extends Connect_Database{
	
	//this is created when its object is initialized
	function __construct() {
		
		$server = "localhost";
		$user = "root";
		$password = "";
		$database = "db_oop";		
		
		//
		parent::__construct($server,$user,$password, $database);		
	}	
			
	function insert_CRUD($post_variables = "") {
		
		//var_dump($post_variables); die;
						
		$this->sql = "INSERT INTO tbl_details SET name = '".$post_variables['name']."', age = '".$post_variables['age']."' ";		
		
		$this->result = mysql_query($this->sql);
		
		if($this->result) {
		  return mysql_insert_id();
		}
		
	}//function close
	
	function update_CRUD($post_variables = "") {
		
		//var_dump($post_variables); die;
		
		//to check what query i am running
		//echo $this->sql = "UPDATE tbl_details SET name = '".$post_variables['name']."', age = '".$post_variables['age']."' WHERE id ='".$post_variables['id']."'"; die;
		
		$this->sql = "UPDATE tbl_details SET name = '".$post_variables['name']."', age = '".$post_variables['age']."' WHERE id ='".$post_variables['id']."'"; 
		
		return $this->result = mysql_query($this->sql);
		
		
		
	}
	
	
	function display_crud($id = "") {
		
		$this->sql = "SELECT * FROM tbl_details";
		
		//checking if any id is sent
		// this is done for getting value in edit
		if($id!=""){
		  $this->sql.=" WHERE id='".$id."'";
		}
		
		//for checking what queryi am runnings
		//echo $this->sql; die;
		
		$this->result = mysql_query($this->sql);
		//var_dump(mysql_fetch_array($this->result)); die;
		$return_result_array =array();
		$return_list = array();
		if($this->result) {
			
			 while($row = mysql_fetch_array($this->result)) {
			 	
			  $return_result_array['id'] = $row['id'];
			  $return_result_array['name'] = $row['name'];
			  $return_result_array['age'] = $row['age'];
			  
			  array_push($return_list, $return_result_array);
			 }
		}
			
		return $return_list;
		
	}	
	
	
	function delete_CRUD($id = "") {		
		$this->sql = "DELETE FROM tbl_details WHERE id='".$id."'";
		
		return $this->result = mysql_query($this->sql);
	}
	
	
	
}
?>