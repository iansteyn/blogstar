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
  <link rel="stylesheet" href="../css/side-nav.css">
  <script src="../scripts/side-nav.js" defer></script>
  <script src="../scripts/tabs.js" defer></script>
</head>

<body>
  <header>
    <?php include "../html/side-nav.html" ?>
  </header>
  <main>
    <header class="page-header home-page-header">
        <h1>Home</h1>
        <?php include "../html/search-bar.html" ?>
    </header>
    <nav class="tab-group">
      <button class="tab active" value="new">New</button>
      <button class="tab" value="popular">Popular</button>
      <button class="tab" value="saved">Saved</button>
    </nav>
    <div class="subpage-group">
      <div class="subpage" id="new">
        <?php include "../html/post-list.php" ?>
      </div>
      <div class="subpage hidden" id="popular">
        <?php include "../html/post-list.php" ?>
      </div>
      <div class="subpage hidden" id="saved">
        <?php include "../html/post-list.php" ?>
      </div>
    </div>
  </main>
</body>

</html>
