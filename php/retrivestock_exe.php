<?PHP

session_start();

include ('dbconnection.php'); 

$category =$_POST['category'];
$itemname = $_POST['itemname'];
$itemdescription = $_POST['description'];
$qty =$_POST['quantity'];
$unit_price =$_POST['price'];
$requestedby =$_POST['requestedby'];
$authorizedby =$_POST['authorizedby'];
$approvedby =$_POST['approvedby'];
$location = $_POST['location'];


$item_total_price =$unit_price * $qty;


$date = date('Y-m-d');



//select a table from the database

if(!$db) {
		die("Unable to select database");
}
		
$sql = "INSERT INTO `out_stock` (
`id`,
`item_category`,
`item_name`,
`item_description`,
`item_qty`,
`item_price`,
`unit_price`,
`location`,
`requested_by`,
`authorized_by`,
`approved_by`,
`date`


 ) VALUES (
 NULL, '$category', '$itemname', '$itemdescription', '$qty', $item_total_price,'$unit_price', '$location', '$requestedby', '$authorizedby', '$approvedby', '$date');";

$query= mysqli_query($conn, $sql);


//select querry to check of item exist in stock.

$queryselectstate = "
SELECT * FROM stock 
WHERE item_category LIKE '%".$category."%'
AND item_name LIKE '%".$itemname."%'
AND location LIKE '%".$location."%'
";


$queryselect= mysqli_query($conn, $queryselectstate);

//check to see an item o such exist. If yes add new item quantity to existing then update table

if(mysqli_num_rows($queryselect) == 1){

	$row_item = mysqli_fetch_assoc($queryselect);
	$new_qty = $row_item['total_qty'];
	$total_price = $row_item['item_price'];
	$total_qty = $new_qty - $qty;
	$update_price = $total_price - $item_total_price;

	$sql_qty = "UPDATE stock SET 		
		`total_qty` = '$total_qty', `item_price` = '$update_price'
		WHERE `item_category` = '$category' AND `item_name` = '$itemname' AND `location` = '$location';

		 ";

		$query_qty= mysqli_query($conn, $sql_qty);

		if ($query_qty){
			
				
			
			header ('location:../succ.php?url="retrivestock.php"');
			

						
					
		}

		else{
			header ('location:../fail.php?url="retrivestock.php"');

		}

}else{

		//add to Stock table which adds just the sum

$sqls = "INSERT INTO `stock` (
	`id`,
	`item_category`,
	`item_name`,
	`item_description`,
	`total_qty`,
	`item_price`,
	`location`
	
	
	 ) VALUES (
	 NULL, '$category', '$itemname', '$itemdescription', '$qty', '$total_price', '$location');";

$querys= mysqli_query($conn, $sqls);
	
}





	if ($query){
		
		
		header ('location:../succ.php?url="retrivestock.php"');
		

					
				
	}

	else{
		header ('location:../fail.php?url="retrivestock.php"');;

	}


?>