<?php

if ($category =="" && $item_name == "" && $start_date == "" && $end_date == "" && $location ==""){

   
            $query = "
                SELECT * FROM new_stock ORDER BY id DESC
            ";
    }

    else if ($category !="" && $item_name != "" && $start_date != "" && $end_date != "" && $location !=""){

   
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


    ?>