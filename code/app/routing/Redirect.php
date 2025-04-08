<?php

/**
 * Provides static methods that simplify redirection logic.
 */
class Redirect {

    /**
     * Redirects the current request to the given `$route` (e.g. '/home'),
     * and terminates current script execution.
     */
    public static function to(string $route) {
        header('location: '.routeUrl($route));
        exit;
    }
}
?>