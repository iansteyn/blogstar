<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>My Profile | Our Site</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../css/reset.css" />
  <link rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" href="../css/forms.css" />
  <link rel="stylesheet" href="../css/tabs.css" />
  <link rel="stylesheet" href="../css/post-list.css" />
  <link rel="stylesheet" href="../css/side-nav.css" />
  <script src="../scripts/side-nav.js" defer></script>
  <script src="../scripts/tabs.js" defer></script>
</head>

<body>
  <header>
    <?php include "../html/side-nav.html" ?>
  </header>
  <main>
    <header>
      <h1 class="page-header">My Profile</h1>
      <nav class="tab-group">
        <button class="tab active" value="posts">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../icons/icons.svg#icon-post"></use></svg>
          Posts
        </button>
        <button class="tab" value="saved">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../icons/icons.svg#icon-save-unfilled"></use></svg>
          Saved
        </button>
        <button class="tab" value="settings">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../icons/icons.svg#icon-settings"></use></svg>
          Settings
        </button>
      </nav>
    </header>

    <div class="subpage-group">
      <div class="subpage" id="posts">
        <?php include "../html/post-list.php" ?>
      </div>
      <div class="subpage" id="saved">
        <?php include "../temporary/post-list-3.php" ?>
      </div>
      <div class="subpage" id="settings">
        
          <form id="user-settings" class="panel account-form" method="get" action="#">
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
    </div>
  </main>
</body>

</html>
