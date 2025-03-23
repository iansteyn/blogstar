<?php
require_once __DIR__.'/../models/PostModel.php';
require_once __DIR__.'/../models/SaveModel.php';
require_once __DIR__.'/../models/LikeModel.php';
require_once __DIR__.'/../models/UserModel.php';
require_once __DIR__.'/../helpers/controller-helpers.php';

class PostController {
    private $postModel;
    private $userModel;
    private $saveModel;
    private $likeModel;

    public function __construct($db) {
        $this->postModel = new PostModel($db);
        $this->userModel = new UserModel($db);
        $this->saveModel = new saveModel($db);
        $this->likeModel = new likeModel($db);
    }

    public function blogPost($postId) {
        $postData = $this->postModel->getPostById($postId);
        $postData['is_liked'] = $this->likeModel->doesUserLikePost($_SESSION['username'], $postId);;
        $postData['is_saved'] = $this->likeModel->doesUserLikePost($_SESSION['username'], $postId);;

        $userData = $this->userModel->getUserByUsername($postData['username']);

        // This view uses: $postData, $userData
        require __DIR__.'/../views/specific-post-view.php';
    }

    public function create() {
        // If form is not submitted, just display the page:
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            require __DIR__.'/../views/create-view.php';
        }
        // Otherwise, handle the submission:
        else {
            //ammend this to hard-coded as needed
            $this->postModel->createPost([
                'username'   => "spooky",
                'post_title' => $_POST['post-title'],
                'post_body'  => $_POST['post-body'],
                'post_image' => "../photo/sadie-smith.jpg"

            ]);
            header('Location: /profile');
            exit;
        }
    }

    /**
     * Toggles whether the current user likes the given post or not
     */
    public function toggleLike(int $postId) {
        $username = $_SESSION['username'];
        $isLiked = $this->likeModel->doesUserLikePost($username, $postId);

        if ($isLiked) {
            $success = $this->likeModel->removeLike($username, $postId);
        } else {
            $success = $this->likeModel->addLike($username, $postId);
        }

        if ($success) {
            sendJsonResponse(['success' => $success]);
        } else {
            sendJsonResponse(['success' => $success, 'message' => 'Failed to toggle like.']);
        }
    }
}

?>