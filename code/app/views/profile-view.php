<?php
/**
 * profile-view.php
 * This view expects the following variables:
 * @var array $userData with keys: 'username', 'profile_picture', 'user_bio', 'is_current_user'
 * @var array $postDataList - list of posts with all the usual keys
 * @var string $activeTab
 * @var bool $isAdmin
 * @var bool $isLoggedIn
 */
require_once __DIR__."/../helpers/view-helpers.php";

echo generateDocumentHead(
    'My Profile',
    ['forms.css', 'tabs.css', 'post-list.css', 'user-bio.css'],
    ['post-interaction.js']
);
?>

<body>
  <header>
    <?php include __DIR__."/components/side-nav-component.php" ?>
  </header>
  <main>
    <header>
      <h1 class="page-header">
        <?= $userData['is_current_user'] ? 'My profile' : "<i>@{$userData['username']}</i>" ?>
      </h1>
      <nav class="tab-group">
        <a
          class="tab <?= isTabActive('posts', $activeTab) ?>"
          href='<?= routeUrl("/profile/posts/{$userData['username']}") ?>'
        >
          <?= generateIconInline('icon-post') ?>
          Posts
        </a>
        <a
          class="tab <?= isTabActive('saved', $activeTab) ?>"
          href="<?= routeUrl("/profile/saved/{$userData['username']}") ?>"
        >
          <?= generateIconInline('icon-save-unfilled') ?>
          Saved
        </a>
        <?php if ($userData['is_current_user']): ?>
          <a
            class="tab <?= isTabActive('settings', $activeTab) ?>"
            href="<?= routeUrl("/profile/settings") ?>"
          >
            <?= generateIconInline('icon-settings') ?>
            Settings
          </a>
        <?php endif; ?>
      </nav>
    </header>

    <?php if ($activeTab != 'settings'): ?>
        <article class="panel post-list <?= ($activeTab == 'posts') ? "left-most-subpage" : "" ?> ">
            <?php
            if ($activeTab == 'saved' and empty($postDataList) and $isLoggedIn) {
                if ($userData['is_current_user']) {
                    $popularLink = routeUrl("/home/popular");
                    echo "<p>You have no saved posts yet! <a href='$popularLink'>See what's popular.</a></p>";
                } else {
                    echo "<p>@{$userData['username']} has no saved posts.</p>";
                }
            } else {
                foreach ($postDataList as $postData) {
                    // This component uses: $postData
                    include __DIR__."/components/post-summary-component.php";
                }
            }
            ?>
        </article>
    <?php else: ?>
        <form id="user-settings" class="panel account-form" method="post" action="#" enctype="multipart/form-data">
          <p>Note: full user settings functionality will be added in Milestone 4</p>
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
    <?php endif; ?>
  </main>

  <aside>
    <?php
        // this component uses: $userData
        include __DIR__."/components/user-bio-component.php"
    ?>
  </aside>
</body>

</html>
