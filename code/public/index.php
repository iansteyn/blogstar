<?php
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
$pageController = new PagesController($db);
$userController = new UserController($db);
$postController = new PostController($db);

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
    require __DIR__ . '/../app/views/profile-view.php'
);
$route->add('/create', fn()=>
    require __DIR__ . '/../app/views/create-view.php'
);
$route->add('/search', fn()=>
    require __DIR__ . '/../app/views/search-view.php'
);

// SIDE-NAVE MIDDLE
$route->add('/admin', fn()=>
    require __DIR__ . '/../app/views/admin-view.php'
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

// TODO add routing for error pages?

$route->submit();
?>