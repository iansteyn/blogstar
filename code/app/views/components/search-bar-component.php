<?php
/**
 * search-bar-component.php
 * This component requires the following variables:
 * @var string $searchAction - a URL route for the search request to be sent to
 */
?>

<!-- Note: CSS for this is in main.css -->
<form class="search-bar" action="<?= $searchAction ?>">
  <input
    type="search"
    name="search"
    placeholder="Search"
    title="Search posts by keyword"
    required
  />
  <button type="submit" class="button-icon-only">
    <svg class="icon-inline" preserveAspectRatio="xMidYMid meet">
      <use href="/../vector-icons/icons.svg#icon-search"></use>
    </svg>
  </button>
</form>
