const deletePostButton = document.getElementById("delete-post-button");
deletePostButton.addEventListener("click", ()=> deletePost());
    
function deletePost(){
    const confirmDelete = confirm("Are you sure you want to delete this post?");
  if (confirmDelete) {
    window.location.href = "profile.php"; 
  }
}
