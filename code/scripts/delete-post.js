const deleteButton = document.getElementById("delete-post-button");

deleteButton.addEventListener("click", ()=> deletePost());
    
function deletePost(){
    confirm("Are you sure you want to delete this post?");
}
