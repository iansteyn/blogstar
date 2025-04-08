<?php
require_once __DIR__.'/../models/UserModel.php';
require_once __DIR__.'/../models/PostModel.php';
require_once __DIR__.'/../services/AuthService.php';
require_once __DIR__.'/../helpers/controller-helpers.php';

class AdminController {
    private $userModel;
    private $postModel;

    public function __construct(PDO $db) {
        $this->userModel = new UserModel($db);
        $this->postModel = new PostModel($db);
    }

    public function admin() {
        AuthService::requireAuth(['admin']);

        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();
        $showResultMessage = false;
        $searchValue = '';
        $postAnalytics = $this->postModel->getPostAnalytics();
        extract($postAnalytics); // creates $total_posts, $posts_last_week, $posts_today
        $userAnalytics = $this->userModel->getUserAnalytics();
        extract($userAnalytics); // creates $total_users, $registered_past_week, $registered_today
        $likedPosts = $this->postModel->getMostLikedPosts();

        /* Note: this is distinct from the searchUsers function,
           because it handles the case where the user actually submits the search-bar form */
        if (isset($_GET['terms'])) {
            $showResultMessage = true;
            $searchValue = $_GET['terms'];
            $usernames = $this->userModel->getSearchedUsernames($searchValue);
        } else {
            $usernames = $this->userModel->getAllUsernames();
        }

        // This view uses: $isLoggedIn, $isAdmin, $usernames, $searchValue, $showResultMessage,
        // $total_posts, $posts_last_week, $posts_today, $total_users, $registered_past_week, $registered_today,
        // $likedPosts
        require __DIR__.'/../views/admin-view.php';
    }

    public function searchUsers() {

        if (isset($_GET['terms'])) {
            $usernames = $this->userModel->getSearchedUsernames($_GET['terms']);
        } else {
            $usernames = $this->userModel->getAllUsernames();
        }

        sendJsonResponse(['usernames' => $usernames]);
    }
}

?>
