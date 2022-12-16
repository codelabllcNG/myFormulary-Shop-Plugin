<?php
include('dbconnection.php');
$location = mysqli_real_escape_string($conn, $_POST["location"]);
$output = '';
if(isset($_POST["query"]))
{



	$search = mysqli_real_escape_string($conn, $_POST["query"]);
  
	$query = "
	SELECT * FROM out_stock 
	WHERE item_category LIKE '%".$search."%'
	OR item_name LIKE '%".$search."%' AND location LIKE '%".$location."%'
	OR item_description LIKE '%".$search."%' AND location LIKE '%".$location."%'
	OR item_qty LIKE '%".$search."%' AND location LIKE '%".$location."%'
	OR location LIKE '%".$search."%' AND location LIKE '%".$location."%'
  OR requested_by LIKE '%".$search."%' AND location LIKE '%".$location."%'
  OR authorized_by LIKE '%".$search."%' AND location LIKE '%".$location."%'
  OR date LIKE '%".$search."%' AND location LIKE '%".$location."%'
	OR approved_by LIKE '%".$search."%' AND location LIKE '%".$location."%'
  ORDER BY date DESC
	";


	 
}
elseif (!isset($_POST["location"]))
{
	$query = "
	SELECT * FROM out_stock ORDER BY date DESC ";
}
else
  {
    $query = "
    SELECT * FROM out_stock WHERE location LIKE '%".$location."%' ORDER BY date DESC";
  }

$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<table>
                  <thead>
                    <tr>
                    <th  style="background-color:#DC6A27;">ID</th>
                    <th  style="background-color:#DC6A27;">Item Category</th>
                    <th  style="background-color:#DC6A27;">Item Name</th>
                    <th  style="background-color:#DC6A27;">Description</th>
                    <th  style="background-color:#DC6A27;">Qty.</th>
                    <th  style="background-color:#DC6A27;">Unit Price</th>
                    <th  style="background-color:#DC6A27;">Total Price</th>
                    <th  style="background-color:#DC6A27;">location</th>
                    <th  style="background-color:#DC6A27;">Requested By</th>
                    <th  style="background-color:#DC6A27;">Authorized By</th>
                    <th  style="background-color:#DC6A27;">Approved By</th>
                    <th  style="background-color:#DC6A27;">Date</th>

                    </tr>
                   </thead>
                   <tbody>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
				<td>'.$row["id"].'</td>
                <td>'.$row["item_category"].'</td>
                <td>'.$row["item_name"].'</td>
                <td>'.$row["item_description"].'</td>
                <td>'.$row["item_qty"].'</td>
                <td>'.$row["unit_price"].'</td>
                <td>'.$row["item_price"].'</td>
                <td>'.$row["location"].'</td>
                <td>'.$row["requested_by"].'</td>
                <td>'.$row["authorized_by"].'</td>
                <td>'.$row["approved_by"].'</td>
                <td>'.$row["date"].'</td>
              </tr>';
			
		
	}
	echo $output;
}
else
{
	$output .= '<table>
                  <thead>
                    <tr>
                      <th >Data Not Found</th>
                      </tr>
                   </thead>
                   <tbody>
                   ';
    echo $output;
}


?>