<?php
require_once __DIR__.'/EnvironmentConfig.php';

function getDatabaseConnection(): PDO {

    $dbInfo = EnvironmentConfig::databaseInfo();

    try {
        $conn = new PDO(
            "mysql:host={$dbInfo['host']};dbname={$dbInfo['db_name']}",
            $dbInfo['user'],
            $dbInfo['password']
        );

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    catch (PDOException $e) {
        die("Database connection error :(" . $e->getMessage());
    }
}
?>