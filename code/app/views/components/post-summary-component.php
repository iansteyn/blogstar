<?php 
/** 
 * post-summary-component.php expects the following variables:
 * @var array $postData with keys: post_id, username, post_title, post_body, post_image, is_liked, is_saved
*/

require_once __DIR__."/../../helpers/view-helpers.php";
$postData = sanitizeData($postData);

$blogPostLink = routeUrl("/blog-post/{$postData['post_id']}");
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
      <?php if (!empty($postData['post_image'])): ?>
        <img class="post-summary-img" src="<?= $postData['post_image'] ?>" alt="Photo associated with this blog post"/>
      <?php endif; ?>
    </a>

    <?php if($isLoggedIn) : ?>
      <div class="post-summary-button-group button-group-icon-only">
        <div class="interact-buttons">
          <button
            title="Like"
            class="<?= hiddenIf($postData['is_liked']) ?> togglable-post-button button-icon-only"
            data-resource="like"
            data-post-id="<?= $postData['post_id']?>"
          >
            <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
              <use href="/../vector-icons/icons.svg#icon-like-unfilled"></use>
            </svg>
          </button>
          <button
            title="Unlike"
            class="<?= hiddenIf( ! $postData['is_liked']) ?> togglable-post-button togglable-post-button-active button-icon-only"
            data-resource="like"
            data-post-id="<?= $postData['post_id']?>"
          >
            <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
              <use href="/../vector-icons/icons.svg#icon-like-filled"></use>
            </svg>
          </button>
          
          <button
            title="Save"
            class="<?= hiddenIf($postData['is_saved']) ?> togglable-post-button button-icon-only"
            data-resource="save"
            data-post-id="<?= $postData['post_id']?>"
          >
            <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
              <use href="/../vector-icons/icons.svg#icon-save-unfilled"></use>
            </svg>
          </button>
          <button
            title="Unsave"
            class="<?= hiddenIf( ! $postData['is_saved']) ?> togglable-post-button togglable-post-button-active button-icon-only"
            data-resource="save"
            data-post-id="<?= $postData['post_id']?>"
          >
            <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
              <use href="/../vector-icons/icons.svg#icon-save-filled"></use>
            </svg>
          </button>
        </div>

        <div class="modify-buttons">
          <?php if ($postData['belongs_to_current_user']): ?>
            <button
              title="Edit"
              class="button-icon-only edit-post-button"
              data-post-id="<?= $postData['post_id']?>"
            >
              <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
                <use href="/../vector-icons/icons.svg#icon-edit"></use>
              </svg>
            </button>
          <?php endif; ?>
          <?php if ($postData['belongs_to_current_user'] or $isAdmin): ?>
            <button
              title="Delete"
              class="button-icon-only delete-post-button"
              data-post-id="<?= $postData['post_id']?>"
            >
              <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
                <use href="/../vector-icons/icons.svg#icon-delete"></use>
              </svg>
            </button>
          <?php endif; ?>
        </div>

      </div>
    <?php endif; ?>

  </div>
</article>