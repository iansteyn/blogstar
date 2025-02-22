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
    // const navCollapseButton = document.getElementById("nav-collapse-button");

    // navCollapseButton.addEventListener("onClick", () => {
    //     console.log('button clicked');
    //     // get all links
    //     for (navLink of navLinks) {
            
    //     }
    //     // toggle hide text from links (might have to surround them all in spans for this)
    //     // toggle class: change collapse logo size
    //     // toggle class: remove padding extra right padding from icons?
    //     // swap arrow direction of button content
    // });
});