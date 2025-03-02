<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <title>
    About | Our Site
  </title>

  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/side-nav.css">

  <style>
    .normal-list {
      list-style: inside;
      margin: 1em 0;
      line-height: 1.2em;
    }
    h2 {
      margin-bottom: 1rem;
    }
  </style>

  <script src="../scripts/side-nav.js" defer></script>
</head>

<body>
  <header>
    <?php include "../html/side-nav.html" ?>
  </header>
  <main>
    <header class="page-header">
      <h1>About</h1>
    </header>
    <article class="panel">
      <!-- about this website -->
      <section>
        <h2>Welcome to Our Site!</h2>
        <p>
          Our site is a personal blogging website, where you can create and read longform text posts. There's lots of different ways to find posts: search by keyword, and check out what's popular, and save your favorites! You can also engage with other bloggers by browsing their profiles and commenting on their posts.
        </p>
        <p>
          This site was created as a term project for COSC 360 - Web Programming. We have learned a great deal in the process, and are very proud of what we have built.
        </p>
        <p>
          <i>—The devs.</i>
        </p>
      </section>
      <section>
        <h2>Development Information</h2>
        <h3>The Team</h3>
        <ul class="normal-list">
          <li><a href="https://github.com/JoyMusiel" target="_blank">Joy Musiel-Henseleit</a></li>
          <li><a href="https://github.com/SammieScully" target="_blank">Sammie Scully</a></li>
          <li><a href="https://github.com/iansteyn" target="_blank">Ian Steyn</a></li>
        </ul>
        <h3>Code</h3>
        <p>
          You can find the source code for this website at <a href="https://github.com/iansteyn/cosc-360-project" target="_blank">our GitHub repository</a>.
        </p>
        <p>
          We used no front-end frameworks. It's pure HTML/CSS/JS, hand-crafted!
        </p>
        <h3>Attribution</h3>
        <p>
          <!-- TODO -->
        </p>
      </section>
        <!-- <h3>Do I have to register an account?</h3>
        <p>
          You can browse posts without having an account, but you must register and log in to create your own posts and view the profiles of other users. Your personal information is kept secure, and we do not share it with anyone.
        </p> -->
      <!-- the team -->
      <!-- github -->
      <!-- attribution -->
    </article>
  </main>
</body>

</html>