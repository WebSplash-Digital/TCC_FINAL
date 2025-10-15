<?php
session_start();
error_reporting(1);
include('includes/config.php');
include('function.inc.php');
//echo "Ajax :".$_POST['id'];
if(isset($_POST['id'])) {
     $pid = $_POST['id'];
    $data = getProductDetail($pid );
    echo json_encode($data[0]);
  //return json_encode($arr);
} else {
   
   // echo "No input";
}
?>