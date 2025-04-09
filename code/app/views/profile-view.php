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
$userData = sanitizeData($userData);

echo generateDocumentHead(
    'My Profile',
    ['forms.css', 'tabs.css', 'post-list.css', 'user-bio.css'],
    ['post-interaction.js', 'form-validation.js']
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

            } elseif ($activeTab == 'posts' && empty($postDataList) && $isLoggedIn) {
                if ($userData['is_current_user']) {
                    $createLink = routeUrl("/create");
                    echo "<p>You have no posts yet! <a href='$createLink'>Write your first post here!.</a></p>";
                } else {
                    echo "<p>@{$userData['username']} has no posts.</p>";
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
      <form
        id="user-settings"
        class="panel account-form"
        method="post"
        action="<?= routeUrl('/profile/update-settings') ?>"
        enctype="multipart/form-data"
      >
          <div class="form-group">
              <p>
              <i>All changes are optional but require current password beforehand!</i>
            </p>
            <label for="current-password">
                Current password
            </label>
            <input
              type="password"
              id="current-password"
              name="current-password"
              placeholder="Enter your current password"
              required
            >
            <?php if (isset($_SESSION['error'])): ?>
                <div class="error-message" style="color: var(--color-error); max-width: 42ch;">
                    <?= sanitizeData($_SESSION['error']) ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label for="new-password">
              New password (leave blank to keep current)
            </label>
            <input
              type="password"
              id="new-password"
              name="new-password"
              placeholder="Enter new password"
            >
          </div>
          <div class="form-group">
            <label for="confirm-password">
              Confirm new password
            </label>
            <input
              type="password" 
              id="confirm-password"
              name="confirm-password"
              placeholder="Confirm new password"
            >
          </div>
          <div class="form-group">
            <label for="profile-picture">
              Update profile picture
            </label>
            <input
              type="file"
              id="profile-picture"
              name="profile-picture"
              accept="image/png, image/jpeg, image/jpg, image/gif"
            >
          </div>
          <div class="form-group">
            <label for="user-bio">
              Edit Bio
            </label>
            <textarea
              id="user-bio"
              name="user-bio"
              rows='10'
              placeholder="Tell us about yourself"
            ><?= $userData['user_bio'] ?></textarea>
          </div>
          <button type="submit">
            Update Settings
          </button>
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
