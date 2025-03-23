<?php
/* controller-helpers.php
 * -------------------------------------------------------------------------------------
 * Contains utility functions for controllers.
 * Include this file at the top of a controller if you want to use any of these methods.
 * -------------------------------------------------------------------------------------
 */

/**
 * Encodes data as an associative array as JSON, and sends it as a response to the client.
 * @param array $data
 * @return void
 */
function sendJsonResponse(array $data): void {
    header('Content-Type: application/json');
    echo json_encode($data);
}

?>
