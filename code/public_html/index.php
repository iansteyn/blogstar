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
require_once __DIR__.'/../app/controllers/ErrorController.php';
$homeController = new HomeController($db);
$profileController = new ProfileController($db);
$userController = new UserController($db);
$postController = new PostController($db);
$commentController = new CommentController($db);
$adminController = new AdminController($db);
$searchController = new SearchController($db);
$aboutController = new AboutController();
$errorController = new ErrorController();

require_once __DIR__.'/../app/routing/Route.php';
$route = new Route();

// SIDE-NAV TOP
$route->add('/', function() {
    header('location: '.routeUrl('/home'));
    exit;
});

$route->add('/home', fn()=>
    $homeController->recent()
);
$route->add('/home/recent', fn()=>
    $homeController->recent()
);
$route->add('/home/popular', fn()=>
    $homeController->popular()
);
$route->add('/home/saved', fn()=>
    $homeController->saved()
);

$route->add('/profile', fn()=>
    $profileController->posts()
);
$route->add('/profile/posts', fn()=>
    $profileController->posts()
);
$route->add('/profile/saved', fn()=>
    $profileController->saved()
);
$route->add('/profile/settings', fn()=>
    $profileController->settings()
);
$route->add('/profile/update-settings', fn() =>
    $userController->updateSettings()
);
$route->add('/profile/posts/.+', fn($username)=>
    $profileController->posts($username)
);
$route->add('/profile/saved/.+', fn($username)=>
    $profileController->saved($username)
);

$route->add('/create', fn()=>
    $postController->create()
);
$route->add('/search', fn()=>
    $searchController->search()
);

// SIDE-NAV MIDDLE
$route->add('/admin', fn()=>
    $adminController->admin()
);

// SIDE_NAV BOTTOM
$route->add('/login', fn()=>
    $userController->login()
);
$route->add('/register', fn()=>
    $userController->register()
);
$route->add('/about', fn()=>
    $aboutController->about()
);
$route->add('/logout', fn()=>
    $userController->logout()
);

// OTHER
$route->add('/blog-post/.+', fn($postId) =>
    $postController->blogPost($postId)
);

// ROUTES THAT DO NOT LEAD TO DISPLAY
$route->add('/like/.+', fn($postId) =>
    $postController->toggleLike($postId)
);
$route->add('/save/.+', fn($postId) =>
    $postController->toggleSave($postId)
);
$route->add('/comment/create/.+', fn($postId) =>
    $commentController->create($postId)
);
$route->add('/comment/delete/.+', fn($commentId) =>
    $commentController->delete($commentId)
);
$route->add('/post/delete/.+', fn($postId) =>
    $postController->delete($postId)
);

$route->add('/post/edit/.+', fn($postId) =>
    $postController->edit($postId)
);
$route->add('/admin/search-users', fn() =>
    $adminController->searchUsers()
);

// TODO add routing for error pages?
$route->add('/error', fn()=>
    $errorController->notFound()
);

$route->submit();
?>