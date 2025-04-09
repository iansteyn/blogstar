<?php
require_once __DIR__.'/../models/PostModel.php';
require_once __DIR__.'/../models/SaveModel.php';
require_once __DIR__.'/../models/LikeModel.php';
require_once __DIR__.'/../models/UserModel.php';
require_once __DIR__.'/../models/CommentModel.php';
require_once __DIR__.'/../helpers/controller-helpers.php';

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
     * Helper function that handles errors related to postIds.
     */
    private function validatePostId($postId) {
        if (! ctype_digit($postId)) {
            ErrorService::badRequest();
        }
        if (! $this->postModel->postExists($postId)) {
            ErrorService::notFound();
        }
    }

    /**
     * Call to restrict action to the resource owner.
     */
    private function restrictToOwner($postId) {
        $post = $this->postModel->getPostById($postId);

        if (! AuthStatus::isCurrentUser($post['username'])) {
            ErrorService::forbidden();
        }
    }

    private function restrictToOwnerOrAdmin($postId) {
        $post = $this->postModel->getPostById($postId);

        if (! AuthStatus::isCurrentUser($post['username']) and ! AuthStatus::isAdmin()) {
            ErrorService::forbidden();
        }
    }

    /**
     * Gets data for this postId, and gives it to the view.
     */
    public function blogPost($postId) {

        $this->validatePostId($postId);

        $isLoggedIn = AuthStatus::isLoggedIn();
        $isAdmin = AuthStatus::isAdmin();

        $postData = $this->postModel->getPostById($postId);
        $postData = setLikeAndSaveStatus($postData, $isLoggedIn, $this->likeModel, $this->saveModel);
        $postData['belongs_to_current_user'] = AuthStatus::isCurrentUser($postData['username']);

        $userData = $this->userModel->getUserByUsername($postData['username']);
        $comments = $this->commentModel->getComments($postId);
      
        foreach ($comments as &$comment) {
            $comment['belongs_to_current_user'] = AuthStatus::isCurrentUser($comment['username']);
        }
        unset($comment);

        // This view uses: $postData, $userData, $comments, $isLoggedIn, $isAdmin
        require __DIR__.'/../views/specific-post-view.php';
    }

    public function create() {
        AuthAccess::restrictTo(['registered','admin']);

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $isLoggedIn = AuthStatus::isLoggedIn();
            $isAdmin = AuthStatus::isAdmin();

            // passing in empty post data on creation
            // This view uses: $isLoggedIn
            require __DIR__.'/../views/create-edit-view.php';
            return;
        }

        $this->postModel->createPost([
            'username'   => $_SESSION['username'],
            'post_title' => $_POST['post-title'],
            'post_body'  => $_POST['post-body'],
            'post_image' => $_FILES['post-image']
        ]);
        Redirect::to('/profile');
    }

    public function delete($postId) {
        AuthAccess::restrictTo(['registered', 'admin']);

        $this->validatePostId($postId);
        $this->restrictToOwnerOrAdmin($postId);

        $this->postModel->deletePost($postId);

        if (isset($_SERVER['HTTP_REFERER']) and ! str_ends_with($_SERVER['HTTP_REFERER'], $postId)) {
            Redirect::to($_SERVER['HTTP_REFERER']);
        } else {
            Redirect::to('/profile');
        }
    }

    public function edit($postId) {
        AuthAccess::restrictTo(['registered', 'admin']);

        $this->validatePostId($postId);
        $this->restrictToOwner($postId);

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $isLoggedIn = AuthStatus::isLoggedIn();
            $isAdmin = AuthStatus::isAdmin();
            $postData = $this->postModel->getPostById($postId);

            // This view uses: $postData, $isLoggedIn, $isAdmin
            require __DIR__.'/../views/create-edit-view.php';
            return;
        }

        $updatedPostData = [
            'post_id' => $postId,
            'post_title' => $_POST['post-title'],
            'post_body' => $_POST['post-body']
        ];

        if (!empty($_FILES['post-image']['tmp_name'])) {
            $updatedPostData['post_image'] = $_FILES['post-image'];
        }

        $this->postModel->updatePost($updatedPostData);
        Redirect::to("/blog-post/$postId");
    }

    /**
     * Toggles whether the current user likes the given post or not
     */
    public function toggleLike($postId) {
        ErrorService::requirePostRequest();
        AuthAccess::restrictTo(['registered', 'admin']);
        $this->validatePostId($postId);

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
    public function toggleSave($postId) {
        ErrorService::requirePostRequest();
        AuthAccess::restrictTo(['registered', 'admin']);
        $this->validatePostId($postId);

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