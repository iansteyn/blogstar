<?php
/** view-helpers.php
 * ----------------------------------------------------------------------------------
 * Contains utility functions for views, ie logic that doesn't belong in controllers
 * but warrants being put into a function for reusability.
 * Include this file at the top of a view if you want to use any of these methods.
 * -----------------------------------------------------------------------------------
 */

function isTabActive($tab, $activeTab) {
    if($tab == $activeTab) {
        return "active";
    }
    return "";
}

function generatePostingInfo($userName, $date) {
    //TODO: correctly format date
    //TODO: correctly link to user page
    return <<<HTML
      <div class="posting-info">
        <a class="username" href="/profile" title="Author">
          $userName
        </a>
        —
        <time datetime="2025-01-04" title="Date posted">
          $date
        </time>
      </div>
    HTML;
}

?>
