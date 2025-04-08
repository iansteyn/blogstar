<?php

/**
 * A simple service class with static methods for checking authentication status of client
 */
class AuthStatus {
    /**
     * @return bool true if client is logged in, false otherwise
     */
    public static function isLoggedIn(): bool {
        return (isset($_SESSION['username']) and ! empty($_SESSION['username']));
    }

    /**
     * @return bool true if client is logged in and admin, false otherwise
     */
    public static function isAdmin(): bool {
        return (AuthStatus::isLoggedIn() and $_SESSION['role'] == 'admin');
    }

    /**
     * @param ?string $username
     * @return bool true if client is logged in and given `$username` matches theirs
     */
    public static function isCurrentUser(?string $username): bool {
        return (AuthStatus::isLoggedIn() and $_SESSION['username'] == $username);
    }
}


?>