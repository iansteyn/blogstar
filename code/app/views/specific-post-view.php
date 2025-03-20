<?php
    include __DIR__."/../helpers/view-helpers.php";

    echo generateDocumentHead(
        $postData['post_title'],
        ['forms.css', 'specific-post.css'],
        ['comments.js', 'post-interaction.js']
    );
?>

<body>
  <header>
    <?php include __DIR__."/../components/side-nav.php" ?>
  </header>

  <main>
    <header class="page-header">
      <span class="breadcrumbs">
        <a href="/profile">Sadie Smith's Profile</a>
        &gt;
        <a href="/#">This blog post</a>
      </span>
    </header>
    <article class="panel blog-panel">
      <header>
        <h1 class="blog-title">
          <?= $postData['post_title'] ?>
        </h1>
        <?= generatePostingInfo($postData['username'], $postData['post_date']) ?>
      </header>
      <img class="blog-photo" src="../photo/sunrise.jpg" alt="A photo of a sunrise looking over a beach.">
      <div class="blog-text">
        <p>
            <?= $postData['post_body'] ?>
        </p>
      </div>
    </article>

    <div class="interaction-bar">
      <button class="<?= hiddenIf($isLiked) ?> interaction-button togglable-post-button" type="button" title="Like">
        <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
          <use href="../vector-icons/icons.svg#icon-like-unfilled"></use> 
        </svg>
        Like
      </button>
      <button class="<?= hiddenIf(!$isLiked) ?> interaction-button togglable-post-button togglable-post-button-active" type="button" title="Unlike">
        <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
          <use href="../vector-icons/icons.svg#icon-like-filled"></use> 
        </svg>
        Liked
      </button>

      <button class="<?= hiddenIf($isSaved) ?> interaction-button togglable-post-button" type="button" title="Save">
        <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
          <use href="../vector-icons/icons.svg#icon-save-unfilled"></use> 
        </svg>
        Save
      </button>
      <button class="<?= hiddenIf(!$isSaved) ?> interaction-button togglable-post-button togglable-post-button-active" type="button" title="Unsave">
        <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
          <use href="../vector-icons/icons.svg#icon-save-filled"></use> 
        </svg>
        Saved
      </button>

      <button class="interaction-button edit-post-button" type="button">
        <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
          <use href="../vector-icons/icons.svg#icon-edit"></use> 
        </svg>
        Edit
      </button>

      <button class="interaction-button delete-post-button" type="button">
        <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
          <use href="../vector-icons/icons.svg#icon-delete"></use> 
        </svg>
        Delete
      </button>
    </div>

    <div class="panel comments-container">
    <header>
      <h2 class="comments-title">
        Comments
      </h2>
    </header>
    
    <?php include __DIR__."/../components/comment.php" ?>

    <div class = "specific-comment-container">
      <form method = "GET">
        <label for="comment">Add a Comment</label>
        <textarea class = "comment" id = "comment" placeholder = "Write your comment here!" required></textarea>
        <button class = "interaction-button" id = "submit-button" type="submit" value="Post">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
            <use href="../vector-icons/icons.svg#icon-comment"></use> 
          </svg>
          Post
        </button>

        <button class = "interaction-button" id = "discard-comment-button" type="button" value="Discard">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
            <use href="../vector-icons/icons.svg#icon-delete"></use> 
          </svg>
          Discard
        </button>
      </form>
    </div>
  </div>
  </main>
  <aside>
    <?php include __DIR__."/../components/user-bio.php" ?>
  </aside>
</body>

</html>