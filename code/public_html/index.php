<?php
/* index.php
------------
This is the website's "root". All navigation and API requests are handled here,
so this is where important configuration files are included and routes are set up.
The current session is also started here, before anything else happens.
*/

session_start();

require_once __DIR__.'/../config/url-generation.php';
require_once __DIR__.'/../config/db-connect.php';
$db = getDatabaseConnection();

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

require_once __DIR__.'/../app/routing/Router.php';
$router = new Router();

// SIDE-NAV TOP
$router->add('/', function() {
    header('location: '.routeUrl('/home'));
    exit;
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
$router->add('/profile/update-settings', fn() =>
    $userController->updateSettings()
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

// ROUTES THAT DO NOT LEAD TO DISPLAY
$router->add('/like/.+', fn($postId) =>
    $postController->toggleLike($postId)
);
$router->add('/save/.+', fn($postId) =>
    $postController->toggleSave($postId)
);
$router->add('/comment/create/.+', fn($postId) =>
    $commentController->create($postId)
);
$router->add('/comment/delete/.+', fn($commentId) =>
    $commentController->delete($commentId)
);
$router->add('/post/delete/.+', fn($postId) =>
    $postController->delete($postId)
);

$router->add('/post/edit/.+', fn($postId) =>
    $postController->edit($postId)
);
$router->add('/admin/search-users', fn() =>
    $adminController->searchUsers()
);

$router->submit();
?>