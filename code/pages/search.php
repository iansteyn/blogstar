<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Search Blog Topics</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../css/reset.css" />
  <link rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" href="../css/search.css">
  <link rel="stylesheet" href="../css/post-list.css">
  <link rel="stylesheet" href="../css/side-nav.css">
  <script src="../scripts/side-nav.js" defer></script>
  <script src="../scripts/post-interaction.js" defer></script>
</head>

<body>
  <header>
    <?php include "../html/side-nav.html" ?>
  </header>
  <main>
    <header class="page-header">
        <h1>Search</h1>
    </header>
    <div class="panel">
      <section class="search">
        <?php include "../html/search-bar.html" ?>
      </section>
      <ul id="search-results" class="search-results">
        <li><?php include "../html/post-summary.php" ?></li>
        <li><?php include "../html/post-summary.php" ?></li>
        <li><?php include "../html/post-summary.php" ?></li>
        <li><?php include "../html/post-summary.php" ?></li>
        <li><?php include "../html/post-summary.php" ?></li>
        <li><?php include "../html/post-summary.php" ?></li>
        <li><?php include "../html/post-summary.php" ?></li>
      </ul>
    </div>
  </main>
</body>

</html>
