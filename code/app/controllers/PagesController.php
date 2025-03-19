<?php
require __DIR__.'/../models/PostModel.php';
require __DIR__.'/../models/SaveModel.php';
require __DIR__.'/../models/LikeModel.php';
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

        $this->postModel->getPostById(1);

        // $recentPostsData = $this->postModel->getRecentPosts();
        require __DIR__.'/../views/home-view.php';
    }
}

?>