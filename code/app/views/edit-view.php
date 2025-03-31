<?php
require_once __DIR__."/../helpers/view-helpers.php";

    echo generateDocumentHead(
        'Edit Post',
        ['forms.css', 'create.css'],
        ['create-edit.js']
    );
?>

    <body>
        <header>
            <?php include __DIR__."/components/side-nav-component.php" ?>
        </header>
        <main>
            <h1 class="page-title">Edit your post</h1>
            <form class="panel create-panel" id="edit-form" method="post" action="/post/edit/<?= $postData['post_id'] ?>" enctype="multipart/form-data">
            <label for="post-title">Title</label>
            <textarea class="blog-title" id="post-title" name="post-title" placeholder="Write your title here!" required><?= htmlspecialchars($postData['post_title']) ?></textarea>
            <label for="post-text">Post</label>
            <textarea class="blog-text" id="post-body" name="post-body" placeholder="Write your post here!" required><?= htmlspecialchars($postData['post_body']) ?></textarea>
            <div class="form-group">
                <label for="post-image">Change photo (optional)</label>
                <input type="file" id="post-image" name="post-image" accept="image/png, image/jpeg, image/jpg, image/gif"/>
            </div>
            <button id="submit-post-button" type="submit" value="Update">Update</button>
            <a href="/blog-post/<?= $postData['post_id'] ?>" class="button-link">
                <input id="cancel-edit-button" type="button" value="Cancel">
            </a>
            </form>
        </main>
    </body>
</html>