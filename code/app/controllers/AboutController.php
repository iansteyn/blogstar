<?php
class AboutController {
    public function about() {
        $isLoggedIn = AuthStatus::isLoggedIn();
        $isAdmin = AuthStatus::isAdmin();

        // This view uses: $isLoggedIn, $isAdmin
        require_once __DIR__."/../views/about-view.php";
    }
}
?>