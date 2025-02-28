/* tabs.js
--------------------------------------
Allows for tabs at the top of a page like
home or profile to be toggled.
-------------------------------------- */

const tabs = document.querySelectorAll(".tab");
const subpages = document.querySelectorAll(".post-list-container");

tabs.forEach((tab) => {
    tab.addEventListener("click", ()=> {

        for (let i = 0; i < tabs.length; i++) {
            tabs[i].classList.remove("active");
            subpages[i].classList.add("hidden");
        }

        tab.classList.add("active");
        
        const activeSubpage = document.getElementById(tab.value);
        activeSubpage.classList.remove("hidden");
    });
});