<?php
/** view-helpers.php
 * ----------------------------------------------------------------------------------
 * Contains utility functions for views, ie logic that doesn't belong in controllers
 * but warrants being put into a function for reusability.
 * Include this file at the top of a view if you want to use any of these methods.
 * -----------------------------------------------------------------------------------
 */

function generateDocumentHead(string $title, array $extraStylesheets, array $extraScripts) {
    $documentHead =  <<<HTML
        <!DOCTYPE html>
        <html lang="en" class="hidden">
        <head>
          <meta charset="UTF-8">

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

    $documentHead .= '<!-- TODO insert favicon -->'.
                     '<script src="/scripts/side-nav.js" defer></script>';

    foreach ($extraScripts as $script) {
        $documentHead .= "<script src='/scripts/$script' defer></script>";
    }

    $documentHead .= '</head>';
    return $documentHead;
}

function isTabActive($tab, $activeTab) {
    if($tab == $activeTab) {
        return "active";
    }
    return "";
}

?>
