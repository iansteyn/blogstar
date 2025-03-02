<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <title>
    Home | Our Site
  </title>

  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/home.css">
  <link rel="stylesheet" href="../css/post-list.css" />
  <link rel="stylesheet" href="../css/tabs.css" />
  <link rel="stylesheet" href="../css/side-nav.css">
  <script src="../scripts/side-nav.js" defer></script>
  <script src="../scripts/tabs.js" defer></script>
</head>

<body>
  <header>
    <?php include "../html/side-nav.html" ?>
  </header>

  <main>
    <header>
      <div class="page-header home-page-header">
        <h1>Home</h1>
        <?php include "../html/search-bar.html" ?>
      </div>
      <nav class="tab-group">
        <button class="tab active" value="recent">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../icons/icons.svg#icon-recent"></use></svg>
          Recent
        </button>
        <button class="tab" value="popular">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../icons/icons.svg#icon-popular"></use></svg>
          Popular
        </button>
        <button class="tab" value="saved">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../icons/icons.svg#icon-save-unfilled"></use></svg>
          Saved
        </button>
      </nav>
    </header>

    <div class="subpage-group">
      <div class="subpage" id="recent">
        <?php include "../html/post-list.php" ?>
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
