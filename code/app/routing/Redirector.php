<?php

/**
 * Provides static methods that simplify redirection logic.
 */
class Redirector {

    /**
     * Redirects the request to the given route,
     * and terminates current script execution.
     */
    public static function route(string $path) {
        header('location: '.routeUrl($path));
        exit;
    }
}
?>