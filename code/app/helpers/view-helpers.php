<?php
/** view-helpers.php
 * ----------------------------------------------------------------------------------
 * Contains utility functions for views, ie logic that doesn't belong in controllers
 * but warrants being put into a function for reusability.
 * Include this file at the top of a view if you want to use any of these methods.
 * -----------------------------------------------------------------------------------
 */

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

function isTabActive($tab, $activeTab) {
    if($tab == $activeTab) {
        return "active";
    }
    return "";
}

?>
