<?php
$host = 'localhost';
$user = 'c7l4mz4rc_himandher_dk';
$pass = 'Vector01';
$db   = 'c7l4mz4rc_himandher_dk';

$con = mysqli_connect($host, $user, $pass, $db);

if (!$con) {
    die("Forbindelse fejlede: " . mysqli_connect_error());
}

echo "<h3>Forbindelse til databasen lykkedes via MySQLi!</h3>";
mysqli_close($con);
?>