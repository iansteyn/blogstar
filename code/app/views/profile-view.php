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
        <form method="get">
          <button
            class="tab <?= isTabActive('posts', $activeTab) ?>"
            formaction="/profile/posts/<?= $userData['username'] ?>">
            <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="/../vector-icons/icons.svg#icon-post"></use></svg>
            Posts
          </button>
          <button
            class="tab <?= isTabActive('saved', $activeTab) ?>"
            formaction="/profile/saved/<?= $userData['username'] ?>">
            <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="/../vector-icons/icons.svg#icon-save-unfilled"></use></svg>
            Saved
          </button>
          <?php if ($userData['is_current_user']): ?>
            <button
              class="tab <?= isTabActive('settings', $activeTab) ?>"
              formaction="/profile/settings">
              <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="/../vector-icons/icons.svg#icon-settings"></use></svg>
              Settings
            </button>
          <?php endif; ?>
        </form>
      </nav>
    </header>

    <?php if ($activeTab != 'settings'): ?>
        <article class="panel post-list <?= ($activeTab == 'posts') ? "left-most-subpage" : "" ?> ">
            <?php
            if ($activeTab == 'saved' and empty($postDataList) and $isLoggedIn) {
                if ($userData['is_current_user']) {
                    echo "<p>You have no saved posts yet! <a href='/home/popular'>See what's popular.</a></p>";
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
      <form id="user-settings" class="panel account-form" method="post" action="/profile/update-settings" enctype="multipart/form-data">
          <div class="form-group">
            <label for="current-password">Current password (required for changes)</label>
            <input type="password" id="current-password" name="current-password" placeholder="Enter your current password" required />
          </div>
          <div class="form-group">
            <label for="new-password">New password (leave blank to keep current)</label>
            <input type="password" id="new-password" name="new-password" placeholder="Enter new password" />
          </div>
          <div class="form-group">
            <label for="confirm-password">Confirm new password</label>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm new password" />
          </div>
          <div class="form-group">
            <label for="profile-picture">Update profile picture</label>
            <input type="file" id="profile-picture" name="profile-picture" accept="image/png, image/jpeg, image/jpg, image/gif" />
          </div>
          <div class="form-group">
            <label for="user-bio">Bio</label>
            <textarea id="user-bio" name="user-bio" placeholder="Tell us about yourself" rows="4"><?= htmlspecialchars($userData['user_bio'] ?? '') ?></textarea>
          </div>
          <button type="submit">Update Settings</button>
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
