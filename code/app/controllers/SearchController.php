<?php

require_once __DIR__.'/../models/PostModel.php';
require_once __DIR__.'/../authentication/AuthService.php';

class SearchController {
    private $postModel;

    public function __construct(PDO $db) {
        $this->postModel = new PostModel($db);
    }

    public function search() {
        // TODO for milestone 4: search functionality

        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();

        // This view uses: $isLoggedIn, $isAdmin
        require_once __DIR__."/../views/search-view.php";
    }
}
?>