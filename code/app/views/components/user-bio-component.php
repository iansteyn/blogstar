<?php 
/*
user-bio-component.php expects the following variable:
- array $userData with keys username, user_bio, profile_picture
*/
require_once __DIR__."/../../helpers/view-helpers.php";
$userData = sanitizeData($userData);
?>

<div class="sidebar-profile">
    <img class="user-image" src="<?= $userData['profile_picture'] ?>" alt="Profile picture of <?= $userData['username'] ?>">
    <div class="user-info">
        <h3 class="user-name">
          About
          <a href="/profile/posts/<?= $userData['username'] ?>">
            <i>@<?= $userData['username'] ?></i>
          </a>
        </h3>
        <p class="user-bio">
          <?= nl2br($userData['user_bio']) ?>
        </p>
    </div>
</div>
