<?php
$db_server = "localhost";
$db_name   = "attendence";
$db_user   = "root";
$db_pass   = "";

try {
    $conn= mysqli_connect($db_server,
                          $db_user, 
                          $db_pass,
                           $db_name);
} 
catch (mysqli_sql_exception) 
{
    echo "Connection failed: " ;
}
?>
