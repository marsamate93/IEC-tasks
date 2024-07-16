<?php
require 'vendor/autoload.php'; // Autoload MongoDB library

// MongoDB kliens inicializálása
$client = new MongoDB\Client("mongodb://localhost:27017");

try {
    // Az adatbázisok listázása
    $databases = $client->listDatabases();
    echo "Kapcsolódás sikeres. Elérhető adatbázisok:\n";
    
    // Adatbázisok kiíratása
    foreach ($databases as $database) {
        echo $database['name'] . "\n";
    }
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "Hiba történt: " . $e->getMessage();
}
?>
