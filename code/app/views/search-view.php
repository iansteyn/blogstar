<?php
/**
 * This view requires the following variables:
 * @var bool $isAdmin
 * @var bool $isLoggedIn
 * @var bool $showResults
 * @var array $postDataList
 * @var string $searchValue
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
    <?php
        //this component uses: $isAdmin, $isLoggedIn
        require_once __DIR__."/components/side-nav-component.php"
    ?>
  </header>
  <main>
    <header class="page-header">
        <h1>Search blog posts</h1>
    </header>

    <div class="panel post-list">
      <?php
          $searchAction = '/search';
          // this component uses: $searchAction, $searchValue
          include __DIR__."/components/search-bar-component.php";
      ?>

      <?php if (! $showResults): ?>
        <div class='search-message help-message'>
            You can search for blog post titles using one or more keywords, seperated by spaces.
            Press "Enter" or click the search icon to submit your query.
        </div>
      <?php else: ?>
        <h3 class='search-message'>
          <?= empty($postDataList) ? ':( No' :  'Showing' ?>
          results for "<?= $searchValue ?>"
        </h3>
        <?php
            foreach ($postDataList as $postData) {
                // This component uses: $postData
                include __DIR__."/components/post-summary-component.php";
            }
        ?>
      <?php endif; ?>
    </div>

  </main>
</body>

</html>
