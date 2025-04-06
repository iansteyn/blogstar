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

/**
 * Use this for most navigation links and API requests.
 * @param string $path the route path you want the request to take,
 * e.g. '/home/profile'. Note: leading slash is optional.
 * @return string a URL that can be mapped by Route.php.
 */
function routeUrl(string $path): string {
    global $baseUrl;
    return "$baseUrl?route=$path";
}

/**
 * Use this for links to resources like css files, vector icons, scripts, etc.
 * @param string $path the path from the website root (public_html) to the resource,
 * e.g. 'css/main.css'. Note: leading slashes should be removed.
 * @return string a URL that correctly locates the resource
 */
function resourceUrl(string $path): string {
    global $baseUrl;
    return $baseUrl . $path;
}

function basicUrl() {
    // or formURLField, etc something like that
    //TODO (for form actions that need to embed route as a hidden param)
}

/**
 * Since a GET-method form can drop query parameters given in the form action,
 * a special hidden element must be included in the form for it to be routed correctly.
 * This function is not needed for POST-method forms.
 * @param string $path the route path you want the request to take,
 * e.g. '/home/profile'. Note: leading slash is optional.
 * @return string the HTML element mentioned above
 */
function formRouteElement(string $path) {
    return "<input type='hidden' name='route' value='$path'>";
}