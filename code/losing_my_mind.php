<?php

echo "Start of losing_my_mind.php<br>";
include __DIR__.'./db_connect.php';

try {
    $conn = getDatabaseConnection();
    echo "Connected to the database successfully!!!!!<br>";

    
    $schema_file = __DIR__ . '/schema.sql';
    if (!file_exists($schema_file)) {
        die("Error: schema.sql file not found!");
    }
    
    $schema = file_get_contents($schema_file);
    echo "Schema file loaded!<br>";

    $conn->exec($schema);
    echo "Tables created!!!!!<br>";

    echo "Setup finished!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>