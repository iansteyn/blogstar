<?php

require_once __DIR__.'/AuthService.php';

class ErrorController {

    public function notFound() {
        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();

        $errorData = [
            'code'   => 404,
            'name'   => 'Page not found',
            'message' =>'Sorry! The page you are looking for does not exist.'
        ];

        // This view uses: $isLoggedIn, $isAdmin, $errorData
        require_once __DIR__."/../views/error-view.php";
    }
}

?>