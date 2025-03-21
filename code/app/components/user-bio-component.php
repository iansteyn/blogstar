<?php 
require_once __DIR__."/../helpers/view-helpers.php";

  $username = $userData['username'] ?? 'Unknown User';
  $bio = $userData['user_bio'] ?? 'This user has not added a bio yet.';
  $profilePicture = $userData['profile_picture'] ?? '../photo/default-profile.jpg';
?>
  <body>
    <div class="sidebar-profile">
    <img class="user-image" src="<?= htmlspecialchars($profilePicture)?>" alt="Profile picture of <?= htmlspecialchars($username) ?>">
        <div class="user-info">
            <h2 class="user-name"><?= htmlspecialchars($username)?></h2>
            <p class="user-bio"><?= nl2br(htmlspecialchars($bio))?></p>
        </div>
    </div>

  </body>
</html>
