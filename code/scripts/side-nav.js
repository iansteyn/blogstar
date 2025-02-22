/* side-nav.js
--------------------------------------
Performs the following dynamic actions:
- highlighting link of current page
- collapsing and expanding the navbar on button press
-------------------------------------- */

document.addEventListener("DOMContentLoaded", () => {

    // HIGHLIGHT NAVLINK OF CURRENT PAGE
    // ---------------------------------
    const navLinks = document.querySelectorAll(".nav-link");

    for (navLink of navLinks) {
        if ((navLink.href  === window.location.href) && (navLink.id != "nav-logo")) {
            navLink.classList.add("current-page");
        }
    }

    // COLLAPSE/EXPAND NAV
    // -------------------
    const navCollapseButton = document.getElementById("nav-collapse-button");

    navCollapseButton.addEventListener("click", () => {
        if(sessionStorage.getItem("navCollapsed")) {
            expandNav();
        }
        else{
            collapseNav();
        }
    });

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
});

// TODO: make the navbar collapse remember its state when you go to a new page
// window.addEventListener("DOMContentLoaded")
