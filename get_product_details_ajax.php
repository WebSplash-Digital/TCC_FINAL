<?php
include('includes/config.php');
include('function.inc.php');
 //echo "Ajax :".$_POST['id'];


if(isset($_POST['id'])) {
    $pid = $_POST['id'];
    if(isset($_POST['sort'])) {
        $products =  getShopProducts( $pid, '', $_POST['sort'] );
    } else {
    $products =  getShopProducts( $pid, '', '' );
}
  // echo json_encode($data[0]);
 //return json_encode($arr);
//  echo "<pre>";
//  print_r( $products);
//  echo "</pre>";

 //  $array = array('plan_name' => $plan[0]->plan_title,'description' => $plan[0]->plan_desc,'plan_head' => $plan_head, 'plan_body' => $plan_body, 'banner1'=> 'images/banners/'.$plan[0]->banner1, 'banner2'=> 'images/banners/'.$plan[0]->banner2, 'banner3'=> $plan[0]->banner3);
echo json_encode( $products);
} else {
  
  // echo "No input";
} 



?>