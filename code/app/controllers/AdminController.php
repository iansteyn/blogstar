<?php
require_once __DIR__.'/../models/UserModel.php';
require_once __DIR__.'/../authentication/AuthService.php';
require_once __DIR__.'/../helpers/controller-helpers.php';

class AdminController {
    private $userModel;

    public function __construct(PDO $db) {
        $this->userModel = new UserModel($db);
    }

    public function admin() {
        AuthService::requireAuth(['admin']);

        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();
        $showResultMessage = false;
        $searchValue = '';

        /* Note: this is distinct from the searchUsers function,
           because it handles the case where the user actually submits the search-bar form */
        if (isset($_GET['terms'])) {
            $showResultMessage = true;
            $searchValue = $_GET['terms'];
            $usernames = $this->userModel->getSearchedUsernames($searchValue);
        } else {
            $usernames = $this->userModel->getAllUsernames();
        }

        // This view uses: $isLoggedIn, $isAdmin, $usernames, $searchValue, $showResultMessage
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
