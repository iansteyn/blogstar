<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <title>
    Create Blog Post
  </title>

  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/side-nav.css">
</head>

<body>
  <header>
    <?php include "../html/side-nav.html" ?>
  </header>
  <main>
    <div class = "page-container">
      <h1>Create your post<h1>
      <article class = "blog-container">
      <form action="/specific-post.php">
        <textarea class = "blog-title">Write your title here!</textarea>
        <br>
        <textarea class = "blog-text">Write your post here!</textarea>
        <input type="submit" value="Post">
        <input type="submit" value="Discard">
      </form>
      </article>
    </div>
  </main>
</body>

</html>