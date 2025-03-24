<?php
require_once __DIR__.'/../models/PostModel.php';
require_once __DIR__.'/../models/SaveModel.php';
require_once __DIR__.'/../models/LikeModel.php';
require_once __DIR__.'/../authentication/AuthService.php';

class HomeController {
    private $postModel;
    private $saveModel;
    private $likeModel;

    public function __construct($db) {
        $this->postModel = new PostModel($db);
        $this->saveModel = new saveModel($db);
        $this->likeModel = new likeModel($db);
    }

    /**
     * Helper method; adds or sets `'is_liked'` and `'is_saved'` in the given `postData` array.
     * @param array &$postData post data array passed by reference
     * @return void
     */
    private function setLikeAndSaveStatus(array $postData): array {
        if (isset($_SESSION['username'])) {
            $postData['is_liked'] = $this->likeModel->userHasLikedPost($_SESSION['username'], $postData['post_id']);
            $postData['is_saved'] = $this->saveModel->userHasSavedPost($_SESSION['username'], $postData['post_id']);
        }
        else {
            $postData['is_liked'] = false;
            $postData['is_saved'] = false;
        }
        return $postData;
    }

    public function recent() {
        $activeTab = "recent";
        $postDataList = $this->postModel->getRecentPosts();

        foreach ($postDataList as &$postData) {
            $postData = $this->setLikeAndSaveStatus($postData);
        }
        unset($postData);

        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();

        // This view uses: $activeTab, $postDataList, $isAdmin, $isLoggedIn
        require __DIR__.'/../views/home-view.php';
    }

    public function popular() {
        $activeTab = "popular";
        $postDataList = $this->postModel->getPopularPosts();

        foreach ($postDataList as &$postData) {
            $postData = $this->setLikeAndSaveStatus($postData);
        }
        unset($postData);

        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();

        // This view uses: $activeTab, $postDataList, $isAdmin, $isLoggedIn
        require __DIR__.'/../views/home-view.php';
    }

    public function saved() {
        AuthService::requireAuth(['registered', 'admin']);

        $activeTab = "saved";
        $postDataList = $this->postModel->getSavedPosts($_SESSION['username']);

        foreach ($postDataList as &$postData) {
            $postData = $this->setLikeAndSaveStatus($postData);
        }
        unset($postData);

        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();

        // This view uses: $activeTab, $postDataList, $isAdmin, $isLoggedIn
        require __DIR__.'/../views/home-view.php';
    }
}

?>