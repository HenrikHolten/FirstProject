<?php
$host = 'localhost';
$db   = 'c7l4mz4rc_himandher_dk';
$user = 'c7l4mz4rc_himandher_dk';
$pass = getenv('DB_PASSWORD') ?: 'DIN_LOKALE_ADGANGSKODE';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<h3>Forbindelse til databasen lykkedes!</h3>";
} catch (\PDOException $e) {
    echo "<h3>Forbindelse fejlede:</h3> " . $e->getMessage();
}
?>