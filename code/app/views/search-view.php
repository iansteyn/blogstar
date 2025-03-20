<?php
    require_once __DIR__."/../helpers/view-helpers.php";

    echo generateDocumentHead(
        'Search',
        ['search.css', 'post-list.css'],
        ['post-interaction.js']
    );
?>

<body>
  <header>
    <?php include __DIR__."/../components/side-nav.php" ?>
  </header>
  <main>
    <header class="page-header">
        <h1>Search</h1>
    </header>
    <div class="panel">
      <section class="search">
        <?php include __DIR__."/../components/search-bar.php" ?>
      </section>
      <ul id="search-results" class="search-results">
        <li><?php include __DIR__."/../components/post-summary.php" ?></li>
        <li><?php include __DIR__."/../components/post-summary.php" ?></li>
        <li><?php include __DIR__."/../components/post-summary.php" ?></li>
        <li><?php include __DIR__."/../components/post-summary.php" ?></li>
        <li><?php include __DIR__."/../components/post-summary.php" ?></li>
        <li><?php include __DIR__."/../components/post-summary.php" ?></li>
        <li><?php include __DIR__."/../components/post-summary.php" ?></li>
      </ul>
    </div>
  </main>
</body>

</html>
