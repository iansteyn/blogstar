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
  <link rel="stylesheet" href="../css/create.css">
</head>

<body>
  <header>
    <?php include "../html/side-nav.html" ?>
  </header>
  <main>
    <h1 class = "page-title">Create your post<h1>
    <div class = "panel">
      <form action="../pages/create.php">
        <textarea class = "blog-title" placeholder = "Write your title here!"></textarea>
        <br>
        <textarea class = "blog-text" placeholder = "Write your title here!"></textarea>
        <div class="form-group">
          <label for="blog-photo">Upload a photo</label>
          <input type="file" id="blog-photo" name="blog-photo"/>
        </div>
        <input type="submit" value="Post">
        <input type="submit" value="Discard">
      </form>
    </div>
  </main>
</body>

</html>