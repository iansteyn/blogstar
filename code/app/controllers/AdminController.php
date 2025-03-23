<?php
require_once __DIR__.'/../authentication/AuthService.php';

class AdminController {
    public function admin() {
        AuthService::requireAuth(['admin']);
        require __DIR__.'/../views/admin-view.php';
    }
}

?>
