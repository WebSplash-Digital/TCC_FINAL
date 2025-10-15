<?php
include('dbconnection.php');
//print_r($conn);die;
error_reporting(E_ALL);
//get user name by user id
$price = 10;
function getUserName($userId){

    $query ="SELECT * from tbljobseekers where id=".$userId;
    global $conn;
    $result = mysqli_query($conn,$query );
    $data = mysqli_fetch_array($result);
    return $data['FullName'];
    
} 

//Get job title by job id 
function getJobTitle($jobId){
    $query ="SELECT * from tbljobs where jobId=".$jobId;
    global $conn;
     $result = mysqli_query($conn,$query );
     $data = mysqli_fetch_array($result);
      //echo '===>'.count($data);
      // if(!empty($data)){
      //   return $data['jobTitle'];
      // }else{
      //   return null;
      // }
      return $data['jobTitle'];
     
}



