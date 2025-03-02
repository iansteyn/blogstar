/* tabs.js
--------------------------------------
Allows for tabs at the top of a page like
home or profile to be toggled.
-------------------------------------- */

const tabs = document.querySelectorAll(".tab");
const subpages = document.querySelectorAll(".subpage");

const currentURL = new URL(window.location.href)
const currentTabValue = currentURL.searchParams.get("tab");

tabs.forEach((tab) => {
    if (tab.value == currentTabValue) {
        showTab(tab);
    }
    tab.addEventListener("click", ()=> showTab(tab));
});

function showTab(tab) {
    // hide all tabs
    for (let i = 0; i < tabs.length; i++) {
        tabs[i].classList.remove("active");
        subpages[i].classList.add("hidden");
    }

    // show active tab
    tab.classList.add("active");
    const activeSubpage = document.getElementById(tab.value);
    activeSubpage.classList.remove("hidden");

    // update page URL
    newURL = new URL(window.location.href);
    newURL.searchParams.set("tab", tab.value);
    window.history.replaceState({}, "", newURL);
}