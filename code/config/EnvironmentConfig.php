<?php
/**
 * Provides methods for configuring the application based on which server it is running on
 * (remote or local). This allows us to sync files with the remote server while continuing
 * to develop locally.
 */
class EnvironmentConfig {
    /**
     * Note: few files should have to use baseUrl directly;
     * links can instead be generated with the help of routing/url-generation.php
     * @return string the base URL to be used in all links for the current server
     */
    public static function baseUrl() {
        if ($_SERVER['SERVER_NAME'] === 'cosc360.ok.ubc.ca') {
            return '/iansteyn/';
        }
        return '/';
    }

    /**
     * Determines the database information used to connect to the correct database
     * (based on current server)
     * @return array with keys 'host', 'db_name', 'user', 'password';
     */
    public static function databaseInfo() {
        if ($_SERVER['SERVER_NAME'] === 'cosc360.ok.ubc.ca') {
            return [
                'host'     => 'localhost',
                'db_name'  => 'iansteyn',
                'user'     => 'iansteyn',
                'password' => 'iansteyn'
            ];
        }
        return [
            'host'     => 'localhost',
            'db_name'  => 'our_site',
            'user'     => 'root',
            'password' => ''
        ];
    }
}
?>