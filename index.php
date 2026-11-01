<?php
// Database forbindelsesdetaljer
require __DIR__ . '/config.php';

$beskeder = [];
$antal_beskeder = 0;

// Opret forbindelse og hent de sidste 10 beskeder
$con = mysqli_connect($host, $user, $pass, $db);
if ($con) {
    // Tæl det samlede antal registrerede beskeder
    $count_result = mysqli_query($con, "SELECT COUNT(*) AS antal FROM besked_tabel");
    if ($count_result) {
        $antal_beskeder = (int) mysqli_fetch_assoc($count_result)['antal'];
    }


    // Hent op til 10 beskeder sorteret efter nyeste først
    $result = mysqli_query($con, "SELECT navn, besked, oprettet_tid FROM besked_tabel ORDER BY id DESC LIMIT 10");
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $beskeder[] = $row;
        }
    }
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="da">
<head>
    <meta charset="UTF-8">
    <title>Velkommen til min side</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; line-height: 1.6; color: #333; }
        .container { max-width: 600px; }
        .btn { display: inline-block; padding: 10px 15px; background-color: #0078D7; color: white; text-decoration: none; border-radius: 4px; margin-bottom: 20px; }
        .btn:hover { background-color: #005a9e; }
        .besked-card { background: #f9f9f9; border-left: 4px solid #0078D7; padding: 12px 15px; margin-bottom: 10px; border-radius: 0 4px 4px 0; }
        .besked-card h4 { margin: 0 0 5px 0; color: #0078D7; }
        .besked-card p { margin: 0; }
        .tid { font-size: 0.85em; color: #666; margin-top: 5px; display: block; }
        .antal { font-size: 1.1em; color: #0078D7; }
        .gemt { font-weight: bold; color: green; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Velkommen til min side med Github test</h1>
        <p>Her kan du se de seneste beskeder, der er blevet sendt ind via systemet, eller oprette din egen besked.</p>

        <!-- Link til formularen -->
        <a href="formular.php" class="btn">Gå til formular for at skrive en besked</a>

        <?php if (isset($_GET['gemt'])): ?>
            <p class="gemt">Tak! Din besked blev gemt i databasen.</p>
        <?php endif; ?>

        <p class="antal">Antal registrerede beskeder: <strong><?php echo $antal_beskeder; ?></strong></p>

        <h2>Sidste 10 beskeder</h2>

        <?php if (empty($beskeder)): ?>
            <p>Der er ikke nogen beskeder i databasen endnu.</p>
        <?php else: ?>
            <?php foreach ($beskeder as $b): ?>
                <div class="besked-card">
                    <h4><?php echo htmlspecialchars($b['navn']); ?></h4>
                    <p><?php echo nl2br(htmlspecialchars($b['besked'])); ?></p>
                    <span class="tid"><?php echo $b['oprettet_tid']; ?></span>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</body>
</html>