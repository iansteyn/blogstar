<!DOCTYPE html>
<html lang="en" class="hidden">

<head>
  <meta charset="UTF-8">

  <title>
    Create Blog Post
  </title>

  <link rel="stylesheet" href="/css/reset.css">
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/side-nav.css">
  <link rel="stylesheet" href="/css/forms.css">
  <link rel="stylesheet" href="/css/create.css">
  <script src="/scripts/side-nav.js" defer></script>
  <script src="/scripts/create-edit.js" defer></script>
</head>

<body>
  <header>
    <?php include "../html/side-nav.html" ?>
  </header>
  <main>
    <h1 class = "page-title">Create your post</h1>
    <form class = "panel create-panel" id = "create-form" method="post" enctype="multipart/form-data">
      <label for="blog-title">Title</label>
      <textarea class = "blog-title" id = "blog-title" placeholder = "Write your title here!" required></textarea>
      <label for="blog-text">Post</label>
      <textarea class = "blog-text" id = "blog-text" placeholder = "Write your post here!" required></textarea>
      <div class="form-group">
        <label for="blog-photo">Upload a photo</label>
        <input type="file" id="blog-photo" name="blog-photo" accept="image/png, image/jpeg, image/jpg, image/gif" required/>
      </div>
      <button id = "submit-post-button" type="submit" value="Post">Post</button>
      <input id = "discard-post-button" type="button" value="Discard">
    </form>
  </main>
</body>

</html>