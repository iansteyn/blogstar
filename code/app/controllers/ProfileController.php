<?php

require_once __DIR__.'/../models/PostModel.php';
require_once __DIR__.'/../models/SaveModel.php';
require_once __DIR__.'/../models/UserModel.php';
require_once __DIR__.'/../models/LikeModel.php';
require_once __DIR__.'/../helpers/controller-helpers.php';
require_once __DIR__.'/../authentication/AuthService.php';

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
        AuthService::requireAuth(['registered','admin']);

        $username = $username ?? $_SESSION['username']; //use current user if no other user is provided

        $activeTab = "posts";
        $userData = $this->userModel->getUserByUsername($username);
        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();

        $postDataList = $this->postModel->getUserPosts($username);
        foreach ($postDataList as &$postData) {
            $postData = setLikeAndSaveStatus($postData, $isLoggedIn, $this->likeModel, $this->saveModel);
        }
        unset($postData);

        // This view uses: $userData, $isLoggedIn, $isAdmin
        require __DIR__.'/../views/profile-view.php';
    }

    public function saved() {
        AuthService::requireAuth(['registered', 'admin']);

        $activeTab = "saved";
        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();
        $userData = $this->userModel->getUserByUsername($_SESSION['username']);
        $postDataList = $this->postModel->getSavedPosts($_SESSION['username']);

        foreach ($postDataList as &$postData) {
            $postData = setLikeAndSaveStatus($postData, $isLoggedIn, $this->likeModel, $this->saveModel);
        }
        unset($postData);

        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();

        // This view uses: $activeTab, $postDataList, $isAdmin, $isLoggedIn
        require __DIR__.'/../views/profile-view.php';
    }

    function settings() {

    }
}