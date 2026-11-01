<?php
// Database forbindelsesdetaljer
require __DIR__ . '/config.php';

$meddelelse = "";

// Tjek om formularen er blevet sendt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $navn = $_POST['navn'] ?? '';
    $besked = $_POST['besked'] ?? '';

    if (!empty($navn) && !empty($besked)) {
        $con = mysqli_connect($host, $user, $pass, $db);
        if ($con) {
            // Brug prepared statements for at undgå SQL-injections
            $stmt = mysqli_prepare($con, "INSERT INTO besked_tabel (navn, besked) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, "ss", $navn, $besked);
            
            $gemt = mysqli_stmt_execute($stmt);
            if (!$gemt) {
                $meddelelse = "Fejl ved lagring: " . mysqli_error($con);
            }

            mysqli_stmt_close($stmt);
            mysqli_close($con);

            // Send brugeren tilbage til forsiden når beskeden er gemt
            if ($gemt) {
                header("Location: index.php?gemt=1");
                exit;
            }
        } else {
            $meddelelse = "Forbindelsesfejl til database.";
        }
    } else {
        $meddelelse = "Udfyld venligst begge felter.";
    }
}
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <title>Skriv en besked</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        form { max-width: 400px; display: flex; flex-direction: column; gap: 15px; }
        input, textarea { padding: 8px; font-size: 14px; }
        button { padding: 10px; background-color: #0078D7; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #005a9e; }
        .besked { margin-top: 15px; font-weight: bold; color: green; }
    </style>
</head>
<body>

    <h2>Skriv en besked til databasen</h2>
    
    <form method="POST" action="">
        <label for="navn">Navn / Titel:</label>
        <input type="text" id="navn" name="navn" required>

        <label for="besked">Besked:</label>
        <textarea id="besked" name="besked" rows="5" required></textarea>

        <button type="submit">Gem i database</button>
    </form>

    <?php if (!empty($meddelelse)): ?>
        <p class="besked"><?php echo htmlspecialchars($meddelelse); ?></p>
    <?php endif; ?>

</body>
</html>