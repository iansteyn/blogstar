<?php
    require_once __DIR__."/../helpers/view-helpers.php";

    echo generateDocumentHead(
        'Log in',
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
        <form id="login-form" class="account-form" method="post" action="login" novalidate>
          <h1 class="form-title">Log in to your account</h1>
          <?php
            if (isset($_SESSION['invalid_login'])) {
              echo '<p class="invalid-login">' . $_SESSION['invalid_login'] . '</p>';
              unset($_SESSION['invalid_login']);
            }
          ?>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address" 
            autocomplete="email" required />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required />
          </div>
          <button type="submit">Log in</button>
          <div>Don't have an account? <a href="/register">Register an account</a></div>
        </form>
      </div>
    </div>
  </main>
</body>

</html>
