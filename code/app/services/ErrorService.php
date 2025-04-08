<?php

require_once __DIR__.'/AuthService.php';

class ErrorService {

    /**
     * Gives the browser a 404 response code and displays not found error page.
     * Call this when resources are requested that do not exist
     */
    public static function notFound() {
        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();

        $errorData = [
            'code'    => 404,
            'name'    => 'Page not found',
            'message' => 'Sorry! The page you are looking for does not exist.'
        ];

        http_response_code(404);
        // This view uses: $isLoggedIn, $isAdmin, $errorData
        require_once __DIR__."/../views/error-view.php";
    }

    /**
     * Gives the browser a 400 response code and displays error page.
     * Call this when resources are requested in a way that does not make sense,
     * e.g. /blog-post/banana
     */
    public static function badRequest() {
        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();

        $errorData = [
            'code'    => 400,
            'name'    => 'Bad Request',
            'message' => "Sorry! We couldn't process your request"
        ];

        http_response_code(400);
        // This view uses: $isLoggedIn, $isAdmin, $errorData
        require_once __DIR__."/../views/error-view.php";
    }

    /**
     * Gives the browser a 401 unauthorized response code and displays error page.
     * Call if user attempts to access a page that requires special roles (like admin)
     */
    public static function unauthorized() {
        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();

        $errorData = [
            'code'    => 401,
            'name'    => 'Unauthorized Access',
            'message' => "Sorry! You do not have access to this page."
        ];

        http_response_code(400);
        // This view uses: $isLoggedIn, $isAdmin, $errorData
        require_once __DIR__."/../views/error-view.php";
    }
}

?>