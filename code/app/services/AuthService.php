<?php

/* Note: yes these two services are a little too coupled
   but its only because we have no access to server config stuff. */
require_once __DIR__.'/ErrorService.php';

class AuthService {

  /**
   * @param array $allowedRoles
   * Checks if users are logged in, and redirects them to the login page if not.
   * Checks user roles for restricted pages (e.g., admin page).
   */
  public static function requireAuth(array $allowedRoles) {
    if ( ! AuthService::isLoggedIn()) {
        header('location: '.routeUrl('/login'));
        exit;
    }

    if ( ! in_array($_SESSION['role'], $allowedRoles)) {
        ErrorService::unauthorized();
    }
  }

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
    return (AuthService::isLoggedIn() and $_SESSION['role'] == 'admin');
  }

  public static function isCurrentUser(?string $username): bool {
    return (AuthService::isLoggedIn() and $_SESSION['username'] == $username);
  } 
}

?>
