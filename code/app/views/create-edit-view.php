<?php
    require_once __DIR__."/../helpers/view-helpers.php";

    $isEditMode = isset($postData);

    if ($isEditMode) {
        $postData = sanitizeData($postData);

        $pageTitle = 'Edit your post';
        $formAction = routeUrl("post/edit/{$postData['post_id']}");
        $imageRequired = false;

        $postTitle = $postData['post_title'];
        $postBody = $postData['post_body'];

        $submitButtonText = 'Update';
        $discardButtonText = 'Cancel';
    }
    else {
        $pageTitle = 'Create your post';
        $formAction = routeUrl("/create");
        $imageRequired = true;

        $postTitle = '';
        $postBody = '';

        $submitButtonText = 'Post';
        $discardButtonText = 'Discard';
    }

    echo generateDocumentHead(
        $pageTitle,
        ['forms.css', 'create-edit.css'],
        ['create-edit.js']
    );
?>

<body>
  <header>
    <?php include __DIR__."/components/side-nav-component.php" ?>
  </header>
  <main>
    <h1 class="page-title">
      <?= $pageTitle ?>
    </h1>
    <form
      class="panel create-panel"
      id="post-form"
      method="POST"
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
      ><?= $postTitle ?></textarea>
      <?php // Note: the above line must stay one line, otherwise weird whitespace is introduced ?>

      <label for="post-body">
        Body
      </label>
      <textarea
        class="blog-text"
        id="post-body"
        name="post-body"
        placeholder="Write your post here!"
        required
      ><?= $postBody ?></textarea>
      <?php // Note: the above line must stay one line, otherwise weird whitespace is introduced ?>

      <div class="form-group">
        <label for="post-image">
          <?= $imageRequired ? 'Change photo (optional)' : 'Upload a photo' ?>
        </label>
        <input
          type="file"
          id="post-image"
          name="post-image"
          accept="image/png, image/jpeg, image/jpg, image/gif"
          <?= $imageRequired ? 'required' : '' ?>
        >
      </div>

      <button
        class='post-button'
        id="submit-post-button"
        type="submit"
        value="Post"
      >
        <?= $submitButtonText ?>
      </button>
      <?php if ($isEditMode): ?>
        <a href='<?= routeUrl("blog-post/{$postData['post_id']}") ?>' class="button-link">
      <?php endif; ?>
        <input
          class='post-button'
          id="discard-button"
          type="button"
          value="<?= $discardButtonText ?>"
        >
      <?= $isEditMode ? '</a>' : '' ?>

    </form>
  </main>
</body>

</html>