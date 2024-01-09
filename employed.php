<?php
 include_once 'dbConnection.php';
session_start();
$appl_id=$_GET['apid'];
if(isset($appl_id)){
  $sql = "UPDATE user SET status = '0',employment='1' WHERE id = '$appl_id'";
  if($con->query($sql)){
    header("location:dash.php?q=2");
    $_SESSION['success'] = 'Candidate updated successfully';
  }
  else{
    $_SESSION['error'] = $con->error;
  }}else{
    header("location:dash.php?q=2");
  }
