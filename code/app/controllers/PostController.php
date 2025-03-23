<?php
require_once __DIR__.'/../models/PostModel.php';
require_once __DIR__.'/../models/SaveModel.php';
require_once __DIR__.'/../models/LikeModel.php';
require_once __DIR__.'/../models/UserModel.php';
require_once __DIR__.'/../models/CommentModel.php';
require_once __DIR__.'/../helpers/controller-helpers.php';
require_once __DIR__.'/../authentication/AuthService.php';

class PostController {
    private $postModel;
    private $userModel;
    private $saveModel;
    private $likeModel;
    private $commentModel;

    public function __construct($db) {
        $this->postModel = new PostModel($db);
        $this->userModel = new UserModel($db);
        $this->saveModel = new saveModel($db);
        $this->likeModel = new likeModel($db);
        $this->commentModel = new CommentModel($db);
    }

    public function blogPost($postId) {
        $postData = $this->postModel->getPostById($postId);

        if (isset($_SESSION['username'])) {
            $postData['is_liked'] = $this->likeModel->userHasLikedPost($_SESSION['username'], $postId);
            $postData['is_saved'] = $this->saveModel->userHasSavedPost($_SESSION['username'], $postId);
        }
        else {
            $postData['is_liked'] = false;
            $postData['is_saved'] = false;
        }
        

        $userData = $this->userModel->getUserByUsername($postData['username']);

        // getting the comments for the specific post
        $comments = $this->commentModel->getComments($postId);
        // This view uses: $postData, $userData
        require __DIR__.'/../views/specific-post-view.php';
    }

    public function create() {
        AuthService::requireAuth(['registered','admin']);
        // If form is not submitted, just display the page:
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {

            require __DIR__.'/../views/create-view.php';
            return;
        }
        // Otherwise, handle the submission:
        
            //ammend this to hard-coded as needed
            $this->postModel->createPost([
                'username'   => $_SESSION['username'],
                'post_title' => $_POST['post-title'],
                'post_body'  => $_POST['post-body'],
                'post_image' => $_FILES['post-image']

            ]);
            header('Location: /profile');
            exit;
        
    }

    /**
     * Toggles whether the current user likes the given post or not
     */
    public function toggleLike(int $postId) {
        $username = $_SESSION['username'];
        $isLiked = $this->likeModel->userHasLikedPost($username, $postId);

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

    /**
     * Toggles whether the current user saves the given post or not
     */
    public function toggleSave(int $postId) {
        $username = $_SESSION['username'];
        $isSaved = $this->saveModel->userHasSavedPost($username, $postId);

        if ($isSaved) {
            $success = $this->saveModel->removeSave($username, $postId);
        } else {
            $success = $this->saveModel->addSave($username, $postId);
        }

        if ($success) {
            sendJsonResponse(['success' => $success]);
        } else {
            sendJsonResponse(['success' => $success, 'message' => 'Failed to toggle save.']);
        }
    }
}

?>