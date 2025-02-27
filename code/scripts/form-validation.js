/* form-validation.js
--------------------------------------
Performs client-side validation for the login 
and registration forms on submit
- inputs are highlighted in red if there is an error
- error messages are provided below input fields with issues
-------------------------------------- */

// EVENT HANDLER FOR FORM TYPE
document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.querySelector("#login-form");
    const registerForm = document.querySelector("#registration-form");

    if (loginForm) {
        loginForm.addEventListener("submit", (e) => {
            validateForm(e, loginForm);
        });
    }

    if (registerForm) {
        registerForm.addEventListener("submit", (e) => {
            validateForm(e, registerForm);
        });
    }
});

// 
function validateForm(event, form) {
    let isValid = true;
    const email = form.querySelector("#email");
    const password = form.querySelector("#password");

    if (email.value == null || email.value == "") {
        displayError(email, "Email cannot be empty");
        isValid = false;
    } else if (!validateEmail(email.value)) {
        displayError(email, "Please enter a valid email");
        isValid = false;
    }

    if (password.value == null || password.value == "") {
        displayError(password, "Password cannot be empty");
        isValid = false;
    }


    if (!isValid) {
        event.preventDefault();
    }
}

// HELPER FUNCTIONS

/*
regex pattern from:
https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/email#basic_validation
*/
function validateEmail(email) {
    const emailPattern = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    return emailPattern.test(email);
}

/*
user id must be 5-20 characters and can contain
upper and lowercase letters, numbers, and underscores
*/
function validateUserId(userId) {
    const userIdPattern = /^[a-zA-Z0-9_]{5,20}$/;
    return userIdPattern.test(userId);
}

/*
regex pattern from:
https://stackoverflow.com/a/21456918
password must have:
- at least one lowercase letter: (?=.*[a-z])
- at least one uppercase letter: (?=.*[A-Z])
- at least one number: (?=.*\d)
- at least one special character: (?=.*[@$!%*?&])
- and be at least 8 characters: {8,}
    - pattern for remaining characters: [A-Za-z\d@$!%*?&]
*/
function validatePassword(password) {
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return passwordPattern.test(password);
}

/*
profile picture uploads are limited to image file types under 5 MB
*/
function validateProfilePicture(file) {
    const imageTypes = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
    const maxFileSize = 5 * 1024 * 1024;
    return imageTypes.includes(file.type) && file.size <= maxFileSize;
}

function displayError(input, message) {
    const div = document.createElement("div");
    div.textContent = message;
    div.className = "error-message";
    div.style.color = "red";
    div.style.maxWidth = "40ch";
    input.parentElement.appendChild(div);
    input.classList.add("validation-error");
}
