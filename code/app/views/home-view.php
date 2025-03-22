<?php
    session_start();
    require_once __DIR__."/../helpers/view-helpers.php";

    echo generateDocumentHead(
        'Home',
        ['home.css', 'post-list.css', 'tabs.css'],
        ['tabs.js', 'post-interaction.js']
    );
?>

<body>
  <header>
    <?php require_once __DIR__."/../components/side-nav-component.php" ?>
  </header>

  <main>
    <header>
      <div class="page-header home-page-header">
        <h1>Home</h1>
        <?php include __DIR__."/../components/search-bar-component.php" ?>
      </div>
      <nav class="tab-group">
        <button class="tab <?= isTabActive('recent', $activeTab) ?>" value="recent">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="/vector-icons/icons.svg#icon-recent"></use></svg>
          Recent
        </button>
        <button class="tab <?= isTabActive('popular', $activeTab) ?>" value="popular">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="/vector-icons/icons.svg#icon-popular"></use></svg>
          Popular
        </button>
        <button class="tab <?= isTabActive('saved', $activeTab) ?>" value="saved">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="/vector-icons/icons.svg#icon-save-unfilled"></use></svg>
          Saved
        </button>
      </nav>
    </header>

    <div class="subpage-group">
      <div class="subpage" id="recent">
        <article class="panel post-list">
          <?php
            foreach ($recentPostsData as $postData) {
                $isLiked = false; //TODO figure out how to properly get these booleans
                $isSaved = false;
                // Pass $postData, $isLiked, $isSaved to post-summary
                include __DIR__."/../components/post-summary-component.php";
            }
          ?>
        </article>
      </div>
      <div class="subpage hidden" id="popular">
        <?php include "../temporary/post-list-2.php" ?>
      </div>
      <div class="subpage hidden" id="saved">
        <?php include "../temporary/post-list-3.php" ?>
      </div>
    </div>
  </main>
</body>

</html>
