<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../css/reset.css" />
  <link rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" href="../css/forms.css" />
  <link rel="stylesheet" href="../css/side-nav.css">
  <script src="../scripts/side-nav.js" defer></script>
  <script src="../scripts/form-validation.js"></script>
</head>

<body>
  <header>
    <?php include "../html/side-nav.html" ?>
  </header>
  <main>
    <div class="form-container">
      <div class="panel">
        <form id="registration-form" class="account-form" method="post" novalidate> <!-- TODO: Set up form action -->
          <h1 class="form-title">Register for an account</h1>
          <div class="form-group">
            <label for="user-id">User id</label>
            <input type="text" id="user-id" name="user-id" placeholder="Enter your user id" required />
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address" autocomplete="email" required />
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
            <input type="file" id="profile-picture" name="profile-picture" required />
          </div>
          <button type="submit">Register</button>
          <div>Already have an account? <a href="login.php">Log in</a></div>
        </form>
      </div>
    </div>
  </main>
</body>

</html>
