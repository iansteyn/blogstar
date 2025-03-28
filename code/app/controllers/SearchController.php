<?php

require_once __DIR__.'/../models/PostModel.php';
require_once __DIR__.'/../models/LikeModel.php';
require_once __DIR__.'/../models/SaveModel.php';
require_once __DIR__.'/../authentication/AuthService.php';

class SearchController {
    private $postModel;
    private $likeModel;
    private $saveModel;

    public function __construct(PDO $db) {
        $this->postModel = new PostModel($db);
        $this->likeModel = new LikeModel($db);
        $this->saveModel = new SaveModel($db);
    }

    public function search() {
        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();
        $showResults = false;
        $postDataList = [];
        $searchValue = '';

        if (isset($_GET['terms'])) {
            $showResults = true;
            $searchValue = $_GET['terms'];

            $keywords = explode(' ', $searchValue);
            $postDataList = $this->postModel->getSearchedPosts($keywords);

            foreach ($postDataList as &$postData) {
                $postData['belongs_to_current_user'] = AuthService::isCurrentUser($postData['username']);
                $postData = setLikeAndSaveStatus($postData, $isLoggedIn, $this->likeModel, $this->saveModel);
            }
            unset($postData);
        }

        // This view uses: $isLoggedIn, $isAdmin, $showResults, $postDataList, $searchValue
        require_once __DIR__."/../views/search-view.php";
    }
}
?>