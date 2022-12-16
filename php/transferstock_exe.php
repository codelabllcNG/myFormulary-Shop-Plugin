<?PHP

session_start();

include ('dbconnection.php'); 

$category =$_POST['category'];
$itemname = $_POST['itemname'];
$itemdescription = $_POST['description'];
$transfer_qty =$_POST['quantity'];
$transfer_unit_price =$_POST['price'];
$transfer_from = $_POST['transfer_from'];
$transfer_to = $_POST['transfer_to'];
$location = $_POST['transfer_from'];

$item_total_price = $transfer_qty * $transfer_unit_price;

$date = date('Y-m-d');

$exp_date = $_POST['exp_date'];




//select a table from the database

if(!$db) {
		die("Unable to select database");
}
		
$sql = "INSERT INTO `transfer_stock` (
`id`,
`item_category`,
`item_name`,
`item_description`,
`item_qty`,
`item_price`,
`unit_price`,
`transfer_from`,
`transfer_to`,
`date`,
`exp_date`


 ) VALUES (
 NULL, '$category', '$itemname', '$itemdescription', '$transfer_qty', '$transfer_unit_price', '$transfer_from', '$transfer_to', '$date', '$exp_date');";

$query= mysqli_query($conn, $sql);


//select querry to check of item and location to  transfer_to exist in stock.

$querytrans_to = "
SELECT * FROM stock 
WHERE item_category LIKE '%".$category."%'
AND item_name LIKE '%".$itemname."%'
AND location LIKE '%".$transfer_to."%'
";


$queryselect_to = mysqli_query($conn, $querytrans_to);



//check to see an item o such exist. If yes add new item quantity to existing then update table

if(mysqli_num_rows($queryselect_to) == 1){


	//update the stock inventory where the stock is going to
	$row_item = mysqli_fetch_assoc($queryselect_to);
	$existing_qty = $row_item['total_qty'];
	$existing_price = $row_item['item_price'];
	$new_total_qty = $existing_qty + $transfer_qty;
	$new_total_price = $existing_price + $item_total_price;

	$transfer_to_sql = "UPDATE stock SET 		
		`total_qty` = '$new_total_qty', `item_price` = '$new_total_price'
		WHERE `item_category` = '$category' AND `item_name` = '$itemname' AND `location` = '$transfer_to';

		 ";

		$transfer_to_query= mysqli_query($conn, $transfer_to_sql);



			//update the stock inventory where the stock is coming from

				$querytrans_from = "
				SELECT * FROM stock 
				WHERE item_category LIKE '%".$category."%'
				AND item_name LIKE '%".$itemname."%'
				AND location LIKE '%".$transfer_from."%'
				";

				$queryselect_from = mysqli_query($conn, $querytrans_from);

				$row_itm = mysqli_fetch_assoc($queryselect_from);
				$existing_qty_from = $row_itm['total_qty'];
				$existing_price_from = $row_itm['item_price'];
				$new_total_qty_from = $existing_qty_from - $transfer_qty;
				$new_total_price_from = $existing_price_from - $item_total_price;

				$transfer_from_sql = "UPDATE stock SET 		
					`total_qty` = '$new_total_qty_from', `item_price` = '$new_total_price_from'
					WHERE `item_category` = '$category' AND `item_name` = '$itemname' AND `location` = '$transfer_from';

					";

					$transfer_from_query= mysqli_query($conn, $transfer_from_sql);

					if($transfer_from_query){
						
						
							
								
							
							header ('location:../succ.php?url="transferstock.php"');
							

										
									
						}else{
							
							header ('location:../fail.php?url="transferstock.php"');;

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
	 NULL, '$category', '$itemname', '$itemdescription', '$transfer_qty',  '$item_total_price', '$transfer_to');";

$querys= mysqli_query($conn, $sqls);

//update the stock inventory where the stock is coming from

$querytrans_from = "
SELECT * FROM stock 
WHERE item_category LIKE '%".$category."%'
AND item_name LIKE '%".$itemname."%'
AND location LIKE '%".$transfer_from."%'
";

$queryselect_from = mysqli_query($conn, $querytrans_from);

$row_itm = mysqli_fetch_assoc($queryselect_from);
$existing_qty_from = $row_itm['total_qty'];
$existing_price_from = $row_itm['item_price'];
$new_total_qty_from = $existing_qty_from - $transfer_qty;
$new_total_price_from = $existing_price_from - $item_total_price;

$transfer_from_sql = "UPDATE stock SET 		
	`total_qty` = '$new_total_qty_from', `item_price` = '$new_total_price_from'
	WHERE `item_category` = '$category' AND `item_name` = '$itemname' AND `location` = '$transfer_from';

	";

	$transfer_from_query= mysqli_query($conn, $transfer_from_sql);


	if($transfer_from_query){
						
						
							
								
							
		header ('location:../succ.php?url="transferstock.php"');
		

					
				
	}else{
		
		header ('location:../fail.php?url="transferstock.php"');;

	}
	
}



?>