/* side-nav.js
-------------------------------------------------------------------------
Performs the following dynamic actions:
- (temporarily) logout confirmation dialogue
- highlighting link of current page
- collapsing and expanding the navbar on button press
- configuring theme menu and switching theme between default/light/dark
------------------------------------------------------------------------ */

// LOGOUT
// -----------------------
const logoutLink = document.getElementById("logout-link");
logoutLink.addEventListener("click", function(event) {
    event.preventDefault();
    if(confirm("Are you sure you want to log out?")) {
        window.location.href = "/logout";
    }
});

// }}}}}}} 

// HIGHLIGHT NAVLINK OF CURRENT PAGE
// ---------------------------------
const navLinks = document.querySelectorAll(".nav-link");
const currentPage = window.location.href.split("?")[0];
const currentPagePath = new URL(currentPage).pathname;

if (['/home/recent', '/home/popular', '/home/saved'].includes(currentPagePath)) {
    const homeLink = document.querySelectorAll(".nav-link[href='/home']")[1];
    homeLink.classList.add("current-page");
}
else if (['/profile/posts', '/profile/saved', '/profile/settings'].includes(currentPagePath)) {
    const profileLink = document.querySelector(".nav-link[href='/profile']");
    console.log(profileLink);
    profileLink.classList.add("current-page");
}
else if ('/post/create' == currentPagePath) {
    const createLink = document.querySelector(".nav-link[href='/create']");
    createLink.classList.add("current-page");
}
else {
    for (navLink of navLinks) {
        if ((navLink.href  == currentPage) && (navLink.id != "nav-logo")) {
            navLink.classList.add("current-page");
        }
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
// END collapse/expand nav --------------------------------------------------------

// THEME SWITCHING
// ---------------
const themeMenuButton = document.getElementById("theme-menu-button");
const themeSwitcherMenu = document.querySelector(".theme-switcher-menu");
const themeButtons = document.querySelectorAll(".theme-button");
const themeIcons = document.querySelectorAll("#theme-menu-button .icon-inline")

// LOAD stored theme
const storedTheme = localStorage.getItem("theme")
if (storedTheme) {
    loadTheme(storedTheme);
}
document.documentElement.classList.remove("hidden");

// CONFIGURE theme-related buttons
themeButtons.forEach((button) => {
    button.addEventListener("click", (clickEvent)=> {
        clickEvent.stopPropagation(); // stops menu from collapsing on click
        loadTheme(button.value);
    });
});

themeMenuButton.addEventListener("click", (clickEvent)=> {
    if (themeMenuButton.classList.contains("theme-menu-button-active")) {
        deactivateThemeMenu();
    }
    else {
        activateThemeMenu(clickEvent);
    }
});

// HELPERS
function activateThemeMenu(clickEvent) {
    themeMenuButton.classList.add("theme-menu-button-active");
    themeSwitcherMenu.classList.remove("hidden");
    clickEvent.stopPropagation(); // Stops the window onclick event from also immediately firing
    window.addEventListener("click", deactivateThemeMenu); // so user can click anywhere to close menu
}

function deactivateThemeMenu() {
    themeMenuButton.classList.remove("theme-menu-button-active");
    themeSwitcherMenu.classList.add("hidden");
    window.removeEventListener("click", deactivateThemeMenu);
}

function loadTheme(theme) {
    //highlight correct theme button
    for (let i = 0; i < themeButtons.length; i++) {
        themeIcons[i].classList.add("hidden");

        if (themeButtons[i].value == theme) {
            themeButtons[i].classList.add("theme-button-active");
        }
        else {
            themeButtons[i].classList.remove("theme-button-active");
        }
    }

    // set icon on theme-menu-button
    const currentThemeIcon = document.getElementById(`icon-theme-${theme}`);
    currentThemeIcon.classList.remove("hidden");

    // Actually switch theme!
    document.documentElement.setAttribute("data-theme", theme);
    localStorage.setItem("theme", theme);
    setFavicon(theme);
}

//switch favicon
function setFavicon(theme) {
    const faviconLink = document.querySelector('[rel="icon"]');

    if (faviconLink) {
        let faviconTheme;

        // console.log(window.matchMedia('(prefers-color-scheme: no-preference').matches);
    
        if (theme == 'default' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            faviconTheme = 'dark';
        }
        else if (theme == 'default') {
            faviconTheme = 'light';
        }
        else {
            faviconTheme = theme;
        }

        faviconLink.setAttribute('href', `/vector-icons/favicon-${faviconTheme}.svg`)
    }
}

// END theme switching -------------------------------------------------------------