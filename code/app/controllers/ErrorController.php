<?php

require_once __DIR__.'/../authentication/AuthService.php';

class ErrorController {

    public function about() {
        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();

        // This view uses: $isLoggedIn, $isAdmin
        require_once __DIR__."/../views/error-view.php";
    }
}

?>