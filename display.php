<?php 
//echo $_GET['msg'];

//include basic crud file to access the class
	include_once 'basic_crud.php';
	
	//initialize basic crud class object
	$crud_object = new Basic_CRUD();
	
	//call display method to get the list of all rows in table
	$result = $crud_object->display_crud();
	//var_dump($result);
	$count = sizeof($result);
	
	// for delete
	if($_GET['id'] !="" && $_GET['option']=='delete') {
		if($crud_object->delete_CRUD($_GET['id'])){
			$msg = "Deleted new data succcessfully."; 
	  		header("Location:display.php?msg=".$msg);
		}
	}
?>
<table>
<tr><td>Id</td><td>Name</td><td>Age</td> <td>Option</td> </tr>
<?php 	
  if($count>0) {
  	for($i=0;$i<$count; $i++){       		
?>
<tr>
<td><?php echo $result[$i]['id'];?></td>
<td><?php echo $result[$i]['name'];?></td>
<td><?php echo $result[$i]['age'];?></td>
<td>
<a href="edit.php?id=<?php echo $result[$i]['id'];?>">Edit</a>
|<a href="display.php?id=<?php echo $result[$i]['id'];?>&option=delete">Delete</a>
</td>

</tr>	
<?php 
    }//foreach close
  }//if not empty close

?>
</table>