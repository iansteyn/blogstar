<?php

require_once __DIR__.'/../models/PostModel.php';
require_once __DIR__.'/../models/SaveModel.php';
require_once __DIR__.'/../models/UserModel.php';
require_once __DIR__.'/../models/LikeModel.php';
require_once __DIR__.'/../helpers/controller-helpers.php';
require_once __DIR__.'/../services/AuthService.php';

class ProfileController {
    private $userModel;
    private $postModel;
    private $saveModel;
    private $likeModel;


    public function __construct(PDO $db) {
        $this->userModel = new UserModel($db);
        $this->postModel = new PostModel($db);
        $this->saveModel = new saveModel($db);
        $this->likeModel = new likeModel($db);
    }

    function posts(?string $username = null) {
        AuthAccess::restrictTo(['registered','admin']);

        if (AuthService::isCurrentUser($username)) {
            header('location: '.routeUrl('/profile'));
            exit;
        }

        $username = $username ?? $_SESSION['username']; //use current user if no other user is provided

        $userData = $this->userModel->getUserByUsername($username);
        $userData['is_current_user'] = AuthService::isCurrentUser($username);

        $activeTab = "posts";
        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();

        $postDataList = $this->postModel->getUserPosts($username);
        foreach ($postDataList as &$postData) {
            $postData['belongs_to_current_user'] = AuthService::isCurrentUser($postData['username']);
            $postData = setLikeAndSaveStatus($postData, $isLoggedIn, $this->likeModel, $this->saveModel);
        }
        unset($postData);

        // This view uses: $userData, $activeTab, $isLoggedIn, $isAdmin
        require __DIR__.'/../views/profile-view.php';
    }

    public function saved(?string $username = null) {
        AuthAccess::restrictTo(['registered', 'admin']);

        if (AuthService::isCurrentUser($username)) {
            header('location: '.routeUrl('/profile/saved'));
            exit;
        }

        $username = $username ?? $_SESSION['username']; //use current user if no other user is provided

        $userData = $this->userModel->getUserByUsername($username);
        $userData['is_current_user'] = AuthService::isCurrentUser($username);

        $activeTab = "saved";
        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();

        $postDataList = $this->postModel->getSavedPosts($username);
        foreach ($postDataList as &$postData) {
            $postData['belongs_to_current_user'] = AuthService::isCurrentUser($postData['username']);
            $postData = setLikeAndSaveStatus($postData, $isLoggedIn, $this->likeModel, $this->saveModel);
        }
        unset($postData);

        // This view uses: $userData, $activeTab, $postDataList, $isAdmin, $isLoggedIn
        require __DIR__.'/../views/profile-view.php';
    }

    function settings() {
        AuthAccess::restrictTo(['registered', 'admin']);

        $activeTab = "settings";
        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();
        $userData = $this->userModel->getUserByUsername($_SESSION['username']);
        $userData['is_current_user'] = true;

        // This view uses: $activeTab, $userData, $isAdmin, $isLoggedIn
        require __DIR__.'/../views/profile-view.php';
    }
}