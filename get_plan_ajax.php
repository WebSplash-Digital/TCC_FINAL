<?php
session_start();
error_reporting(1);
 include('includes/config.php');
 include('function.inc.php');
// echo "Ajax :".$_POST['id'];


if(isset($_POST['id'])) {
     $pid = $_POST['id'];
     $plan =  getPlanMst($pid); 
   // echo json_encode($data[0]);
  //return json_encode($arr);
  $plan_details= getPlanDetails($pid );
  $cnt=1;
  foreach($plan_details as $row)
  {
      //echo "<br>".$cnt;
      if($row->sub_id == 1) {
          $header[] = $row->plan_option;
      }
      $sub[$row->sub_id] = $row->sub_id;
      $values[$row->plan_option][$row->sub_id] = $row->plan_value;
      $cnt++;
  } 

    $plan_head = '<tr>';
    foreach($header as $k => $v) {
        $plan_head .="<th>$v</th>";	
    } 
    $plan_head .= '<tr>';
  //  echo $trhead;
  $plan_body = '';
  foreach($sub as $k => $v) {
    $plan_body .= "<tr>";	
     foreach($header as  $hk => $hv) {
         $plan_body .="<td> ".$values[$hv][$v]."</td>";	
    }
    $plan_body .="</tr>";	
  }
    $array = array('plan_name' => $plan[0]->plan_title,'description' => $plan[0]->plan_desc,'plan_head' => $plan_head, 'plan_body' => $plan_body, 'banner1'=> 'images/banners/'.$plan[0]->banner1, 'banner2'=> 'images/banners/'.$plan[0]->banner2, 'banner3'=> 'images/banners/'.$plan[0]->banner3);
echo json_encode($array);
} else {
   
   // echo "No input";
} 
?>