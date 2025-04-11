/* image-size-limit.js
-----------------------
This is a last-minute addition
It simply ensures that uploaded images cannot be more than 2 MB,
since this is the max_allowed_packet for the remote server.
*/
const MAX_FILE_SIZE = 2 * 1000 * 1000; // 2MB

const forms = Array.from(document.querySelectorAll('form'));
const formWithFileInput = forms.filter(form => form.querySelector('input[type="file"]'))[0]; //there should only be one per page in the current site implementation
const fileInput = formWithFileInput.querySelector('input[type="file"]');

formWithFileInput.addEventListener ('submit', (submitEvent)=> {
    if (fileInput.files[0].size > MAX_FILE_SIZE) {
        submitEvent.preventDefault();
        displayError(fileInput, "File must be less than 2MB.");
    }
});

fileInput.addEventListener('input', (inputEvent)=> {
    removeError(fileInput);
});

// HELPERS
// (copied from form-validation.js)
function displayError(input, message) {
    const div = document.createElement("div");
    div.textContent = message;
    div.className = "error-message";
    div.style.color = "var(--color-error)";
    div.style.maxWidth = "42ch";
    input.parentElement.appendChild(div);
    input.classList.add("validation-error");
}

function removeError(input) {
    const errors = input.parentElement.querySelectorAll(".error-message");
    errors.forEach((error) => error.remove());
    input.classList.remove("validation-error");
}

