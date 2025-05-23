<?php
    require_once __DIR__."/../helpers/view-helpers.php";

    echo generateDocumentHead(
        'Register',
        ['forms.css'],
        ['form-validation.js']
    );
?>

<body>
  <header>
    <?php include __DIR__."/components/side-nav-component.php" ?>
  </header>
  <main>
    <div class="form-container">
      <div class="panel">
        <form id="registration-form" class="account-form" method="post" enctype="multipart/form-data" autocomplete="on" novalidate>
          <h1 class="form-title">Register for an account</h1>
          <?php
            if (isset($_SESSION['invalid_registration'])) {
              echo '<p class="invalid-login">' . $_SESSION['invalid_registration'] . '</p>';
              unset($_SESSION['invalid_registration']);
            }
          ?>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" autocomplete="off" required />
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address" autocomplete="username" required />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required />
          </div>
          <div class="form-group">
            <label for="confirm-password">Confirm password</label>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Re-enter your password" required />
          </div>
          <div class="form-group">
            <label for="profile-picture">Upload profile picture</label>
            <input type="file" id="profile-picture" name="profile-picture" accept="image/png, image/jpeg, image/jpg, image/gif" required />
          </div>
          <button type="submit">Register</button>
          <div>Already have an account? <a href="<?= routeUrl('/login') ?>">Log in</a></div>
        </form>
      </div>
    </div>
  </main>
</body>

</html>
