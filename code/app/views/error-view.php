<?php
/**
 * This view expects the following variables:
 * @var bool $isAdmin
 * @var bool $isLoggedIn
 * @var array $errorData with keys 'code', 'name', 'message'
 */

require_once __DIR__."/../helpers/view-helpers.php";
echo generateDocumentHead('404 Not Found', [], []);
?>

<body>
  <header>
    <?php include __DIR__."/components/side-nav-component.php" ?>
  </header>
  <main>
    <header class="page-header">
        <h1><?= $errorData['code'] ?></h1>
    </header>
    <div class="panel">
      <section>
        <h2><?= $errorData['name'] ?></h2>
        <p><?= $errorData['message'] ?></p>
      </section>
  </main>
</body>
