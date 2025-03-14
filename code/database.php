<?php
    $db_server = "cosc-360-project.local";
    $db_user = "root";
    $_pass = "";
    $db_name = "practice_wp2";
    $conn = "";

    if($_SERVER['REQUEST_METHOD'] === 'post'){
        $username = $_post['user-id'];
        $email = $_post['email'];
        $pass = $_post['password'];
        $profile_picture = $_post['profile-picture'];
    
        # cosc-360-project.local/database.php
        try{
            $conn = mysqli_connect($db_server, $db_user, $_pass, $db_name, 'form');
        }
        catch(mysqli_sql_exception){
            echo "Not connected :(";
        }

        if($conn){
            echo "Hi Sammie, you are connected";
            
        }
    }
?>