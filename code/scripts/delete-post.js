const deleteButton = document.getElementById("delete-post-button");
deleteButton.addEventListener("click", ()=> deletePost());

const discardPost = document.getElementById("discard-button");
discardPost.addEventListener("click", ()=> discardPost());
 
document.getElementById("create-form").addEventListener("click", function(event) {
    event.preventDefault();
    confirm("Are you sure you want to discard this post?");
});

function deletePost(){
    confirm("Are you sure you want to delete this post?");
}