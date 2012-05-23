<?php 

$name_error = "";
$age_error = "";
$msg = "";

//check whether the value is coming from the right form
if(isset($_POST['submit']) && $_POST['submit'] = "save") {
	
	//include basic crud file to access the class
	include_once 'basic_crud.php';
	
	//initialize basic crud class object
	$crud_object = new Basic_CRUD();
	
	//var_dump($_POST);
	
	//check if both post values(name and age) are set	
	if( ($_POST['name']!="") && ($_POST['age'] !="") ) {

	//this is used for inserting.		
	  $result = $crud_object->insert_CRUD($_POST);
	  
	  if ($result > 0) {
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

<html>
<head>
<title>INSERT OPERATION IN OOP</title>
</head>
<body>

<form name="insert_form" method="post" action="">
<table>
<tr>
<td><label>NAME: </label></td>
<td><input type="text" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>"/><?php if(isset($name_error)) echo $name_error;?></td>
</tr>
<tr>
<td><label>AGE: </label></td>
<td><input type="text" name="age" value="<?php if(isset($_POST['age'])) echo $_POST['age'];?>"/><?php if(isset($age_error)) echo $age_error;?></td>
</tr>
<tr>
<td colspan="2"><label><input type="submit" name="submit" value="Save"> </label></td>
</tr>

</table>
</form>
</body>
</html>