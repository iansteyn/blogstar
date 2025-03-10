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
    window.location.href = "profile.php"; 
  }
}

// EDIT
const editPostButtons = document.querySelectorAll(".edit-post-button");

editPostButtons.forEach((button) => {
    button.addEventListener("click", ()=> editPost());
});

function editPost(){
  window.location.href = "create.php"; 
}

//LIKE and SAVE
const likeAndSaveButtons = document.querySelectorAll(".togglable-post-button");

likeAndSaveButtons.forEach(button => {
    button.addEventListener("click", ()=> toggleButton(button));
});

function toggleButton(button) {
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

// const likeButton = document.getElementById('like-button');
// const unlikeButton = document.getElementById('unlike-button');

// unlikeButton.addEventListener('click', () => {
//   unlikeButton.style.display = 'none';
//   likeButton.style.display = 'inline-block';
// });

// likeButton.addEventListener('click', () => {
//   likeButton.style.display = 'none';
//   unlikeButton.style.display = 'inline-block';
// });

// const saveButton = document.getElementById('save-post-button');
// const unsaveButton = document.getElementById('unsave-post-button');

// unsaveButton.addEventListener('click', () => {
//   unsaveButton.style.display = 'none';
//   saveButton.style.display = 'inline-block';
// });

// saveButton.addEventListener('click', () => {
//   saveButton.style.display = 'none';
//   unsaveButton.style.display = 'inline-block';
// });
