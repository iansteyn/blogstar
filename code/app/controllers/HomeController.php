<?php
require_once __DIR__.'/../models/PostModel.php';
require_once __DIR__.'/../models/SaveModel.php';
require_once __DIR__.'/../models/LikeModel.php';
require_once __DIR__.'/../helpers/controller-helpers.php';
require_once __DIR__.'/../services/AuthService.php';

class HomeController {
    private $postModel;
    private $saveModel;
    private $likeModel;

    public function __construct($db) {
        $this->postModel = new PostModel($db);
        $this->saveModel = new saveModel($db);
        $this->likeModel = new likeModel($db);
    }

    public function recent() {
        $activeTab = "recent";
        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();
        $postDataList = $this->postModel->getRecentPosts();

        foreach ($postDataList as &$postData) {
            $postData['belongs_to_current_user'] = AuthService::isCurrentUser($postData['username']);
            $postData = setLikeAndSaveStatus($postData, $isLoggedIn, $this->likeModel, $this->saveModel);
        }
        unset($postData);

        // This view uses: $activeTab, $postDataList, $isAdmin, $isLoggedIn
        require __DIR__.'/../views/home-view.php';
    }

    public function popular() {
        $activeTab = "popular";
        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();
        $postDataList = $this->postModel->getPopularPosts();

        foreach ($postDataList as &$postData) {
            $postData['belongs_to_current_user'] = AuthService::isCurrentUser($postData['username']);
            $postData = setLikeAndSaveStatus($postData, $isLoggedIn, $this->likeModel, $this->saveModel);
        }
        unset($postData);

        // This view uses: $activeTab, $postDataList, $isAdmin, $isLoggedIn
        require __DIR__.'/../views/home-view.php';
    }

    public function saved() {
        AuthAccess::restrictTo(['registered', 'admin']);

        $activeTab = "saved";
        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();
        $postDataList = $this->postModel->getSavedPosts($_SESSION['username']);

        foreach ($postDataList as &$postData) {
            $postData['belongs_to_current_user'] = AuthService::isCurrentUser($postData['username']);
            $postData = setLikeAndSaveStatus($postData, $isLoggedIn, $this->likeModel, $this->saveModel);
        }
        unset($postData);

        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();

        // This view uses: $activeTab, $postDataList, $isAdmin, $isLoggedIn
        require __DIR__.'/../views/home-view.php';
    }
}

?>