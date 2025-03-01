/* tabs.js
--------------------------------------
Allows for tabs at the top of a page like
home or profile to be toggled.
-------------------------------------- */

const tabs = document.querySelectorAll(".tab");
const subpages = document.querySelectorAll(".subpage");

tabs.forEach((tab) => {
    tab.addEventListener("click", ()=> showTab(tab));
});

function showTab(tab) {
    for (let i = 0; i < tabs.length; i++) {
        tabs[i].classList.remove("active");
        subpages[i].classList.add("hidden");
    }

    tab.classList.add("active");
    
    const activeSubpage = document.getElementById(tab.value);
    activeSubpage.classList.remove("hidden");
}