<?php
//echo 'new';
define('DB_HOST','localhost');
define('DB_USER','ugceip03xsv1s');
define('DB_PASS','629}#12@1+~1');
define('DB_NAME','dbcia4hlgau9gt');
//define('BASE_URL','http://gauravb59.sg-host.com/');
$con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
// Check connection 
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL==>: " . mysqli_connect_error();
}
?>