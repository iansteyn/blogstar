<?php
/* view-helpers.php
 * ----------------------------------------------------------------------------------
 * Contains utility functions for views, ie logic that doesn't belong in controllers
 * but warrants being put into a function for reusability.
 * Include this file at the top of a view if you want to use any of these methods.
 * -----------------------------------------------------------------------------------
 */


/**
 * Properly escapes data for display in view. 
 * @param mixed $data can be an array or a single value (string, int etc)
 * @return mixed a properly escaped copy of `$data`
 */
function sanitizeData(mixed $data): mixed {
  $sanitizedData = null;

  if (is_array($data)) {
      $sanitizedData = [];
      foreach ($data as $key => $value) {
          if ($key == 'post_image' || $key == 'profile_picture') {
              $sanitizedData[$key] = $value;
          } else {
              $sanitizedData[$key] = htmlspecialchars($value);
          }
      }
  } else {
      $sanitizedData = htmlspecialchars($data);
  }

  return $sanitizedData;
}

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

/**
 * Generates a simple inline icon that can be used alongside text.
 *
 * Reduces the verbosity of including simple icons in views.
 * Note: this function assumes the given icon is already defined in `icons.svg`.
 * @param string $name the name of the icon resource, e.g. "icon-logo"
 */
function generateIconInline(string $name): string {
    $resourceUrl = resourceUrl("vector-icons/icons.svg#$name");

    return <<<HTML
      <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
        <use href="$resourceUrl"></use>
      </svg>
    HTML;
}

function generatePostingInfo(string $username, $sqlDateTime): string {
    $usernameLink = routeUrl("/profile/posts/$username");

    $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $sqlDateTime);
    $formattedDate = $dateTime->format('F j, Y');
    $htmlDateTime = $dateTime->format('Y-m-d\TH:i');

    return <<<HTML
      <div class="posting-info">
        <a class="username" href="$usernameLink" title="Author">
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

    $faviconUrl = resourceUrl('vector-icons/favicon-light.svg');

    $documentHead =  <<<HTML
        <!DOCTYPE html>
        <html lang="en" class="hidden">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1" />

          <title>
            $title | Our Site
          </title>

          <link rel="icon" type="image/svg+xml" href="$faviconUrl">
    HTML;

    $defaultStylesheets = ['reset.css', 'main.css', 'side-nav.css'];
    $defaultScripts = ['side-nav.js'];

    $allStylesheets = array_merge($defaultStylesheets, $extraStylesheets);
    $allScripts = array_merge($defaultScripts, $extraScripts);

    foreach ($allStylesheets as $stylesheet) {
        $resourceUrl = resourceUrl("css/$stylesheet");
        $documentHead .= "<link rel='stylesheet' href='$resourceUrl'>";
    }

    foreach ($allScripts as $script) {
        $resourceUrl = resourceUrl("scripts/$script");
        $documentHead .= "<script src='$resourceUrl' defer></script>";
    }

    $documentHead .= '</head>';
    return $documentHead;
}

?>
