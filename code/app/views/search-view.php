<?php
/**
 * This view requires the following variables:
 * @var bool $isAdmin
 * @var bool $isLoggedIn
 * @var bool $showResults
 * @var array $postDataList
 */

require_once __DIR__."/../helpers/view-helpers.php";

echo generateDocumentHead(
    'Search',
    ['search.css', 'post-list.css'],
    ['post-interaction.js']
);
?>

<body>
  <header>
    <?php require_once __DIR__."/components/side-nav-component.php" ?>
  </header>
  <main>
    <header class="page-header">
        <h1>Search posts by keyword</h1>
    </header>
    <div class="panel">
      <section class="search">
        <?php
            $searchAction = '/search';
            // this component uses: $searchAction
            include __DIR__."/components/search-bar-component.php";
        ?>
      </section>
      <p>Note: full search functionality is coming in milestone 4</p>
    </div>
  </main>
</body>

</html>
