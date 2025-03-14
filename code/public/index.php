<?php
/* index.php
------------
This is the website's "root".
Here, we set-up URL routing, so that all of our pages can be viewed without needing the whole URL.
*/

include __DIR__."/../app/routing/route.php";
include __DIR__."/../app/controllers/PagesController.php";

$route = new Route();
$pageController = new PagesController();

// SIDE-NAV TOP
$route->add('/', function() {
    header('Location: /home');
    exit;
});
$route->add('/home', fn()=>
    $pageController->home()
);
$route->add('/profile', fn()=>
    require __DIR__ . '/../app/views/profile.php'
);
$route->add('/create', fn()=>
    require __DIR__ . '/../app/views/create.php'
);
$route->add('/search', fn()=>
    require __DIR__ . '/../app/views/search.php'
);

// SIDE-NAVE MIDDLE
$route->add('/admin', fn()=>
    require __DIR__ . '/../app/views/admin.php'
);

// SIDE_NAV BOTTOM
$route->add('/login', fn()=>
    require __DIR__ . '/../app/views/login.php'
);
$route->add('/register', fn()=>
    require __DIR__ . '/../app/views/register.php'
);
$route->add('/about', fn()=>
    require __DIR__ . '/../app/views/about.php'
);

// OTHER
$route->add('/specific-post', fn()=>
    require __DIR__ . '/../app/views/specific-post.php'
);

// TODO add routing for error pages?

$route->submit();
?>