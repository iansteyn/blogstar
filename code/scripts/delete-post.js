const submitButton = document.getElementById("submit-post-button");
const discardButton = document.getElementById("discard-post-button");
const createForm = document.getElementById("create-form");

if (submitButton && createForm) {
  createForm.addEventListener("submit", submitPost); 

  if (discardButton) {
    discardButton.addEventListener("click", discardPost);
  }
}

const submitPost = (event) => {
  event.preventDefault(); 
  window.location.href = "profile.php"; 
};

const discardPost = () => {
  const confirmDiscard = confirm("Are you sure you want to discard this post?");
  if (confirmDiscard) {
    window.location.href = "profile.php"; 
  }
};




