<?php
/**
 * Provides methods for configuring the application based on which server it is running on
 * (remote or local). This allows us to sync files with the remote server while continuing
 * to develop locally.
 */
class EnvironmentConfig {
    /**
     * @return string the base URL to be used in all links for the current server
     */
    public static function baseUrl() {
        //TODO
    }

    /**
     * Determines the database information used to connect to the correct database
     * (based on current server)
     * @return array with keys 'server', 'name', 'user', 'password';
     */
    public static function databaseInfo() {

    }
}