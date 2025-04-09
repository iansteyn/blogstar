<?php
/**
 * search-bar-component.php
 * This component requires the following variables:
 * @var string $searchAction - the path for the search request to be sent to
 * @var string $searchValue (optional) value to populate the searchbar with
 */

require_once __DIR__."/../../helpers/view-helpers.php";

// Set defaults for optional parameters
$searchValue = sanitizeData($searchValue ?? '');
?>

<!-- Note: CSS for this is in main.css -->
<form class="search-bar" action='<?= formActionUrl() ?>'>
  <?= formRouteElement($searchAction) ?>
  <input
    type="search"
    title="Search"
    name="terms"
    placeholder="Search"
    autocomplete="off"
    value="<?= $searchValue ?>"
  >
  <button type="submit" class="button-icon-only">
    <?= generateIconInline('icon-search') ?>
  </button>
</form>
