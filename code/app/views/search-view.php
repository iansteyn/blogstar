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
        <h1>Search blog posts</h1>
    </header>
    <div class="panel">
      <?php
          $searchAction = '/search';
          // this component uses: $searchAction
          include __DIR__."/components/search-bar-component.php";
      ?>
      <div class='help-message'>
        You can search for blog posts using one or more keywords, seperated by spaces.
        Press "Enter" or click the search icon to submit your query.
      </div>
    </div>

  </main>
</body>

</html>
