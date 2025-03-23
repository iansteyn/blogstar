<?php
require_once __DIR__.'/../models/PostModel.php';
require_once __DIR__.'/../models/SaveModel.php';
require_once __DIR__.'/../models/LikeModel.php';
class PagesController {
    private $postModel;
    private $saveModel;
    private $likeModel;

    public function __construct($db) {
        $this->postModel = new PostModel($db);
        $this->saveModel = new saveModel($db);
        $this->likeModel = new likeModel($db);
    }

    public function home() {
        $activeTab = $_GET['tab'] ?? "recent";
        $recentPostsData = $this->postModel->getRecentPosts();

        foreach ($recentPostsData as &$postData) {
            $postData['is_liked'] = $this->likeModel->userHasLikedPost($_SESSION['username'], $postData['post_id']);
            $postData['is_saved'] = $this->saveModel->userHasSavedPost($_SESSION['username'], $postData['post_id']);
        }

        // This view uses: $activeTab, $recentPostsData
        require __DIR__.'/../views/home-view.php';
    }
}

?>