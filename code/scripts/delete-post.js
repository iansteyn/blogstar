const deletePostButton = document.getElementById("delete-post-button");
deletePostButton.addEventListener("click", ()=> deletePost());
    
const deleteCommentButton = document.getElementById("delete-comment-button");
deleteCommentButton.addEventListener("click", ()=> deleteComment());

const discardCommentButton = document.getElementById("discard-comment-button");
discardCommentButton.addEventListener("click", ()=> discardComment());

function deletePost(){
    confirm("Are you sure you want to delete this post?");
}

function deleteComment(){
    confirm("Are you sure you want to delete this comment?");
}

function discardComment(){
    confirm("Are you sure you want to discard this comment?");
}