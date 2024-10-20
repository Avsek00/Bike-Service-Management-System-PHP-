<?php

$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "bscmss"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if(!$conn)
{
    header("Location: ../errors/dberror.php");
    // die(mysqli_connect_errno($conn));
    die();
}
// else{
//     echo "database connected";
// }

?>