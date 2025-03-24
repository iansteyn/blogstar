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
        <a href="/profile/<?= $userData['username'] ?>"><?= $userData['username'] ?>'s Profile</a>
        &gt;
        <a href="/#"><?= $postData['post_title'] ?></a>
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
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
            <use href="../vector-icons/icons.svg#icon-like-unfilled"></use> 
          </svg>
          Like
        </button>
        <button
          title="Unlike"
          class="<?= hiddenIf( ! $postData['is_liked']) ?> interaction-button togglable-post-button togglable-post-button-active"
          type="button"
          data-resource="like"
          data-post-id="<?= $postData['post_id']?>"
        >
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
            <use href="../vector-icons/icons.svg#icon-like-filled"></use> 
          </svg>
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
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
            <use href="../vector-icons/icons.svg#icon-save-unfilled"></use> 
          </svg>
          Save
        </button>
        <button
          title="Unsave"
          class="<?= hiddenIf( ! $postData['is_saved']) ?> interaction-button togglable-post-button togglable-post-button-active"
          type="button"
          data-resource="save"
          data-post-id="<?= $postData['post_id']?>"
        >
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
            <use href="../vector-icons/icons.svg#icon-save-filled"></use> 
          </svg>
          Saved
        </button>
        <?php if ($postData['belongs_to_current_user']): ?>
          <!-- edit (if it is your own post) -->
          <button
            Title="Edit"
            class="interaction-button edit-post-button"
            type="button"
            data-post-id="<?= $postData['post_id']?>"
          >
            <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
              <use href="../vector-icons/icons.svg#icon-edit"></use> 
            </svg>
            Edit
          </button>
        <?php endif; ?>

        <?php if ($postData['belongs_to_current_user'] || $isAdmin): ?>
          <!-- delete (if it is your own post) -->
          <form method = "POST" action = "/post/delete/<?= $postId?>">
            <button
              Title="Delete"
              class="interaction-button delete-post-button"
              type="submit"
              data-post-id="<?= $postData['post_id']?>"
            >
              <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
                <use href="../vector-icons/icons.svg#icon-delete"></use> 
              </svg>
              Delete
            </button>
          </form>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <div class="panel comments-container">
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

      <div class = "specific-comment-container">
        <form method="POST" action="/comment/create/<?= $postId ?>">
          <label for="comment">Add a Comment</label>
          <?php if ( ! $isLoggedIn):?>
            <p>You must <a href="/login">log in</a> to comment on this post.</p>
          <?php else: ?>
            <textarea class = "comment" id = "comment" name = "comment-body" placeholder = "Write your comment here!" required></textarea>

            <button class = "interaction-button" id="submit-button" type="submit" value="Post">
                <svg class = "icon-inline" preserveAspectRatio="xMidYMid meet">
                <use href = "../vector-icons/icons.svg#icon-comment"></use>
                </svg>
                Post
            </button>

            <button class="interaction-button" id="discard-comment-button" type="button" value="Discard">
                <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
                <use href="../vector-icons/icons.svg#icon-delete"></use>
                </svg>
                Discard
            </button>
          <?php endif; ?>
        </form>
      </div>
    </div>
  </main>

  <aside>
    <?php
        // This component uses: $userData
        include __DIR__."/components/user-bio-component.php"
    ?>
  </aside>
</body>

</html>