<?php
    require_once __DIR__."/../helpers/view-helpers.php";
    echo generateDocumentHead('404 Not Found', ['forms.css'], []);
?>

<body>
  <header>
    <?php include __DIR__."/components/side-nav-component.php" ?>
  </header>
  <main>
    <header class="page-header">
        <h1>404</h1>
    </header>
    <div class="panel">
      <section>
        <h2>oops</h2>
        <p>The page you were looking for does not exist.</p>
      </section>
  </main>
</body>
