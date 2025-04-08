<?php
/* index.php
------------
This is the website's "root". All navigation and API requests are handled here,
so this is where:
- GENERAL PREP HAPPENS
  - The current session is started, before anything else happens.
  - important configuration files are included
  - common utitility/service classes are included
  - controllers are initiliazed
- ROUTES ARE DEFINED
*/

// GENERAL PREP
// ------------
// SESSION
session_start();

// CONFIG
require_once __DIR__.'/../config/url-generation.php';
require_once __DIR__.'/../config/db-connect.php';
$db = getDatabaseConnection();

// UTILITY
require_once __DIR__.'/../app/routing/Redirect.php';

// CONTROLLERS
require_once __DIR__.'/../app/controllers/HomeController.php';
require_once __DIR__.'/../app/controllers/ProfileController.php';
require_once __DIR__.'/../app/controllers/UserController.php';
require_once __DIR__.'/../app/controllers/PostController.php';
require_once __DIR__.'/../app/controllers/CommentController.php';
require_once __DIR__.'/../app/controllers/AdminController.php';
require_once __DIR__.'/../app/controllers/SearchController.php';
require_once __DIR__.'/../app/controllers/AboutController.php';
$homeController = new HomeController($db);
$profileController = new ProfileController($db);
$userController = new UserController($db);
$postController = new PostController($db);
$commentController = new CommentController($db);
$adminController = new AdminController($db);
$searchController = new SearchController($db);
$aboutController = new AboutController();

// ROUTE DEFINITIONS
// -----------------
require_once __DIR__.'/../app/routing/Router.php';
$router = new Router();

// SIDE-NAV TOP
$router->add('/', function() {
    Redirect::to('/home');
});

$router->add('/home', fn()=>
    $homeController->recent()
);
$router->add('/home/recent', fn()=>
    $homeController->recent()
);
$router->add('/home/popular', fn()=>
    $homeController->popular()
);
$router->add('/home/saved', fn()=>
    $homeController->saved()
);

$router->add('/profile', fn()=>
    $profileController->posts()
);
$router->add('/profile/posts', fn()=>
    $profileController->posts()
);
$router->add('/profile/saved', fn()=>
    $profileController->saved()
);
$router->add('/profile/settings', fn()=>
    $profileController->settings()
);
$router->add('/profile/posts/.+', fn($username)=>
    $profileController->posts($username)
);
$router->add('/profile/saved/.+', fn($username)=>
    $profileController->saved($username)
);

$router->add('/create', fn()=>
    $postController->create()
);
$router->add('/search', fn()=>
    $searchController->search()
);

// SIDE-NAV MIDDLE
$router->add('/admin', fn()=>
    $adminController->admin()
);

// SIDE_NAV BOTTOM
$router->add('/login', fn()=>
    $userController->login()
);
$router->add('/register', fn()=>
    $userController->register()
);
$router->add('/about', fn()=>
    $aboutController->about()
);
$router->add('/logout', fn()=>
    $userController->logout()
);

// OTHER
$router->add('/blog-post/.+', fn($postId) =>
    $postController->blogPost($postId)
);

// NON-DISPLAY REQUEST ROUTES
$router->add('/like/.+', fn($postId) =>
    $postController->toggleLike($postId)
);
$router->add('/save/.+', fn($postId) =>
    $postController->toggleSave($postId)
);
$router->add('/post/delete/.+', fn($postId) =>
    $postController->delete($postId)
);
$router->add('/post/edit/.+', fn($postId) =>
    $postController->edit($postId)
);

$router->add('/comment/create/.+', fn($postId) =>
    $commentController->create($postId)
);
$router->add('/comment/delete/.+', fn($commentId) =>
    $commentController->delete($commentId)
);

$router->add('/admin/search-users', fn() =>
    $adminController->searchUsers()
);

$router->add('/profile/update-settings', fn() =>
    $userController->updateSettings()
);

$router->submit();
?>