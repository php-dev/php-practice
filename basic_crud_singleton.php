<?php 

include "DB.php";

class Basic_CRUD {
	
	//this is created when its object is initialized
	function __construct() {
		//to test if singleon pattern ahs been implemented or not.
		//DB::get()->handle();
		DB::geat();
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
	
	
public function display_crud($id = "") {
		
		$this->sql = "SELECT * FROM core_users";
		
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
			  $return_result_array['email'] = $row['email'];
			  //$return_result_array['password'] = $row['passsword'];
			  
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
//echo DB::get()->handle();
$crud_obj = new Basic_CRUD();
var_dump($crud_obj->display_crud());
//var_dump($crud_obj);
echo "<br />";
//echo DB::get()->handle();
$crud_obj2 = new Basic_CRUD();
var_dump($crud_obj2->display_crud());
?>