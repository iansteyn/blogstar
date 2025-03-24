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

    /**
     * Gets data for this postId, and gives it to the view.
     */
    public function blogPost($postId) {
        $isLoggedIn = AuthService::isLoggedIn();
        $isAdmin = AuthService::isAdmin();

        $postData = $this->postModel->getPostById($postId);
        $postData = setLikeAndSaveStatus($postData, $isLoggedIn, $this->likeModel, $this->saveModel);
        $postData['belongs_to_current_user'] = AuthService::isCurrentUser($postData['username']);

        $userData = $this->userModel->getUserByUsername($postData['username']);
        $comments = $this->commentModel->getComments($postId);
      
        foreach ($comments as &$comment) {
            $comment['belongs_to_current_user'] = AuthService::isCurrentUser($comment['username']);
        }
        unset($comment);

        // This view uses: $postData, $userData, $comments, $isLoggedIn, $isAdmin
        require __DIR__.'/../views/specific-post-view.php';
    }

    public function create() {
        AuthService::requireAuth(['registered','admin']);
        // If form is not submitted, just display the page:
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {

            $isLoggedIn = AuthService::isLoggedIn();
            $isAdmin = AuthService::isAdmin();

            // This view uses: $isLoggedIn, $isAdmin
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

    public function delete($postId) {
        AuthService::requireAuth(['registered', 'admin']);
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            header('Location: /home');
            exit;
        }
    
        $post = $this->postModel->getPostById($postId);
        if (!$post) {
            header('Location: /home');
            exit;
        }
        if ($_SESSION['username'] !== $post['username'] && $_SESSION['role'] !== 'admin') {
            header('Location: /home');
            exit;
        }
    
        $this->postModel->deletePost($postId);
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