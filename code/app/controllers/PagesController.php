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

    /**
     * Helper method; adds or sets `'is_liked'` and `'is_saved'` in the given `postData` array.
     * @param array &$postData post data array passed by reference
     * @return void
     */
    private function setLikeAndSaveStatus(array &$postData): void {
        $postData['is_liked'] = $this->likeModel->userHasLikedPost($_SESSION['username'], $postData['post_id']);
        $postData['is_saved'] = $this->saveModel->userHasSavedPost($_SESSION['username'], $postData['post_id']);
    }

    public function home() {
        $activeTab = $_GET['tab'] ?? "recent";
        $recentPostsData = $this->postModel->getRecentPosts();
        $savedPostsData = $this->postModel->getSavedPosts($_SESSION['username']);

        foreach ($recentPostsData as &$postData) {
            $this->setLikeAndSaveStatus($postData);
        }
        foreach ($savedPostsData as &$postData) {
            $this->setLikeAndSaveStatus($postData);
        }
        unset($postData); //required to remove the &reference binding

        // This view uses: $activeTab, $recentPostsData, $savedPostsData
        require __DIR__.'/../views/home-view.php';
    }
}

?>