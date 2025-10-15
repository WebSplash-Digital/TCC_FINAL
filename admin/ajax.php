<?php 
// print_r($_POST['status']);
// print_r($_POST['id']);
// die;
include('shop_include/config.php');
$status = $_POST['status'];
$id = $_POST['id'];

$sql="update tblapplyjob set Status='$status' where ID=".$id;
$query=$dbh->prepare($sql);
//$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
echo 'Job Status Updated successfully .';
// echo "<script></script>";

?>