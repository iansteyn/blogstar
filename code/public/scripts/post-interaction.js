/* post-interactions.js
--------------------------------------
Performs the following actions:
- Deleting (with confirmation)
- Editing (redirect)
- like/unlike, save/unsave toggling
-------------------------------------- */

// DELETE
const deletePostButtons = document.querySelectorAll(".delete-post-button");

deletePostButtons.forEach((button) => {
    button.addEventListener("click", ()=> deletePost());
});
    
function deletePost(){
  const confirmDelete = confirm("Are you sure you want to delete this post?");
  if (confirmDelete) {
    window.location.href = "profile"; 
  }
}

// EDIT
const editPostButtons = document.querySelectorAll(".edit-post-button");

editPostButtons.forEach((button) => {
    button.addEventListener("click", ()=> editPost());
});

function editPost(){
  window.location.href = "create"; 
}

//LIKE and SAVE
const likeAndSaveButtons = document.querySelectorAll(".togglable-post-button");

likeAndSaveButtons.forEach(button => {
    button.addEventListener("click", ()=> handleButtonClick(button));
});

// This is AJAX!
function handleButtonClick(button) {
    const postId = button.dataset.postId;
    const resource = button.dataset.resource;

    // Send a request to the server
    fetch(`/${resource}/${postId}`, {
        method: 'POST',
    })

    // Recieve response from server
    .then(response => response.json())

    // perform action based on response
    .then(data => {
        if (data.success) {
            toggleButtonVisually(button);
        } else {
            console.error('Like toggle failed:', data.message);
        }
    })

    // catch and log network errors
    .catch(error => {
        console.error('Error:', error);
    });
}

function toggleButtonVisually(button) {
    let otherButton;

    if (button.classList.contains('togglable-post-button-active')) {
        otherButton = button.previousElementSibling;
    }
    else {
        otherButton = button.nextElementSibling;
    }

    button.classList.add('hidden');
    otherButton.classList.remove('hidden');
}
