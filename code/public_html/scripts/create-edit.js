/* create-edit.js
--------------------------------------
Performs the following actions:
- deleting of a postthats currently being written
- "submitting" the post which is a redirect back to profile
-------------------------------------- */

const discardButton = document.getElementById("discard-button");

discardButton.addEventListener("click", discardPost);

function discardPost() {
    const confirmDiscard = confirm("Are you sure you want to discard your work?");
    if (confirmDiscard) {
        window.location.href = `${BASE_URL}?route=/profile`; 
    }
};