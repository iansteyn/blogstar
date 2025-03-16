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

?>
