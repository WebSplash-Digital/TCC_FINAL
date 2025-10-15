<?php 
// die;
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','ugmfcgwjmrsel');
define('DB_PASS','&z1ex#624c#*');
define('DB_NAME','dbcia4hlgau9gt');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS);
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>