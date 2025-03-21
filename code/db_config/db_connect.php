<?php
function getDatabaseConnection() {
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "our_site";

    try {
        $conn = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Database connection error :(" . $e->getMessage());
    }
}
?>