<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_end_flush();

function getDatabaseConnection() {
    echo "Start of getDatabaseConnection() function<br>";
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "our_site";

    try {
        echo "Connecting to the server in db_connect try<br>";
        $dsn = "mysql:host=$db_server";
        $conn = new PDO($dsn, $db_user, $db_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected to server successfully!<br>";

        echo "Checking if database '$db_name' exists...<br>";
        $result = $conn->query("SHOW DATABASES LIKE '$db_name'");
        if ($result->rowCount() == 0) {
            echo "Database '$db_name' does not exist. Creating it...<br>";
            $conn->exec("CREATE DATABASE $db_name");
            echo "Database '$db_name' created successfully!<br>";
        } else {
            echo "Database '$db_name' already exists.<br>";
        }

        echo "Connecting to the database: $db_name<br>";
        $dsn = "mysql:host=$db_server;dbname=$db_name";
        $conn = new PDO($dsn, $db_user, $db_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected to database '$db_name' successfully!<br>";

        echo "Leaving getDatabaseConnection()<br>";
        return $conn;
    } catch (PDOException $e) {
        echo "Error in getDatabaseConnection(): " . $e->getMessage() . "<br>";
        error_log("Database connection error: " . $e->getMessage());
        die("Connection failed: " . $e->getMessage());
    }
}
?>