/* side-nav.js
--------------------------------------
Performs the following dynamic actions:
- highlighting link of current page
- collapsing and expanding the navbar on button press
-------------------------------------- */

document.addEventListener("DOMContentLoaded", () => {

    const navLinks = document.querySelectorAll(".nav-link");

    for (navLink of navLinks) {
        if (navLink.href  === window.location.href
            && navLink.id != "nav-logo")
        {
            navLink.classList.add("current-page");
        }
        else if (navLink.classList.contains("current-page")) {
            navLink.classList.remove("current-page");
        }
    }
});