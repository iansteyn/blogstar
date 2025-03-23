<?php
session_start();
/* index.php
------------
This is the website's "root".
Here, we set-up URL routing, so that all of our pages can be viewed without needing the whole URL.
*/

include __DIR__.'/../db_config/db_connect.php';
$db = getDatabaseConnection();

include __DIR__.'/../app/controllers/PagesController.php';
include __DIR__.'/../app/controllers/UserController.php';
include __DIR__.'/../app/controllers/PostController.php';
include __DIR__.'/../app/controllers/CommentController.php';
include __DIR__.'/../app/controllers/AdminController.php';
$pageController = new PagesController($db);
$userController = new UserController($db);
$postController = new PostController($db);
$commentController = new commentController($db);
$adminController = new AdminController($db);

include __DIR__.'/../app/routing/route.php';
$route = new Route();

// SIDE-NAV TOP
$route->add('/', function() {
    header('Location: /home');
    exit;
});
$route->add('/home', fn()=>
    $pageController->home()
);
$route->add('/profile', fn()=>
    $userController->profile()
);
$route->add('/create', fn()=>
    $postController->create()
);
$route->add('/search', fn()=>
    require __DIR__ . '/../app/views/search-view.php'
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
$route->add('/comment/create', fn() =>
    $commentController->create()
);

// TODO add routing for error pages?
$route->add('/error', fn()=>
    require __DIR__ . '/../app/views/error-view.php'
);

$route->submit();
?>