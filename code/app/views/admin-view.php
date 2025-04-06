<?php
/**
 * This view expects the following variables:
 * @var bool $isAdmin
 * @var bool $isLoggedIn
 * @var string $searchValue
 * @var array $usernames
 * @var bool $showResultMessage
 * @var int $total_posts
 * @var int $posts_last_week
 * @var int $posts_today
 * @var int $total_users
 * @var int $registered_past_week
 * @var int $registered_today
*/
require_once __DIR__."/../helpers/view-helpers.php";

$usernames = sanitizeData($usernames);

echo generateDocumentHead(
    'Admin Dashboard',
    ['search.css', 'admin.css'],
    ['admin.js']
);
?>

<body>
  <header>
    <?php
        // This component uses: $isAdmin, $isLoggedIn
        include __DIR__."/components/side-nav-component.php"
    ?>
  </header>
  <main>
    <header class="page-header">
      <h1>Admin Dashboard</h1>
    </header>
    <article class="dashboard-grid">
      <section class="panel user-search" id="user-search">
        <h2>User List</h2>
        <div class="action-bar">
            <?php
                $searchAction = '/admin';
                $isRequired = false;
                // this component uses: $searchAction, $isRequired, $searchValue
                include __DIR__."/components/search-bar-component.php";
            ?>
        </div>

        <?php if($showResultMessage): ?>
        <div class='search-message result-message'>
          <h4>
            <?php
                if ($searchValue == '') {
                    echo 'Showing all users';
                } else if (empty($usernames)) {
                    echo "No results for: \"$searchValue\"";
                } else {
                    echo "Showing results for: \"$searchValue\"";
                }
            ?>
          </h4>
          <a class='clear-link' href='/admin'>
            Clear
          </a>
        </div>
        <?php endif; ?>

        <ul class="user-list">
          <?php foreach($usernames as $username): ?>
            <li>
              <a href="/profile/posts/<?= $username ?>/">
                <i>@<?= $username ?></i>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </section>
      <section class="panel site-analytics" id="site-analytics">
        <h2>Site Analytics</h2>
        <div class="widget-container">
          <div class="panel analytics-widget">
            <h3>User Accounts</h3>
            <ul>
              <li><span><?= $total_users ?></span><p>Total users</p></li>
              <li><span><?= $registered_past_week ?></span><p>Accounts created this week</p></li>
              <li><span><?= $registered_today ?></span><p>Accounts created today</p></li>
            </ul>
          </div>
          <div class="panel analytics-widget">
            <h3>Blog Posts</h3>
            <ul>
              <li><span><?= $total_posts ?></span><p>Total posts</p></li>
              <li><span><?= $posts_last_week ?></span><p>Posts created this week</p></li>
              <li><span><?= $posts_today ?></span><p>Posts created today</p></li>
            </ul>
          </div>
        </div>
      </section>
    </article>
  </main>
</body>

</html>
