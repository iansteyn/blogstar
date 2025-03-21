<?php 
/*
post-summary.php expects the following variables:
- array $postData
- bool $isLiked
- bool $isSaved
*/

//TODO
    // See concept of 'slug urls'
// - photo
// - limit post_body to first X amount of characters

require_once __DIR__."/../helpers/view-helpers.php";

$blogPostLink = "blog-post/".$postData['post_id'];
$postBodyExcerpt = substr($postData['post_body'], 0, 300) . "...";
?>

<article class="post-summary">
  <div class="post-summary-text">
    <h2 class="post-summary-title">
      <a href=<?= $blogPostLink ?>>
        <?= $postData['post_title'] ?>
      </a>
    </h2>

    <?= generatePostingInfo($postData['username'], $postData['post_date']) ?>

    <p class="blog-start">
      <a href=<?= $blogPostLink ?>>
        <?= $postBodyExcerpt ?>
      </a>
    </p>
  </div>

  <div class="post-summary-non-text">
    <a href=<?= $blogPostLink ?>>
        <img class="post-summary-img" src="../photo/knit.png" alt="Blog post photo"/>
    </a>

    <div class="post-summary-button-group button-group-icon-only">
      <div class="interact-buttons">
        <button title="Like" class="<?= hiddenIf($isLiked) ?> togglable-post-button button-icon-only">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
            <use href="../vector-icons/icons.svg#icon-like-unfilled"></use>
          </svg>
        </button>
        <button title="Unlike" class="<?= hiddenIf(!$isLiked) ?> togglable-post-button togglable-post-button-active button-icon-only">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
            <use href="../vector-icons/icons.svg#icon-like-filled"></use>
          </svg>
        </button>
        
        <button title="Save" class="<?= hiddenIf($isSaved) ?> togglable-post-button button-icon-only">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
            <use href="../vector-icons/icons.svg#icon-save-unfilled"></use>
          </svg>
        </button>
        <button title="Unsave" class="<?= hiddenIf(!$isSaved) ?> togglable-post-button togglable-post-button-active button-icon-only hidden">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
            <use href="../vector-icons/icons.svg#icon-save-filled"></use>
          </svg>
        </button>
      </div>

      <div class="modify-buttons">
        <button title="Edit" class="button-icon-only edit-post-button">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
            <use href="../vector-icons/icons.svg#icon-edit"></use>
          </svg>
        </button>
        <button title="Delete" class="button-icon-only delete-post-button">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
            <use href="../vector-icons/icons.svg#icon-delete"></use>
          </svg>
        </button>
      </div>
    </div>
  </div>
</article>