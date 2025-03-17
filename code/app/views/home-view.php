<?php require_once __DIR__."/../helpers/view-helpers.php" ?>

<!DOCTYPE html>
<html lang="en" class="hidden">

<head>
  <meta charset="UTF-8">

  <title>
    Home | Our Site
  </title>

  <link rel="stylesheet" href="/css/reset.css">
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/home.css">
  <link rel="stylesheet" href="/css/post-list.css" />
  <link rel="stylesheet" href="/css/tabs.css" />
  <link rel="stylesheet" href="/css/side-nav.css">
  <script src="/scripts/side-nav.js" defer></script>
  <script src="/scripts/tabs.js" defer></script>
  <script src="/scripts/post-interaction.js" defer></script>
</head>

<body>
  <header>
    <?php require_once __DIR__."/../components/side-nav.php" ?>
  </header>

  <main>
    <header>
      <div class="page-header home-page-header">
        <h1>Home</h1>
        <?php include __DIR__."/../components/search-bar.php" ?>
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
                include __DIR__."/../components/post-summary.php";
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
