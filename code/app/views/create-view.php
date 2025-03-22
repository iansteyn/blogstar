<?php
    session_start();
    require_once __DIR__."/../helpers/view-helpers.php";

    echo generateDocumentHead(
        'Create Post',
        ['forms.css', 'create.css'],
        ['create-edit.js']
    );
?>

<body>
  <header>
    <?php include __DIR__."/../components/side-nav-component.php" ?>
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