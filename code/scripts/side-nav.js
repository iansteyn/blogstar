/* side-nav.js
--------------------------------------
Performs the following dynamic actions:
- highlighting link of current page
- collapsing and expanding the navbar on button press
-------------------------------------- */

// TEMPORARY {{{{{{{
// LOGOUT STUFF
// -----------------------
const logoutLink = document.getElementById("logout-link");
logoutLink.addEventListener("click", ()=> logout());

function logout() {
    if(confirm("Are you sure you want to log out?")) {
        window.location.href = "login.php";
    }
}

// }}}}}}} 

// HIGHLIGHT NAVLINK OF CURRENT PAGE
// ---------------------------------
const navLinks = document.querySelectorAll(".nav-link");
const currentPage = window.location.href.split("?")[0];

for (navLink of navLinks) {
    if ((navLink.href  === currentPage) && (navLink.id != "nav-logo")) {
        navLink.classList.add("current-page");
    }
}

// COLLAPSE/EXPAND NAV
// -------------------
const navCollapseButton = document.getElementById("nav-collapse-button");

// SET CORRECT COLLAPSE STATE
// (maintains same state as previous page)
if(sessionStorage.getItem("navCollapsed")) {
    collapseNav();
}
else{
    expandNav();
}

// CONFIGURE BUTTON
navCollapseButton.addEventListener("click", () => {
    if(sessionStorage.getItem("navCollapsed")) {
        expandNav();
    }
    else{
        collapseNav();
    }
});

// HELPER FUNCTIONS
function collapseNav() {
    for (navLink of navLinks) {
        navLink.classList.add("collapsed");
    }
    navCollapseButton.textContent = ">";
    navCollapseButton.title = "Expand Navigation";
    sessionStorage.setItem("navCollapsed", "true");
}

function expandNav() {
    for (navLink of navLinks) {
        navLink.classList.remove("collapsed");
    }
    navCollapseButton.textContent = "<";
    navCollapseButton.title = "Collapse Navigation";
    sessionStorage.removeItem("navCollapsed");
}
// ---------------------------------------------------------

// TOGGLE THEME MENU
// ------------------
const themeMenuButton = document.getElementById("theme-menu-button");
const themeSwitcherMenu = document.querySelector(".theme-switcher-menu");

themeMenuButton.addEventListener("click", ()=> {
    // if (themeMenuButton.classList.contains("active")) {
    //     deactivateThemeMenu();
    // }
    // else {
    //     activateThemeMenu();
    // }

    themeSwitcherMenu.classList.toggle("hidden");
});

// function activateThemeMenu() {

// }
// function deactivateThemeMenu() {

// }

