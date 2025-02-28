<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Search Blog Topics</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../css/reset.css" />
  <link rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" href="../css/home.css">
  <link rel="stylesheet" href="../css/side-nav.css">
  <script src="../scripts/side-nav.js" defer></script>
</head>

<body>
<header>
    <?php include "../html/side-nav.html" ?>
  </header>
  <main>
    <header class="page-header home-page-header">
        <h1>Search</h1>
        <?php include "../html/search-bar.html" ?>
    </header>
    <div class="panel">
      <div id="search-topics">Topics</div>
      <div id="search-results">Search Results</div>
    </div>
  </main>
</body>

</html>
