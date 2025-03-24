<?php
session_start();
/* index.php
------------
This is the website's "root".
Here, we set-up URL routing, so that all of our pages can be viewed without needing the whole URL.
*/

include __DIR__.'/../db_config/db_connect.php';
$db = getDatabaseConnection();

include __DIR__.'/../app/controllers/HomeController.php';
include __DIR__.'/../app/controllers/ProfileController.php';
include __DIR__.'/../app/controllers/UserController.php';
include __DIR__.'/../app/controllers/PostController.php';
include __DIR__.'/../app/controllers/CommentController.php';
include __DIR__.'/../app/controllers/AdminController.php';
include __DIR__.'/../app/controllers/SearchController.php';
$homeController = new HomeController($db);
$profileController = new ProfileController($db);
$userController = new UserController($db);
$postController = new PostController($db);
$commentController = new commentController($db);
$adminController = new AdminController($db);
$searchController = new SearchController($db);

include __DIR__.'/../app/routing/route.php';
$route = new Route();

// SIDE-NAV TOP
$route->add('/', function() {
    header('Location: /home');
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
    $profileController->profile()
);
$route->add('/create', fn()=>
    $postController->create()
);
$route->add('/search', fn()=>
    $searchController->search()
);

// SIDE-NAVE MIDDLE
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
    require __DIR__ . '/../app/views/about-view.php'
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
$route->add('/comment/.+', fn($postId) =>
    $commentController->create($postId)
);

// TODO add routing for error pages?
$route->add('/error', fn()=>
    require __DIR__ . '/../app/views/error-view.php'
);

$route->submit();
?>