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
        <?php include __DIR__."/components/search-bar-component.php" ?>
      </div>
      <nav class="tab-group">
        <form method="post">
          <button class="tab <?= isTabActive('recent', $activeTab) ?>" value="recent" formaction="/home/recent">
            <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="/vector-icons/icons.svg#icon-recent"></use></svg>
            Recent
          </button>
          <button class="tab <?= isTabActive('popular', $activeTab) ?>" value="popular" formaction="/home/popular">
            <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="/vector-icons/icons.svg#icon-popular"></use></svg>
            Popular
          </button>
          <?php if ($isLoggedIn): ?>
            <button class="tab <?= isTabActive('saved', $activeTab) ?>" value="saved" formaction="/home/saved">
              <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="/vector-icons/icons.svg#icon-save-unfilled"></use></svg>
              Saved
            </button>
          <?php endif; ?>
        </form>
      </nav>
    </header>

    <div class="subpage-group">
      <div class="subpage">
       <article class="panel post-list">
          <?php
            if ($activeTab == 'saved' and empty($postDataList)) {
                echo "<p>You have no saved posts yet! <a href='/home/popular'>See what's popular.</a></p>";
            }
            else {
                foreach ($postDataList as $postData) {
                    // This component uses: $postData
                    include __DIR__."/components/post-summary-component.php";
                }
            }
          ?>
        </article>
      </div>
    </div>

  </main>
</body>

</html>
