<?php
    function getDataBaseConnection() {
        // TODO: @SammieScully add db connection logic here
        // should return a PDO object I believe

        $db_server = "cosc-360-project.local";
        $db_user = "root";
        $db_pass = "";
        $db_name = "practice_wp2";
        $conn = "";

        # cosc-360-project.local/db_init.php
        try {
            $conn = new PDO("mysql:host=$db_server; dbname=$db_name", $db_user, $db_pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Hi Sammie :)";
            return $conn;
        } catch (PDOException $e) {
            die("Not connected :(" . $e->getMessage());
        }
    }
?>