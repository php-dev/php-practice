<?php 

echo 'added new line';//echo $_GET['msg'];

//include basic crud file to access the class
include_once 'basic_crud.php';

//initialize basic crud class object
$crud_object = new Basic_CRUD();

$result = "";
$name_error = "";
$age_error = "";
$msg = "";
$count ="";

//call display method to get the list of all rows in table
if(isset($_GET['id']) && $_GET['id']!="") {
	$result = $crud_object->display_crud($_GET['id']);
	//var_dump($result);
	$count = sizeof($result);
}else{
	$msg = "Please send an id";
	header("Location:display.php?msg=".$msg);
} 
	
	
if(isset($_POST['submit']) && $_POST['submit'] = "save") {
	
	//check if both post values(name and age) are set or not empty	
	if( ($_POST['name']!="") && ($_POST['age'] !="") ) {
	  
	  var_dump($_POST);	 
	   	
	  $result = $crud_object->update_CRUD($_POST);
	  
	  if ($result) {
	  	$msg = "Inserted new data succcessfully."; 
	  	header("Location:display.php?msg=".$msg);
	  }
	  
	}else {
		//if name is empty set error
		if($_POST['name']=="" || !isset($_POST['name'])) {
			$name_error = "Name is required."; 
		}
		//if age is empty set error
		if($_POST['age']=="" || !isset($_POST['age'])) {
			$age_error = "Age is required."; 
		} 
	}
}
	
?>

<?php 	
  if($count>0) {
  	for($i=0;$i<$count; $i++){       		
?>

<form name="insert_form" method="post" action="">
<input type='hidden' name='id' value="<?php echo $result[$i]['id']?>">
<table>
<tr>
<td><label>NAME: </label></td>
<td><input type="text" name="name" value="<?php if(isset($_POST['name']) && $_POST['name']!=""){ echo $_POST['name'];} else { echo $result[$i]['name'];}?>"/><?php if(isset($name_error)) echo $name_error;?></td>
</tr>
<tr>
<td><label>AGE: </label></td>
<td><input type="text" name="age" value="<?php if(isset($_POST['age']) && $_POST['age']!=""){ echo $_POST['age'];} else { echo $result[$i]['age'];}?>"/><?php if(isset($age_error)) echo $age_error;?></td>
</tr>
<tr>
<td colspan="2"><label><input type="submit" name="submit" value="Save"> </label></td>
</tr>
</table>

	
<?php 
    }//for close
  }//if not empty close

?>
