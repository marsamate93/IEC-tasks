<?php
require 'vendor/autoload.php';

try {
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $client->ingatlanok_db->ingatlanok;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['kereses'])) {
        $kereses = $_POST['kereses'];
        $ingatlanok = $collection->find(['cím' => new MongoDB\BSON\Regex($kereses, 'i')]);
    } else {
        $ingatlanok = $collection->find();
    }

    $ingatlanokArray = iterator_to_array($ingatlanok);
    if (empty($ingatlanokArray)) {
        echo "Nincs adat az adatbázisban.";
    }

} catch (Exception $e) {
    die("Hiba történt a MongoDB kapcsolat létrehozásakor: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Eladó ingatlanok</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Eladó ingatlanok</h1>

        <form method="post" class="mb-4">
            <div class="form-group">
                <label for="kereses">Keresés</label>
                <input type="text" name="kereses" id="kereses" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Keresés</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Cím</th>
                    <th>Ár</th>
                    <th>Állapot</th>
                    <th>Elhelyezkedés</th>
                    <th>Méret (m²)</th>
                    <th>Felszereltség</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (!empty($ingatlanokArray)):
                    foreach ($ingatlanokArray as $ingatlan): 
                        error_log(print_r($ingatlan, true));
                ?>
                    <tr>
                        <td><?= htmlspecialchars($ingatlan['cím']) ?></td>
                        <td><?= htmlspecialchars($ingatlan['ár']) ?> Ft</td>
                        <td><?= htmlspecialchars($ingatlan['állapot']) ?></td>
                        <td><?= htmlspecialchars($ingatlan['elhelyezkedés']) ?></td>
                        <td><?= htmlspecialchars($ingatlan['méret']) ?></td>
                        <td><?= htmlspecialchars($ingatlan['felszereltség']) ?></td>
                    </tr>
                <?php 
                    endforeach; 
                else:
                    echo '<tr><td colspan="6">Nincs adat az adatbázisban.</td></tr>';
                endif; 
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
