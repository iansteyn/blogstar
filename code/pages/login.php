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
  <script src="../scripts/form-validation.js" defer></script>
</head>

<body>
  <header>
    <?php include "../html/side-nav.html" ?>
  </header>
  <main>
    <div class="form-container">
      <div class="panel">
        <form id="login-form" class="account-form" method="post" action="home.php" novalidate>
          <h1 class="form-title">Log in to your account</h1>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address" autocomplete="email"
              required />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required />
          </div>
          <button type="submit">Log in</button>
          <div>Don't have an account? <a href="register.php">Register an account</a></div>
        </form>
      </div>
    </div>
  </main>
</body>

</html>
