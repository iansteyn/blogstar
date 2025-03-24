<?php

require_once __DIR__.'/../models/UserModel.php';
require_once __DIR__.'/../authentication/AuthService.php';

class ProfileController {
    private $userModel;

    public function __construct(PDO $db) {
        $this->userModel = new UserModel($db);
    }

    function profile() {
        AuthService::requireAuth(['registered','admin']);

        $userData = $this->userModel->getUserByUsername($_SESSION['username']);
        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();

        // This view uses: $userData, $isLoggedIn, $isAdmin
        require __DIR__.'/../views/profile-view.php';
    }
}