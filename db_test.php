<?php
// Database forbindelsesdetaljer
require __DIR__ . '/config.php';

$con = mysqli_connect($host, $user, $pass, $db);

if (!$con) {
    die("Forbindelse fejlede: " . mysqli_connect_error());
}

echo "<h3>Forbindelse til databasen lykkedes via MySQLi!</h3>";
mysqli_close($con);
?>