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

        for (navLink of navLinks) {
            navLink.classList.toggle("collapsed");
        }

        // swap arrow direction and change tooltip
        if (navCollapseButton.textContent === "<") {
            navCollapseButton.textContent = ">";
            navCollapseButton.title = "Expand Navigation";
        }
        else {
            navCollapseButton.textContent = "<";
            navCollapseButton.title = "Collapse Navigation";
        }
    });
});
