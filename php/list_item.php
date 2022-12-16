<?php
include('dbconnection.php');

$output = '';

$search = mysqli_real_escape_string($conn, $_POST["query"]);
$query = "
SELECT * FROM item_cat 
WHERE item_category LIKE '%".$search."%'
";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<option value="" selected>Select An Item</option>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
        
        <option value="'.$row["item_name"].'">'.$row["item_name"].'</option>
        ';
			
		
	}
	echo $output;
}else
{
	$output .= '<option selected>No Item In This Category</option>';
    echo $output;
}
?>