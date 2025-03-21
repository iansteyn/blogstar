<?php 
/*
user-bio-component.php expects the following variable:
- array $userData
*/
require_once __DIR__."/../helpers/view-helpers.php";

?>
  <body>
    <div class="sidebar-profile">
    <img class="user-image" src="../photo/sadie-smith.jpg" alt="Profile picture of <?= htmlspecialchars($userData['username']) ?>">
        <div class="user-info">
            <h2 class="user-name"><?= htmlspecialchars($userData['username'])?></h2>
            <p class="user-bio"><?= nl2br(htmlspecialchars($userData['user_bio']))?></p>
        </div>
    </div>

  </body>
</html>
