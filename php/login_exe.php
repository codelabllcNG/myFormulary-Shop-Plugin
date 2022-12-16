<?php
	//Start session
	session_start();
	
	//Include database connection details
	include('dbconnection.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	

	
	//Sanitize the POST values
	$email = $_POST['username'];
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$email = trim($email);

	$pass = $_POST['pass'];
	$pass= filter_var($pass, FILTER_SANITIZE_EMAIL);
	$pass = trim($pass);

	//hashing

	$hash_pass = $pass;
	$padded = "kas_stock";



	$pass_hash = hash_hmac('sha256', $hash_pass, $padded);


	$tableusers = "users";
	
	//Input Validations

	//echo $email;
	//echo $pass;
	
	if($email == '') {
		$errmsg_arr[] = 'Your Username is missing';
		$errflag = true;
	}
	
	if($pass == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		echo $_SESSION['ERRMSG_ARR'];
		header('location: ../index.php?status="VALIDATION ERROR"');
		exit();
	}
	
	
	//Create query
	$sql = "SELECT * FROM `$tableusers` WHERE `username` = '$email' AND `password` = '$pass_hash'";
	$result=mysqli_query($conn, $sql);
	

if ($result && mysqli_num_rows($result) == 1) {
	//Login Successful
			$space ="&nbsp";
			session_regenerate_id();
			$user = mysqli_fetch_assoc($result);
			$_SESSION['stock_user_id'] = $user['username'];
			$_SESSION['stock_user_status'] = $user['status'];
			
		if($user['status'] == "admin"){
			session_write_close();
			
			header("location: ../admin/dashboard.php");

		}elseif($user['status'] == "regular"){
			session_write_close();
			
			header("location: ../dashboard.php");

		}

			
			
}else{

header('location: ../index.php?status="failed"');

}

		
		
?>