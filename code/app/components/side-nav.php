<!-- side-nav.html
==================
Main navigation component. Include it in a <header> tag at the start of the body.
-->

<nav id="side-nav">

  <div id="logo-container">
    <a id="nav-logo" class="nav-link" href="home">
      <svg class="icon-logo" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-logo"></use></svg>
      <span class="nav-link-text logo-text">OUR SITE</span>
    </a>
  </div>

  <div id="top-links">
    <a class="nav-link" href="home">
      <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-home"></use></svg>
      <span class="nav-link-text">Home</span>
    </a>
    <a class="nav-link" href="profile"> <!-- TODO: remove no-access example once its dynamic -->
      <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-profile"></use></svg>
      <span class="nav-link-text">Profile</span>
    </a>
    <a class="nav-link" href="create">
      <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-create"></use></svg>
      <span class="nav-link-text">Create</span>
    </a>
    <a class="nav-link" href="search">
      <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-search"></use></svg>
      <span class="nav-link-text">Search</span>
    </a>
  </div>

  <div id="middle-links">
    <a class="nav-link" href="admin">
      <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-admin"></use></svg>
      <span class="nav-link-text">Admin</span>
    </a>
  </div>

  <div id="bottom-links">
    <a class="nav-link" href="login">
      <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-login"></use></svg>
      <span class="nav-link-text">Login</span>
    </a>
    <a class="nav-link" href="register">
      <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-register"></use></svg>
      <span class="nav-link-text">Register</span>
    </a>
    <a class="nav-link" href="#" id="logout-link">
      <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-logout"></use></svg>
      <span class="nav-link-text">Logout</span>
    </a>
    <a class="nav-link" href="about">
      <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-about"></use></svg>
      <span class="nav-link-text">About</span>
    </a>
  </div>

  <div class="nav-buttons">
    <div class="theme-switcher-container">
      <button id="theme-menu-button" class="button-nav" title="Switch theme">
        <svg id="icon-theme-default" class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-theme-default"></use></svg>
        <svg id="icon-theme-light" class="icon-inline hidden" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-theme-light"></use></svg>
        <svg id="icon-theme-dark" class="icon-inline hidden" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-theme-dark"></use></svg>
      </button>
      <div class="theme-switcher-menu hidden">
        <button class="theme-button theme-button-active" value="default">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-theme-default"></use></svg>
          <span class="theme-button-text">Default</span>
        </button>
        <button class="theme-button" value="light">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-theme-light"></use></svg>
          <span class="theme-button-text">Light</span>
        </button>
        <button class="theme-button" value="dark">
          <svg class="icon-inline" preserveAspectRatio="xMidYMid meet"><use href="../vector-icons/icons.svg#icon-theme-dark"></use></svg>
          <span class="theme-button-text">Dark</span>
        </button>
      </div>
    </div>

    <button id="nav-collapse-button" class="button-nav" title="Collapse Navigation"><</button>
  </div>

</nav>





