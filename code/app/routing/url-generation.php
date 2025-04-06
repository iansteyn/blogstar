<?php
/**
 * url-generation.php does two things:
 * 1. defines the application's base URL, depending on the server
 * 2. defines helper functions for generating URLs
 * 
 * It should be required once at the top of index.php,
 * with all other scripts assuming its availablity.
 * (since it is cumbersome to include it in literally every file).
 * 
 * NOTE: no file outside of this one should have to use $baseUrl directly,
 * EXCEPT in view-helpers.php, where it should be used to set the corresponding JavaScript variable.
 */

// TODO: define base URL

//TODO: define routeUrl()
//TODO: define resourceURL()