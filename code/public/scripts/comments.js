/* comments.js
--------------------------------------
Performs the following actions:
- deleting a comment thats been written
- "submitting" a written comment
- discarding a comment that you're in the process of writing
-- confirmation pop up on deleting comment
- confirmation pop up on discarding comment
-------------------------------------- */

const deleteCommentButton = document.getElementById("delete-comment-button");
deleteCommentButton.addEventListener("click", ()=> deleteComment());

const discardCommentButton = document.getElementById("discard-comment-button");
discardCommentButton.addEventListener("click", ()=> discardComment());

function deleteComment(){
  confirm("Are you sure you want to delete this comment?");
}

function discardComment(){
  const confirmDiscard = confirm("Are you sure you want to discard this comment?");
  if (confirmDiscard) {
    window.location.href = "specific-post"; 
  }
}