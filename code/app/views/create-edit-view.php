<?php
    require_once __DIR__."/../helpers/view-helpers.php";
    $isEditMode = isset($postData);
    $pageTitle = $isEditMode ? 'Edit Post' : 'Create Post';
    $formAction = $isEditMode ? "/post/edit/{$postData['post_id']}" : "/create";
    $imageRequired = !$isEditMode ? 'required' : '';

    echo generateDocumentHead(
        $pageTitle,
        ['forms.css', 'create.css'],
        ['create-edit.js']
    );
?>

<body>
  <header>
    <?php include __DIR__."/components/side-nav-component.php" ?>
  </header>
  <main>
    <h1 class="page-title">
      <?= $isEditMode ? 'Edit your post' : 'Create your post' ?>
    </h1>
    <form
      class="panel create-panel"
      id="post-form"
      method="post"
      action="<?= $formAction ?>"
      enctype="multipart/form-data"
    >
      <label for="post-title">
        Title
      </label>
      <textarea
        class="blog-title"
        id="post-title"
        name="post-title"
        placeholder="Write your title here!"
        required
      >
        <?= $isEditMode ? htmlspecialchars($postData['post_title']) : '' ?>
      </textarea>

      <label for="post-body">
        Body
      </label>
      <textarea
        class="blog-text"
        id="post-body"
        name="post-body"
        placeholder="Write your post here!"
        required
      >
        <?= $isEditMode ? htmlspecialchars($postData['post_body']) : '' ?>
      </textarea>

      <div class="form-group">
        <label for="post-image">
          <?= $isEditMode ? 'Change photo (optional)' : 'Upload a photo' ?>
        </label>
        <input
          type="file"
          id="post-image"
          name="post-image"
          accept="image/png, image/jpeg, image/jpg, image/gif"
          <?= $imageRequired ?>
        >
      </div>

      <button
        class='post-button'
        id="submit-post-button"
        type="submit"
        value="Post"
      >
        <?= $isEditMode ? 'Update' : 'Post' ?>
      </button>
      <a href="/blog-post/<?= $postData['post_id'] ?>" class="button-link">
        <input
          class='post-button'
          id="discard-button"
          type="button"
          value="<?= $isEditMode ? 'Cancel' : 'Discard' ?>"
        >
      </a>

    </form>
  </main>
</body>

</html>