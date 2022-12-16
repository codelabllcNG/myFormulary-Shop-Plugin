<?php

session_start();


  // 1. destroy the session data on disk.
 
  session_destroy();

  
  // 3. destroy the $_SESSION superglobal array.
  
 //Unset the $_SESSION array value



unset($_SESSION['stock_user_id']);
unset($_SESSION['stock_user_status']);


header('Location:../index.php?logout="logged out"');
?>