<?php
 
//online host settings
 /*   $host_name  = "asolarnig.com.mysql";
    $database   = "asolarnig_com_finance";
    $user_name  = "asolarnig_com_finance";
    $password   = "@s0l@rn1g@";
*/
//local settings
$host_name  = "localhost";
    $database   = "kass_stock";
    $user_name  = "root";
    $password   = "";


$conn = mysqli_connect($host_name, $user_name, $password);
if (!$conn) {
    echo "Error: Unable to connect to trakid Database Server." ;
    exit;
}


//name of database to select from
$db=mysqli_select_db($conn, $database) or
 die(mysqli_error());

/*if (!$db){
	echo "No database selected";
}
*/
//echo "database selected ". $database;

?>

