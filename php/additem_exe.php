<?PHP

session_start();

include ('dbconnection.php'); 

$category =$_POST['category'];
$itemname = $_POST['itemname'];



//select a table from the database

if(!$db) {
		die("Unable to select database");
}



$sql = "INSERT INTO `item_cat` (
`id`,
`item_category`,
`item_name`


 ) VALUES (
 NULL, '$category', '$itemname');";



$query= mysqli_query($conn, $sql);
	
	if ($query){
		
			header ('location:../succ.php?url="additem.php"');

					
				
	}

	else{
		header ('location:../fail.php?url="additem.php"');;

	}


?>