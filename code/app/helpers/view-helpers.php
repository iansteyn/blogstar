<?php
/* view-helpers.php
 * ----------------------------------------------------------------------------------
 * Contains utility functions for views, ie logic that doesn't belong in controllers
 * but warrants being put into a function for reusability.
 * Include this file at the top of a view if you want to use any of these methods.
 * -----------------------------------------------------------------------------------
 */


// function sanitizeData(array|mixed $data): array {
//     foreach($data element)
// }

/**
 * @param string $tab
 * @param string $activeTab
 * @return string "active" if $tab matches $activeTab, empty otherwise
 */
function isTabActive($tab, $activeTab): string {
    if($tab == $activeTab) {
        return "active";
    }
    return "";
}

function hiddenIf($condition): string {
    return $condition ? "hidden" : "";
}

function generatePostingInfo(string $username, $sqlDateTime): string {
    $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $sqlDateTime);
    $formattedDate = $dateTime->format('F j, Y');
    $htmlDateTime = $dateTime->format('Y-m-d\TH:i');

    return <<<HTML
      <div class="posting-info">
        <a class="username" href="/profile" title="Author">
          @$username
        </a>
        —
        <time datetime='$htmlDateTime' title="Date posted">
          $formattedDate
        </time>
      </div>
    HTML;
}

/**
 * Generates the boilerplate and document head for view pages of our website.
 * 
 * Contains stuff that every page needs: the main, reset and side-nav stylesheet links,
 * favicon link, side-nav script link.
 * 
 * @param string $title
 * @param array $extraStylesheets
 * A list of stylesheet filenames - eg `['home.css']`
 * @param array $extraScripts
 * A list of script filenames - eg `['post.js']`
 * @return string doctype, opening `<html>` tag, and full `<head></head>` block
 */
function generateDocumentHead(string $title, array $extraStylesheets, array $extraScripts): string {
    $documentHead =  <<<HTML
        <!DOCTYPE html>
        <html lang="en" class="hidden">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1" />

          <title>
            $title | Our Site
          </title>

          <link rel="stylesheet" href="/css/reset.css">
          <link rel="stylesheet" href="/css/main.css">
          <link rel="stylesheet" href="/css/side-nav.css">
    HTML;

    foreach ($extraStylesheets as $stylesheet) {
        $documentHead .= "<link rel='stylesheet' href='/css/$stylesheet'>";
    }

    $documentHead .= '<link rel="icon" type="image/svg+xml" href="/vector-icons/favicon-light.svg">' .
                     '<script src="/scripts/side-nav.js" defer></script>';

    foreach ($extraScripts as $script) {
        $documentHead .= "<script src='/scripts/$script' defer></script>";
    }

    $documentHead .= '</head>';
    return $documentHead;
}

?>
