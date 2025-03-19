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

        // var_dump($this->postModel->getPostById(4));
        // var_dump($this->postModel->getRecentPosts());

        $recentPostsData = $this->postModel->getRecentPosts();
        require __DIR__.'/../views/home-view.php';
    }
}

?>