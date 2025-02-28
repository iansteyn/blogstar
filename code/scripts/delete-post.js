const deleteButton = document.getElementById("delete-post-button");
deleteButton.addEventListener("click", ()=> deletePost());

function deletePost(){
  confirm("Are you sure you want to delete this post?");
}

/*--------------------------------------------------------------------------------------------------*/ 
const discardPost = document.getElementById("discard-post-button");
discardPost.addEventListener("click", ()=> discardPost());

function discardPost() {
    if(confirm("Are you sure you want to discard this post?")) {
        window.location.href = "profile.php";
    }
}


