<?php
session_start();
error_reporting(1);
 include('includes/config.php');
 include('function.inc.php');
 $brand = implode("','", $_POST['brand']);
 
if(isset($_POST['id'])) {
    $catid = $_POST['id'];
   // $brand = implode("','", $_POST['brand']['chk']);
    if(isset($_POST['sort'])) {
        $products =  getShopProductsByBrand( $catid,  $brand, $_POST['sort'] );
    } else {
    $products =  getShopProductsByBrand( $catid,  $brand, $_POST['sort'] );
    }
echo json_encode( $products);
} else {
   // echo "No input";
} 
?>