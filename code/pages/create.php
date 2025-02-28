<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <title>
    Create Blog Post
  </title>

  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/side-nav.css">
  <link rel="stylesheet" href="../css/forms.css">
  <link rel="stylesheet" href="../css/create.css">
  <script src="../scripts/side-nav.js" defer></script>
</head>

<body>
  <header>
    <?php include "../html/side-nav.html" ?>
  </header>
  <main>
    <h1 class = "page-title">Create your post</h1>
    <form class = "panel create-panel" method = "GET" action="../pages/create.php">
      <label for="blog-title">Title</label>
      <textarea class = "blog-title" id = "blog-title" placeholder = "Write your title here!"></textarea>
      <label for="blog-text">Post</label>
      <textarea class = "blog-text" id = "blog-text" placeholder = "Write your post here!"></textarea>
      <div class="form-group">
        <label for="blog-photo">Upload a photo</label>
        <input type="file" id="blog-photo" name="blog-photo"/>
      </div>
      <button id = "submit-button" type="submit" value="Post">Post</button>
      <button id = "discard-button" type="submit" value="Discard">Discard</button>
    </form>
  </main>
</body>

</html>