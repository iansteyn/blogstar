<?php
/**
 * url-generation.php defines helper functions for generating URLs
 * 
 * It should be required once at the top of index.php,
 * with all other scripts assuming its availablity.
 * (since it is cumbersome to include it in literally every file).
 * 
 * The reason this is not a class is to reduce verbosity
 * - ie so links don't have to look like: `UrlGenerator::routeUrl('/home')"`
 * - and can instead look like `routeUrl('/home')`
 */

require_once __DIR__.'/EnvironmentConfig.php';

$baseUrl = EnvironmentConfig::baseUrl();

function basicUrl() {
    // or formURLField, etc something like that
    //TODO (for form actions that need to embed route as a hidden param)
}

/**
 * Use this for navigation links or requests that call controller functions.
 * @param string $path the route path you want the string to take, e.g. /home
 * @return string a URL that can be mapped by Route.php.
 */
function routeUrl(string $path): string {
    global $baseUrl;
    return "$baseUrl?route=$path";
}
//TODO: define resourceURL()