/* comments.js
--------------------------------------
Performs the following actions:
- deleting a comment thats been written
- "submitting" a written comment
- discarding a comment that you're in the process of writing
-- confirmation pop up on deleting comment
- confirmation pop up on discarding comment
-------------------------------------- */

const deleteCommentButtons = document.querySelectorAll(".delete-comment-button");
deleteCommentButtons.forEach(button => {
    button.addEventListener("click", (event) => deleteComment(event));
});

const discardCommentButton = document.getElementById("discard-comment-button");
if (discardCommentButton) {
    discardCommentButton.addEventListener("click", () => discardComment());
}

function deleteComment(event) {
    event.preventDefault();
    const confirmDelete = confirm("Are you sure you want to delete this comment?");
    if (confirmDelete) {
        event.target.closest("form").submit();
    }
}

function discardComment() {
  const confirmDiscard = confirm("Are you sure you want to discard this comment?");
  if (confirmDiscard) {
      document.getElementById("comment").value = "";
  }
}