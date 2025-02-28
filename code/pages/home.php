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
    <nav class="tab-container">
      <button class="tab" id="tab-new">New</button>
      <button class="tab" id="tab-popular">Popular</button>
      <button class="tab" id="tab-saved">Saved</button>
    </nav>
    <div id="container-new">
      <?php include "../html/post-list.php" ?>
    </div>
    <div id="container-popular" class="hidden">
      <?php include "../html/post-list.php" ?>
    </div>
    <div id="container-saved" class="hidden">
      <?php include "../html/post-list.php" ?>
    </div>
  </main>
</body>

</html>
