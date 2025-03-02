const discardButton = document.getElementById("discard-post-button");
const createForm = document.getElementById("create-form");

createForm.addEventListener("submit", submitPost); 
discardButton.addEventListener("click", discardPost);

// Helpers
function submitPost(event) {
    event.preventDefault(); 
    window.location.href = "profile.php"; 
};

function discardPost() {
    const confirmDiscard = confirm("Are you sure you want to discard this post?");
    if (confirmDiscard) {
        window.location.href = "profile.php"; 
    }
};



