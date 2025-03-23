<?php
/*
    comment-component expects the following variable:
        array $comment with keys: username, comment_date, comment_body
*/
  require_once __DIR__."/../../helpers/view-helpers.php";
  $comment = sanitizeData($comment);
?>

<div class = "specific-comment-container">
  <header>
    <?= generatePostingInfo($comment['username'], $comment['comment_date'])?>
    <div class="button-group-icon-only">
      <button class="button-icon-only" title="Edit">
        <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
          <use href="../vector-icons/icons.svg#icon-edit"></use>
        </svg>
      </button>
      <button class="button-icon-only" id="delete-comment-button" title="Delete">
        <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
          <use href="../vector-icons/icons.svg#icon-delete"></use>
        </svg>
      </button>
    </div>
  </header>
  <div class = "comment-text">
    <p><?= nl2br($comment['comment_body']) ?></p>  
  </div>
</div>