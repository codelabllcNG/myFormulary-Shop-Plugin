<?php
include('dbconnection.php');
$location = mysqli_real_escape_string($conn, $_POST["location"]);
$report_type = mysqli_real_escape_string($conn, $_POST["reporttype"]);
$start_date = mysqli_real_escape_string($conn, $_POST["start_date"]);
$end_date = mysqli_real_escape_string($conn, $_POST["end_date"]);
$category = mysqli_real_escape_string($conn, $_POST["category"]);
$item_name = mysqli_real_escape_string($conn, $_POST["itemname"]);
$low_stock_qty = mysqli_real_escape_string($conn, $_POST["lowstockqty"]);
$output = '';


// For damage Stock Report
if($report_type == "damage_stock"){


    if ($category =="" && $item_name == "" && $start_date == "" && $end_date == "" && $location ==""){

   
        $query = "
            SELECT * FROM damage_stock ORDER BY id DESC
        ";
}

else if (isset($category) && isset($item_name) && isset($start_date) && isset($end_date) && isset($location)){


    $query = "
        SELECT * FROM damage_stock WHERE item_category LIKE '%".$category."%'
        AND item_name LIKE '%".$item_name."%' 
        AND date BETWEEN 
        '$start_date' AND '$end_date' 
        AND location LIKE '%".$location."%' ORDER BY id DESC
    ";
    
    
}


else if ($category =="" && $item_name == "" && $end_date == ""  && $location ==""){


    $query = "
        SELECT * FROM damage_stock 
        WHERE date LIKE '%".$start_date."%' ORDER BY id DESC
    ";
   
}


else if ($item_name == "" && $end_date == ""  && $location ==""){


    $query = "
        SELECT * FROM damage_stock 
        WHERE item_category LIKE '%".$category."%'  
        AND date LIKE '%".$start_date."%' ORDER BY id DESC
    ";
   
}
else if ($item_name == "" && $location ==""){


    $query = "
        SELECT * FROM damage_stock 
        WHERE item_category LIKE '%".$category."%'  
        AND date BETWEEN 
        '$start_date' AND '$end_date' ORDER BY id DESC
    ";
   
}


else if ($category =="" && $item_name == ""  && $location ==""){


    $query = "
        SELECT * FROM damage_stock 
        WHERE date BETWEEN 
        '$start_date' AND '$end_date'
        ORDER BY id DESC
    ";
    
    
}

else if ($item_name == "" && $start_date == "" && $end_date == ""  && $location ==""){


    $query = "
        SELECT * FROM damage_stock WHERE item_category LIKE '%".$category."%' ORDER BY id DESC
    ";
    
    
}

else if ($start_date == "" && $end_date == ""  && $location ==""){


    $query = "
        SELECT * FROM damage_stock WHERE item_category LIKE '%".$category."%' 
        AND item_name LIKE '%".$item_name."%' ORDER BY id DESC
    ";
    
    
}

else if ($start_date == "" && $end_date == ""){


    $query = "
        SELECT * FROM damage_stock WHERE item_category LIKE '%".$category."%' 
        AND item_name LIKE '%".$item_name."%' 
        AND location LIKE '%".$location."%' ORDER BY id DESC
    ";
    
    
}

else if ($end_date == ""  && $location ==""){


    $query = "
        SELECT * FROM damage_stock WHERE item_category LIKE '%".$category."%'
        AND item_name LIKE '%".$item_name."%' 
        AND date LIKE '%".$start_date."%' date ORDER BY id DESC
    ";
    
    
}





else if ($start_date == "" && $end_date == ""  && $item_name =="" && $category ==""){


    $query = "
        SELECT * FROM damage_stock WHERE location LIKE '%".$location."%' ORDER BY id DESC
    ";
    
    
}



    //querry database and out result
    
    $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {
                    $output .= '<table>
                                <thead>
                                    <tr>
                                    <th  style="background-color:#A66DD4;">ID</th>
                                    <th  style="background-color:#A66DD4;">Category</th>
                                    <th  style="background-color:#A66DD4;">Item Name</th>
                                    <th  style="background-color:#A66DD4;">Description</th>
                                    <th  style="background-color:#A66DD4;">Qty.</th>
                                    <th  style="background-color:#A66DD4;">Unit Price</th>
                                    <th  style="background-color:#A66DD4;">Total Price</th>
                                    <th style="background-color:#A66DD4;">Location</th>
                                    <th style="background-color:#A66DD4;">Entry Date</th>

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




    
}



elseif($report_type == "new_stock"){



    if ($category =="" && $item_name == "" && $start_date == "" && $end_date == "" && $location ==""){

   
        $query = "
            SELECT * FROM new_stock ORDER BY id DESC
        ";
}

else if (isset($category) && isset($item_name) && isset($start_date) && isset($end_date) && isset($location)){


    $query = "
        SELECT * FROM new_stock WHERE item_category LIKE '%".$category."%'
        AND item_name LIKE '%".$item_name."%' 
        AND date BETWEEN 
        '$start_date' AND '$end_date' 
        AND location LIKE '%".$location."%' ORDER BY id DESC
    ";
    
    
}


else if ($category =="" && $item_name == "" && $end_date == ""  && $location ==""){


    $query = "
        SELECT * FROM new_stock 
        WHERE date LIKE '%".$start_date."%' ORDER BY id DESC
    ";
   
}


else if ($item_name == "" && $end_date == ""  && $location ==""){


    $query = "
        SELECT * FROM new_stock 
        WHERE item_category LIKE '%".$category."%'  
        AND date LIKE '%".$start_date."%' ORDER BY id DESC
    ";
   
}
else if ($item_name == "" && $location ==""){


    $query = "
        SELECT * FROM new_stock 
        WHERE item_category LIKE '%".$category."%'  
        AND date BETWEEN 
        '$start_date' AND '$end_date' ORDER BY id DESC
    ";
   
}


else if ($category =="" && $item_name == ""  && $location ==""){


    $query = "
        SELECT * FROM new_stock 
        WHERE date BETWEEN 
        '$start_date' AND '$end_date'
        ORDER BY id DESC
    ";
    
    
}

else if ($item_name == "" && $start_date == "" && $end_date == ""  && $location ==""){


    $query = "
        SELECT * FROM new_stock WHERE item_category LIKE '%".$category."%' ORDER BY id DESC
    ";
    
    
}

else if ($start_date == "" && $end_date == ""  && $location ==""){


    $query = "
        SELECT * FROM new_stock WHERE item_category LIKE '%".$category."%' 
        AND item_name LIKE '%".$item_name."%' ORDER BY id DESC
    ";
    
    
}

else if ($start_date == "" && $end_date == ""){


    $query = "
        SELECT * FROM new_stock WHERE item_category LIKE '%".$category."%' 
        AND item_name LIKE '%".$item_name."%' 
        AND location LIKE '%".$location."%' ORDER BY id DESC
    ";
    
    
}

else if ($end_date == ""  && $location ==""){


    $query = "
        SELECT * FROM new_stock WHERE item_category LIKE '%".$category."%'
        AND item_name LIKE '%".$item_name."%' 
        AND date LIKE '%".$start_date."%' date ORDER BY id DESC
    ";
    
    
}





else if ($start_date == "" && $end_date == ""  && $item_name =="" && $category ==""){


    $query = "
        SELECT * FROM new_stock WHERE location LIKE '%".$location."%' ORDER BY id DESC
    ";
    
    
}

    //querry database and out result
    
    $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {
                    $output .= '<table>
                                <thead>
                                    <tr>
                                    <th  style="background-color:#A66DD4;">ID</th>
                                    <th  style="background-color:#A66DD4;">Category</th>
                                    <th  style="background-color:#A66DD4;">Item Name</th>
                                    <th  style="background-color:#A66DD4;">Description</th>
                                    <th  style="background-color:#A66DD4;">Qty.</th>
                                    <th  style="background-color:#A66DD4;">Unit Price</th>
                                    <th  style="background-color:#A66DD4;">Total Price</th>
                                    <th style="background-color:#A66DD4;">Location</th>
                                    <th style="background-color:#A66DD4;">Delivered By</th>
                                    <th style="background-color:#A66DD4;">Received By</th>
                                    <th style="background-color:#A66DD4;">Entry Date</th>
                                    <th style="background-color:#A66DD4;">Expiration</th>

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
                                <td>'.$row["delivered_by"].'</td>
                                <td>'.$row["received_by"].'</td>
                                <td>'.$row["date"].'</td>
                                <td>'.$row["exp_date"].'</td>
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
    
}



elseif($report_type == "stock"){

    
    if ($category =="" && $item_name == "" && $location ==""){

   
        $query = "
            SELECT * FROM stock ORDER BY id DESC
        ";
    }

    else if (isset($category) && isset($item_name) && isset($location)){


        $query = "
            SELECT * FROM stock WHERE item_category LIKE '%".$category."%'
            AND item_name LIKE '%".$item_name."%' 
            AND location LIKE '%".$location."%' ORDER BY id DESC
        ";
        
        
    }

    else if ($category =="" && $item_name == "" && isset($location)){


        $query = "
            SELECT * FROM stock WHERE location LIKE '%".$location."%' ORDER BY id DESC
        ";
        
        
    }



    //querry database and out result
    
    $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {
                    $output .= '<table>
                                <thead>
                                    <tr>
                                    <th  style="background-color:#A66DD4;">ID</th>
                                    <th  style="background-color:#A66DD4;">Category</th>
                                    <th  style="background-color:#A66DD4;">Item Name</th>
                                    <th  style="background-color:#A66DD4;">Description</th>
                                    <th  style="background-color:#A66DD4;">Total Qty.</th>
                                    <th  style="background-color:#A66DD4;">Total Worth</th>
                                    <th style="background-color:#A66DD4;">Location</th>

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
                                <td>'.$row["total_qty"].'</td>
                                <td>'.$row["item_price"].'</td>
                                <td>'.$row["location"].'</td>
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



}




elseif($report_type == "out_stock"){



    if ($category =="" && $item_name == "" && $start_date == "" && $end_date == "" && $location ==""){

   
        $query = "
            SELECT * FROM out_stock ORDER BY id DESC
        ";
}

else if (isset($category) && isset($item_name) && isset($start_date) && isset($end_date) && isset($location)){


    $query = "
        SELECT * FROM out_stock WHERE item_category LIKE '%".$category."%'
        AND item_name LIKE '%".$item_name."%' 
        AND date BETWEEN 
        '$start_date' AND '$end_date' 
        AND location LIKE '%".$location."%' ORDER BY id DESC
    ";
    
    
}


else if ($category =="" && $item_name == "" && $end_date == ""  && $location ==""){


    $query = "
        SELECT * FROM out_stock 
        WHERE date LIKE '%".$start_date."%' ORDER BY id DESC
    ";
   
}


else if ($item_name == "" && $end_date == ""  && $location ==""){


    $query = "
        SELECT * FROM out_stock 
        WHERE item_category LIKE '%".$category."%'  
        AND date LIKE '%".$start_date."%' ORDER BY id DESC
    ";
   
}
else if ($item_name == "" && $location ==""){


    $query = "
        SELECT * FROM out_stock 
        WHERE item_category LIKE '%".$category."%'  
        AND date BETWEEN 
        '$start_date' AND '$end_date' ORDER BY id DESC
    ";
   
}


else if ($category =="" && $item_name == ""  && $location ==""){


    $query = "
        SELECT * FROM out_stock 
        WHERE date BETWEEN 
        '$start_date' AND '$end_date'
        ORDER BY id DESC
    ";
    
    
}

else if ($item_name == "" && $start_date == "" && $end_date == ""  && $location ==""){


    $query = "
        SELECT * FROM out_stock WHERE item_category LIKE '%".$category."%' ORDER BY id DESC
    ";
    
    
}

else if ($start_date == "" && $end_date == ""  && $location ==""){


    $query = "
        SELECT * FROM out_stock WHERE item_category LIKE '%".$category."%' 
        AND item_name LIKE '%".$item_name."%' ORDER BY id DESC
    ";
    
    
}

else if ($start_date == "" && $end_date == ""){


    $query = "
        SELECT * FROM out_stock WHERE item_category LIKE '%".$category."%' 
        AND item_name LIKE '%".$item_name."%' 
        AND location LIKE '%".$location."%' ORDER BY id DESC
    ";
    
    
}

else if ($end_date == ""  && $location ==""){


    $query = "
        SELECT * FROM out_stock WHERE item_category LIKE '%".$category."%'
        AND item_name LIKE '%".$item_name."%' 
        AND date LIKE '%".$start_date."%' date ORDER BY id DESC
    ";
    
    
}





else if ($start_date == "" && $end_date == ""  && $item_name =="" && $category ==""){


    $query = "
        SELECT * FROM out_stock WHERE location LIKE '%".$location."%' ORDER BY id DESC
    ";
    
    
}

    //querry database and out result
    
    $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {
                    $output .= '<table>
                                <thead>
                                    <tr>
                                    <th  style="background-color:#A66DD4;">ID</th>
                                    <th  style="background-color:#A66DD4;">Category</th>
                                    <th  style="background-color:#A66DD4;">Item Name</th>
                                    <th  style="background-color:#A66DD4;">Description</th>
                                    <th  style="background-color:#A66DD4;">Qty.</th>
                                    <th  style="background-color:#A66DD4;">Unit Price</th>
                                    <th  style="background-color:#A66DD4;">Total Price</th>
                                    <th style="background-color:#A66DD4;">Location</th>
                                    <th style="background-color:#A66DD4;">Requested By</th>
                                    <th style="background-color:#A66DD4;">Authorized By</th>
                                    <th style="background-color:#A66DD4;">Approved by</th>
                                    <th style="background-color:#A66DD4;">Date</th>

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
    
}





elseif($report_type == "transfer_stock"){

    if ($category =="" && $item_name == "" && $start_date == "" && $end_date == "" && $location ==""){

   
        $query = "
            SELECT * FROM transfer_stock ORDER BY id DESC
        ";
    }
    
    else if (isset($category) && isset($item_name) && isset($start_date) && isset($end_date) && isset($location)){
    
    
    $query = "
        SELECT * FROM transfer_stock WHERE item_category LIKE '%".$category."%'
        AND item_name LIKE '%".$item_name."%' 
        AND date BETWEEN 
        '$start_date' AND '$end_date' 
        AND transfer_from LIKE '%".$location."%' ORDER BY id DESC
    ";
    
    
    }
    
    
    else if ($category =="" && $item_name == "" && $end_date == ""  && $location ==""){
    
    
    $query = "
        SELECT * FROM transfer_stock 
        WHERE date LIKE '%".$start_date."%' ORDER BY id DESC
    ";
    
    }
    
    
    else if ($item_name == "" && $end_date == ""  && $location ==""){
    
    
    $query = "
        SELECT * FROM transfer_stock 
        WHERE item_category LIKE '%".$category."%'  
        AND date LIKE '%".$start_date."%' ORDER BY id DESC
    ";
    
    }
    else if ($item_name == "" && $location ==""){
    
    
    $query = "
        SELECT * FROM transfer_stock 
        WHERE item_category LIKE '%".$category."%'  
        AND date BETWEEN 
        '$start_date' AND '$end_date' ORDER BY id DESC
    ";
    
    }
    
    
    else if ($category =="" && $item_name == ""  && $location ==""){
    
    
    $query = "
        SELECT * FROM transfer_stock 
        WHERE date BETWEEN 
        '$start_date' AND '$end_date'
        ORDER BY id DESC
    ";
    
    
    }
    
    else if ($item_name == "" && $start_date == "" && $end_date == ""  && $location ==""){
    
    
    $query = "
        SELECT * FROM transfer_stock WHERE item_category LIKE '%".$category."%' ORDER BY id DESC
    ";
    
    
    }
    
    else if ($start_date == "" && $end_date == ""  && $location ==""){
    
    
    $query = "
        SELECT * FROM transfer_stock WHERE item_category LIKE '%".$category."%' 
        AND item_name LIKE '%".$item_name."%' ORDER BY id DESC
    ";
    
    
    }
    
    else if ($start_date == "" && $end_date == ""){
    
    
    $query = "
        SELECT * FROM transfer_stock WHERE item_category LIKE '%".$category."%' 
        AND item_name LIKE '%".$item_name."%' 
        AND transfer_from LIKE '%".$location."%' ORDER BY id DESC
    ";
    
    
    }
    
    else if ($end_date == ""  && $location ==""){
    
    
    $query = "
        SELECT * FROM transfer_stock WHERE item_category LIKE '%".$category."%'
        AND item_name LIKE '%".$item_name."%' 
        AND date LIKE '%".$start_date."%' date ORDER BY id DESC
    ";
    
    
    }
    
    
    
    
    
    else if ($start_date == "" && $end_date == ""  && $item_name =="" && $category ==""){
    
    
    $query = "
        SELECT * FROM transfer_stock WHERE transfer_from LIKE '%".$location."%' ORDER BY id DESC
    ";
    
    
    }
    
    //querry database and out result
    
    $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {
                    $output .= '<table>
                                <thead>
                                    <tr>
                                    <th  style="background-color:#A66DD4;">ID</th>
                                    <th  style="background-color:#A66DD4;">Category</th>
                                    <th  style="background-color:#A66DD4;">Item Name</th>
                                    <th  style="background-color:#A66DD4;">Description</th>
                                    <th  style="background-color:#A66DD4;">Qty.</th>
                                    <th  style="background-color:#A66DD4;">Unit Price</th>
                                    <th  style="background-color:#A66DD4;">Total Price</th>
                                    <th style="background-color:#A66DD4;">Transfer From</th>
                                    <th style="background-color:#A66DD4;">Transfer To</th>
                                    <th style="background-color:#A66DD4;">Date</th>
                                    <th style="background-color:#A66DD4;">Expiration Date</th>
    
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
                                <td>'.$row["transfer_from"].'</td>
                                <td>'.$row["transfer_to"].'</td>
                                <td>'.$row["date"].'</td>
                                <td>'.$row["exp_date"].'</td>
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
    
}




else if($report_type == "low_stock"){

    if ($category =="" && $item_name == "" && $location =="" && $low_stock_qty ==""){

   
        $query = "
            SELECT * FROM stock ORDER BY id DESC
        ";
    }

    else if (isset($category) && isset($item_name) && isset($location) && isset($low_stock_qty)){


        $query = "
        SELECT * FROM stock WHERE item_category LIKE '%".$category."%' 
        AND item_name LIKE '%".$item_name."%' 
        AND total_qty <= $low_stock_qty 
        AND location LIKE '%".$location."%' ORDER BY id DESC
        ";
        
        
    }

    else if ($category =="" && $item_name =="" && isset($location)){


        $query = "
            SELECT * FROM stock WHERE location LIKE '%".$location."%' ORDER BY id DESC
        ";
        
        
    }


    else if ($category =="" && $item_name == "" && isset($low_stock_qty) && isset($location)){


        $query = "
            SELECT * FROM stock WHERE location LIKE '%".$location."%' 
            AND total_qty <= $low_stock_qty ORDER BY id DESC
        ";
        
        
    }


    else if ($category =="" && $item_name == "" && isset($low_stock_qty) && $location ==""){


        $query = "
            SELECT * FROM stock WHERE total_qty <= $low_stock_qty ORDER BY id DESC
        ";
        
        
    }

    else if (isset($category) && $item_name =="" && isset($location) && isset($low_stock_qty)){


        $query = "
            SELECT * FROM stock WHERE item_category LIKE '%".$category."%' 
            AND location LIKE '%".$location."%' 
            AND total_qty <= $low_stock_qty ORDER BY id DESC
        ";
        
        
    }

    



    //querry database and out result
    
    $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {
                    $output .= '<table>
                                <thead>
                                    <tr>
                                    <th  style="background-color:#A66DD4;">ID</th>
                                    <th  style="background-color:#A66DD4;">Category</th>
                                    <th  style="background-color:#A66DD4;">Item Name</th>
                                    <th  style="background-color:#A66DD4;">Description</th>
                                    <th  style="background-color:#A66DD4;">Total Qty.</th>
                                    <th  style="background-color:#A66DD4;">Total Worth</th>
                                    <th style="background-color:#A66DD4;">Location</th>

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
                                <td>'.$row["total_qty"].'</td>
                                <td>'.$row["item_price"].'</td>
                                <td>'.$row["location"].'</td>
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

}

?>