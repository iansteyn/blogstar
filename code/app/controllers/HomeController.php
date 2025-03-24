<?php
require_once __DIR__.'/../models/PostModel.php';
require_once __DIR__.'/../models/SaveModel.php';
require_once __DIR__.'/../models/LikeModel.php';
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

        // if (isset($_SESSION['username'])) {
        //     $savedPostsData = $this->postModel->getSavedPosts($_SESSION['username']);

            
        //     foreach ($savedPostsData as &$postData) {
        //         $this->setLikeAndSaveStatus($postData);
        //     }
        //     unset($postData); //required to remove the &reference binding
        // }
        // else {
        //     $savedPostsData = [];

        //     foreach ($recentPostsData as &$postData) {
        //         $postData['is_liked'] = false;
        //         $postData['is_saved'] = false;
        //     }
        //     unset($postData);
        // }

        // This view uses: $activeTab, $recentPostsData, $savedPostsData
        require __DIR__.'/../views/home-view.php';
    }

    public function popular() {
        $activeTab = "popular";
        $postDataList = [];
        require __DIR__.'/../views/home-view.php';
    }

    //TODO: require auth for this one -- and pass isLoggedIn variable in to hide the tab
    public function saved() {
        $activeTab = "saved";
        $postDataList = [];
        require __DIR__.'/../views/home-view.php';
    }
}

?>