<?php

include __DIR__.'/../models/UserModel.php';
include __DIR__.'/../authentication/AuthService.php';

class ProfileController {
    private $userModel;

    public function __construct(PDO $db) {
        $this->userModel = new UserModel($db);
    }

    function profile() {
        $userData = $this->userModel->getUserByUsername($_SESSION['username']);
        AuthService::requireAuth(['registered','admin']);

        // This view uses: $userData
        require __DIR__.'/../views/profile-view.php';
    }
}