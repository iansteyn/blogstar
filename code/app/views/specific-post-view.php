<?php
/**
 * This view expects the following variables:
 * @var array $postData
 * with keys: post_id, username, post_title, post_body, post_image, is_liked, is_saved
 * @var  array $userData
 */
require_once __DIR__."/../helpers/view-helpers.php";
$postData = sanitizeData($postData);

echo generateDocumentHead(
    $postData['post_title'],
    ['forms.css', 'specific-post.css', 'user-bio.css'],
    ['comments.js', 'post-interaction.js']
);
?>

<body>
  <header>
    <?php include __DIR__."/components/side-nav-component.php" ?>
  </header>

  <main>
    <header class="page-header">
      <span class="breadcrumbs">
        <a href="<?= routeUrl("/profile/posts/{$userData['username']}") ?>">@<?= $userData['username'] ?>'s profile</a>
        &gt;
        <a href="#"><?= $postData['post_title'] ?></a>
      </span>
    </header>
    <article class="panel blog-panel">
      <!-- title -->
      <header>
        <h1 class="blog-title">
          <?= $postData['post_title'] ?>
        </h1>
        <?= generatePostingInfo($postData['username'], $postData['post_date']) ?>
      </header>
      <!-- image -->
      <?php if (!empty($postData['post_image'])): ?>
        <img class="blog-photo" src="<?= $postData['post_image'] ?>" alt="A photo associated with the blog post.">
      <?php endif; ?>
      <!-- post itself -->
      <div class="blog-text">
        <p>
            <?= nl2br($postData['post_body']) ?>
        </p>
      </div>
    </article>

    <?php if ($isLoggedIn): ?>
      <div class="interaction-bar">
        <!-- like -->
        <button
          title="Like"
          class="<?= hiddenIf($postData['is_liked']) ?> interaction-button togglable-post-button"
          type="button"
          data-resource="like"
          data-post-id="<?= $postData['post_id']?>"
        >
          <?= generateIconInline('icon-like-unfilled') ?>
          Like
        </button>
        <button
          title="Unlike"
          class="<?= hiddenIf( ! $postData['is_liked']) ?> interaction-button togglable-post-button togglable-post-button-active"
          type="button"
          data-resource="like"
          data-post-id="<?= $postData['post_id']?>"
        >
          <?= generateIconInline('icon-like-filled') ?>
          Liked
        </button>
        
        <!-- save -->
        <button
          title="Save"
          class="<?= hiddenIf($postData['is_saved']) ?> interaction-button togglable-post-button"
          type="button"
          data-resource="save"
          data-post-id="<?= $postData['post_id']?>"
        >
          <?= generateIconInline('icon-save-unfilled') ?>
          Save
        </button>
        <button
          title="Unsave"
          class="<?= hiddenIf( ! $postData['is_saved']) ?> interaction-button togglable-post-button togglable-post-button-active"
          type="button"
          data-resource="save"
          data-post-id="<?= $postData['post_id']?>"
        >
          <?= generateIconInline('icon-save-filled') ?>
          Saved
        </button>

        <!-- edit -->
        <?php if ($postData['belongs_to_current_user']): ?>
          <a
            Title="Edit"
            href="<?= routeUrl("/post/edit/".$postData['post_id']) ?>"
            class="interaction-button edit-post-button"
          >
            <?= generateIconInline('icon-edit') ?>
            Edit
          </a>
        <?php endif; ?>

        <!-- delete -->
        <?php if ($postData['belongs_to_current_user'] || $isAdmin): ?>
          <a
            Title="Delete"
            href="<?= routeUrl("/post/delete/".$postData['post_id']) ?>"
            class="interaction-button delete-post-button"
          >
              <?= generateIconInline('icon-delete') ?>
              Delete
          </a>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <article class="panel comments-container">
      <header>
        <h2 class="comments-title">
            Comments
        </h2>
      </header>

      <?php
        if (empty($comments)) {
            echo "<p>No comments yet. Be the first to comment!</p>";
        }
        else {
            foreach ($comments as $comment) {
                include __DIR__."/components/comment-component.php";
            }
        }
      ?>

      <div class="specific-comment-container">
        <form method="POST" action='<?= routeUrl("/comment/create/$postId") ?>'>
          <label for="comment">
            Add a Comment
          </label>
          <?php if ( ! $isLoggedIn):?>
            <p>
              You must <a href="<?= routeUrl('/login') ?>">log in</a> to comment on this post.
            </p>
          <?php else: ?>
            <textarea class="comment" id="comment" name="comment-body" placeholder="Write your comment here!" required></textarea>

            <button class="interaction-button" id="submit-button" type="submit" value="Post">
              <?= generateIconInline('icon-comment') ?>
              Post
            </button>

            <button class="interaction-button" id="discard-comment-button" type="button" value="Discard">
              <?= generateIconInline('icon-delete') ?>
              Discard
            </button>
          <?php endif; ?>
        </form>
      </div>
    </article>
  </main>

  <aside>
    <?php
        // This component uses: $userData
        include __DIR__."/components/user-bio-component.php"
    ?>
  </aside>
</body>

</html>