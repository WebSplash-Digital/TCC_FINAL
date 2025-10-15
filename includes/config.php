<?php 
// DB credentials .
define('DB_HOST','localhost');
define('DB_USER','ugceip03xsv1s');
define('DB_PASS','629}#12@1+~1');
define('DB_NAME','dbcia4hlgau9gt');
define('BASE_URL','http://gauravb59.sg-host.com/');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS);
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>