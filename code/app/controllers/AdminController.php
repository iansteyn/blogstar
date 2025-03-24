<?php
require_once __DIR__.'/../authentication/AuthService.php';

class AdminController {
    public function admin() {
        AuthService::requireAuth(['admin']);

        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();

        // This view uses: $isLoggedIn, $isAdmin
        require __DIR__.'/../views/admin-view.php';
    }
}

?>
