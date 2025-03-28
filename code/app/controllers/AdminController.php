<?php
require_once __DIR__.'/../authentication/AuthService.php';
require_once __DIR__.'/../models/UserModel.php';

class AdminController {
    private $userModel;

    public function __construct(PDO $db) {
        $this->userModel = new UserModel($db);
    }

    public function admin() {
        AuthService::requireAuth(['admin']);

        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();

        if (!isset($_GET['terms'])) {
            $usernames = $this->userModel->getAllUsernames();
        }
        else {
            $searchValue = $_GET['terms'];
            $usernames = $this->userModel->getSearchedUsernames($searchValue);
        }
        

        // This view uses: $isLoggedIn, $isAdmin, $usernames
        require __DIR__.'/../views/admin-view.php';
    }
}

?>
