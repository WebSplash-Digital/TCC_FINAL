<?php
session_start();
error_reporting(0);
require_once('../includes/config.php');
require_once('../function.inc.php');
include('shop_include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

    $dt =date("Y-m-d H:i:s");
    $sql="update contact_details set reply_msg = :reply_msg, updated_at = '".$dt."' where id = :id";
                $query = $dbh->prepare($sql);
                // Binding Post Values
                $query->bindParam(':reply_msg', $_POST['reply'], PDO::PARAM_STR);
                $query->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
                $query->execute();
            
                $sql = "select contact_name, contact_email from contact_details where id = '".$_POST['id']."'";
             
$query=mysqli_query($con,$sql);
$cnt=1;
while($row=mysqli_fetch_array($query))
{
    $name = $row['contact_name'];
    $email = $row['contact_email'];
}
                // Send an email
                // Receipt to Sender
                $subject = "Response to your request";
                $message = "Dear ".$name.",\n\n <p>Response to your query</p> \n".$_POST['reply']." \n\n <p>Regards TCC Mobile</p>";
                $message = "<html><body>".$message."</body></html>";
                sendMail($name, $email, $subject, $message);
                // Mail to the concerned dept
                /*
                $subject = "Request";
                $message = "Dear ".$_POST['Name'].",\n\n Name : ".$_POST['Name']." \nName : ".$_POST['Name']." \nEmail : ".$_POST['Email']." \nPhone : ".$_POST['phone']." \nType : ".$_POST['classification']."\nMessage : ".$_POST['message']." \n \n\n Regards TCC Mobile";
                $message = "<html><body>".$message."</body></html>";
               // sendMail('freeman','freeman.rodrigues@gmail.com', $subject, $message);
                 */
echo "OK";
} 
?>