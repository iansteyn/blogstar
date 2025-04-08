<?php
require_once __DIR__.'/ErrorService.php';
require_once __DIR__.'/AuthStatus.php';

/**
 * A simple service class with static methods for authentication-based access control.
 */
class AuthAccess {

    /**
     * Call at the start of a controller function to restrict page/request access to certain roles.
     * Redirects to login if user is not logged in.
     * Redirects to forbidden error if user is logged but has incorrect role.
     * @param array $allowedRoles array of string role names
     */
    public static function restrictTo(array $allowedRoles) {

        if (! AuthStatus::isLoggedIn()) {
            Redirect::to('/login');
        }

        if (! in_array($_SESSION['role'], $allowedRoles)) {
            ErrorService::forbidden();
        }
    }
}
?>
