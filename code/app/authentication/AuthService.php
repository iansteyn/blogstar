<?php

class AuthService {
  /**
   * @param array $allowedRoles
   * Checks if users are logged in, and redirects them to the login page if not.
   * Checks user roles for restricted pages (e.g., admin page).
   */
  public static function requireAuth(array $allowedRoles) {
    // Check if the user is logged in
    if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
      header('location: /?route=/login');
      exit;
    }

    // If roles are specified for a page, check the user role and redirect
    if (!empty($allowedRoles)) {
      if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $allowedRoles)) {
        header('location: /?route=/error');
        exit;
      }
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
