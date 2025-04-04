<?php
/**
 * search-bar-component.php
 * This component requires the following variables:
 * @var string $searchAction - a URL route for the search request to be sent to
 * @var string $searchValue (optional) value to populate the searchbar with
 * @var bool $isRequired (optional) determines if searchbar can be empty on submission
 */

require_once __DIR__."/../../helpers/view-helpers.php";

// Set defaults for optional parameters
$searchValue = sanitizeData($searchValue ?? '');
$isRequired = $isRequired ?? true;
?>

<!-- Note: CSS for this is in main.css -->
<form class="search-bar" action="<?= $searchAction ?>">
  <input
    type="search"
    title="Search"
    name="terms"
    placeholder="Search"
    autocomplete="off"
    value="<?= $searchValue ?>"
    <?= $isRequired ? 'required' : '' ?>
  >
  <button type="submit" class="button-icon-only">
    <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
      <use href="/../vector-icons/icons.svg#icon-search"></use>
    </svg>
  </button>
</form>
