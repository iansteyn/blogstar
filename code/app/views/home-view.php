<?php
/**
 * This view expects the following variables:
 * @var string $activeTab
 * @var array $postDataList with array values, each with keys: post_id, username, post_title, post_body, post_image, is_liked, is_saved
 */
    require_once __DIR__."/../helpers/view-helpers.php";

    echo generateDocumentHead(
        'Home',
        ['home.css', 'post-list.css', 'tabs.css'],
        ['post-interaction.js']
    );
?>

<body>
  <header>
    <?php require_once __DIR__."/components/side-nav-component.php" ?>
  </header>

  <main>
    <header>
      <div class="page-header home-page-header">
        <h1>Home</h1>
        <?php
            $searchAction = 'search';
            // this component uses: $searchAction
            include __DIR__."/components/search-bar-component.php";
        ?>
      </div>
      <nav class="tab-group">
        <a class="tab <?= isTabActive('recent', $activeTab) ?>" href="<?= routeUrl('/home/recent') ?>">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="/vector-icons/icons.svg#icon-recent"></use></svg>
          Recent
        </a>
        <a class="tab <?= isTabActive('popular', $activeTab) ?>" href="<?= routeUrl('/home/popular') ?>">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="/vector-icons/icons.svg#icon-popular"></use></svg>
          Popular
        </a>
        <?php if ($isLoggedIn): ?>
          <a class="tab <?= isTabActive('saved', $activeTab) ?>" href="<?= routeUrl('/home/saved') ?>">
            <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="/vector-icons/icons.svg#icon-save-unfilled"></use></svg>
            Saved
          </a>
        <?php endif; ?>
      </nav>
    </header>

    <article class="panel post-list <?= ($activeTab == 'recent') ? "left-most-subpage" : "" ?> ">
        <?php
        if ($activeTab == 'saved' and empty($postDataList) and $isLoggedIn) {
            $popularLink = routeUrl('/home/popular');
            echo "<p>You have no saved posts yet! <a href='$popularLink'>See what's popular.</a></p>";
        }
        else {
            foreach ($postDataList as $postData) {
                // This component uses: $postData
                include __DIR__."/components/post-summary-component.php";
            }
        }
        ?>
    </article>

  </main>
</body>

</html>
