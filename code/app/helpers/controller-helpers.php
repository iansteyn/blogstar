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

/**
 * Adds'is_liked' and 'is_saved' boolean values to given post data array.
 * @param array $postData
 * @param bool $isLoggedIn
 * @param LikeModel $likeModel
 * @param SaveModel $saveModel
 * @return array a copy of `$postData` with the added keys
 */
function setLikeAndSaveStatus(array $postData, bool $isLoggedIn, LikeModel $likeModel, SaveModel $saveModel): array {
    if ($isLoggedIn) {
        $postData['is_liked'] = $likeModel->userHasLikedPost($_SESSION['username'], $postData['post_id']);
        $postData['is_saved'] = $saveModel->userHasSavedPost($_SESSION['username'], $postData['post_id']);
    }
    else {
        $postData['is_liked'] = false;
        $postData['is_saved'] = false;
    }
    return $postData;
}
?>
