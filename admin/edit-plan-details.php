<?php
include('../includes/config.php');
foreach($_POST['option'] as $k => $v) {

 //   echo "<br>".$sql_insert  = "insert into plan_details (plan_id, sub_id, plan_option, plan_value) values ('$plan_id', '".$new_id."', '".$_POST['option'][$y-1]."', '".$ov."')";  //".$_POST['val'][$ok]."
 //   mysqli_query($con,$sql_insert);
 $id = $_POST['id'][$k];
 $sql1="update plan_details set plan_value=:plan_value where id=:id";
 $query = $dbh->prepare($sql1);

 // Binding Post Values
 $query->bindParam(':plan_value', $v, PDO::PARAM_STR);
 $query->bindParam(':id', $id, PDO::PARAM_STR);

 $query->execute();

}
header('location:view-plans.php');
?>