<?php 
/*
user-bio-component.php expects the following variable:
- array $userData with keys username, user_bio, profile_picture
*/
require_once __DIR__."/../../helpers/view-helpers.php";
$userData = sanitizeData($userData);
?>

<div class="sidebar-profile">
    <img class="user-image" src="../photo/sadie-smith.jpg" alt="Profile picture of <?= $userData['username'] ?>">
    <div class="user-info">
        <h2 class="user-name"><?= $userData['username'] ?></h2>
        <p class="user-bio"><?= nl2br($userData['user_bio']) ?></p>
    </div>
</div>
