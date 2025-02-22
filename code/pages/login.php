<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../css/reset.css" />
  <link rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" href="../css/forms.css" />
  <link rel="stylesheet" href="../css/side-nav.css">
  <script src="../scripts/side-nav.js" defer></script>
</head>

<body>
  <header>
    <?php include "../html/side-nav.html" ?>
  </header>
  <main>
    <div class="form-container">
      <form id="login-form" class="account-form" method="post" novalidate> <!-- TODO: Set up form action -->
        <h2 class="form-title">Log in to your account</h2>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email address" autocomplete="email"
            required />
        </div>
        <div class="form-group">
          <span>
            <label for="password">Password</label>
            <a href="">Forgot password?</a> <!-- TODO: Password reset page (low priority) -->
          </span>
          <input type="password" id="password" name="password" placeholder="Enter your password" required />
        </div>
        <button type="submit">Log in</button>
        <p>Don't have an account? <a href="register.php">Register an account</a></p>
      </form>
    </div>
  </main>
</body>

</html>
