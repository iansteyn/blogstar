<?php
    require_once __DIR__."/../helpers/view-helpers.php";

    echo generateDocumentHead(
        'My Profile',
        ['forms.css', 'tabs.css', 'post-list.css', 'user-bio.css'],
        ['post-interaction.js']
    );

    $activeTab = 'posts'; // TODO remove
?>

<body>
  <header>
    <?php include __DIR__."/components/side-nav-component.php" ?>
  </header>
  <main>
    <header>
      <h1 class="page-header">My Profile</h1>
      <nav class="tab-group">
        <form method="get">
          <button class="tab active" formaction="/profile/posts">
            <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-post"></use></svg>
            Posts
          </button>
          <button class="tab" value="saved" formaction="/profile/saved">
            <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-save-unfilled"></use></svg>
            Saved
          </button>
          <button class="tab" value="settings" formaction="/profile/settings">
            <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-settings"></use></svg>
            Settings
          </button>
        </form>
      </nav>
    </header>

    <article class="panel post-list <?= ($activeTab == 'posts') ? "left-most-subpage" : "" ?> ">
        <?php
        if ($activeTab == 'saved' and empty($postDataList) and $isLoggedIn) {
            echo "<p>You have no saved posts yet! <a href='/home/popular'>See what's popular.</a></p>";
        }
        else {
            foreach ($postDataList as $postData) {
                // This component uses: $postData
                include __DIR__."/components/post-summary-component.php";
            }
        }
        ?>
    </article>


      <!-- <div class="subpage hidden" id="saved">
      </div> -->


      <!-- <div class="subpage hidden" id="settings">
        <form id="user-settings" class="panel account-form" method="post" action="#" enctype="multipart/form-data">
          <div class="form-group">
            <label for="update-user-id">Update user id</label>
            <input type="text" id="update-user-id" placeholder="Update your user id" />
          </div>
          <div class="form-group">
            <label for="update-password">Update password</label>
            <input type="password" id="update-password" placeholder="Update your password" />
          </div>
          <div class="form-group">
            <label for="confirm-update-password">Confirm password</label>
            <input type="password" id="confirm-update-password" placeholder="Confirm your updated password" />
          </div>
          <div class="form-group">
            <label for="update-profile-picture">Update profile picture</label>
            <input type="file" id="update-profile-picture" accept="image/png, image/jpeg, image/jpg, image/gif" />
          </div>
          <div class="form-group">
            <label for="edit-user-bio">Edit user bio</label>
            <textarea id="edit-user-bio" maxlength="300" placeholder="Write something about yourself" rows="4"></textarea>
          </div>
          <button type="submit">Update user settings</button>
        </form>
      </div>
    </div> -->
  </main>

  <aside>
    <?php
        // this component uses: $userData
        include __DIR__."/components/user-bio-component.php"
    ?>
  </aside>
</body>

</html>
