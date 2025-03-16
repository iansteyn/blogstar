/* create-edit.js
--------------------------------------
Performs the following actions:
- deleting of a postthats currently being written
- "submitting" the post which is a redirect back to profile
-------------------------------------- */

const discardButton = document.getElementById("discard-post-button");
const createForm = document.getElementById("create-form");

createForm.addEventListener("submit", submitPost); 
discardButton.addEventListener("click", discardPost);

// Helpers
function submitPost(event) {
    event.preventDefault(); 
    window.location.href = "profile"; 
};

function discardPost() {
    const confirmDiscard = confirm("Are you sure you want to discard this post?");
    if (confirmDiscard) {
        window.location.href = "profile"; 
    }
};