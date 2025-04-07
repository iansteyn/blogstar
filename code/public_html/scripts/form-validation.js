/* form-validation.js
--------------------------------------
Performs client-side validation for the login 
and registration forms on submit
- inputs are highlighted in red if there is an error
- error messages are provided below input fields with issues
-------------------------------------- */

// EVENT HANDLING FOR FORMS
const loginForm = document.querySelector("#login-form");
const registerForm = document.querySelector("#registration-form");
const forms = [loginForm, registerForm].filter(Boolean);

forms.forEach((form) => {
    form.addEventListener("submit", (e) => validateForm(e, form));
    form.addEventListener("input", (e) => removeError(e.target));
})


// FORM VALIDITY CHECKING FUNCTION
function validateForm(event, form) {
    clearErrors(form);
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

    if (form.id === "registration-form") {
        const username = form.querySelector("#username");
        const confirmPassword = form.querySelector("#confirm-password");
        const profilePicture = form.querySelector("#profile-picture");

        if (!validateUsername(username.value)) {
            displayError(username, "Username must be 5-20 characters and only " +
                "contain letters, numbers, and underscores");
            isValid = false;
        }

        if (!validatePassword(password.value)) {
            displayError(password, "Password must be at least 8 characters and include " +
                "an uppercase and lowercase letter, a number, and a special character");
                isValid = false;
        }

        if (confirmPassword.value == null || confirmPassword.value == "") {
            displayError(confirmPassword, "Password cannot be empty");
            isValid = false;
        } else if (confirmPassword.value !== password.value) {
            displayError(confirmPassword, "Passwords must match");
            isValid = false;
        }

        if (profilePicture.files.length == null || profilePicture.files.length == 0) {
            displayError(profilePicture, "Profile picture cannot be empty");
            isValid = false;
        } else if (profilePicture.files.length > 0 && !validateProfilePicture(profilePicture.files[0])) {
            displayError(profilePicture, "Profile picture must be a jpg, png, or gif less than 5 MB");
            isValid = false;
        }
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
username must be 5-20 characters and can contain
upper and lowercase letters, numbers, and underscores
*/
function validateUsername(username) {
    const usernamePattern = /^[a-zA-Z0-9_]{5,20}$/;
    return usernamePattern.test(username);
}

/*
regex pattern from:
https://stackoverflow.com/a/21456918
source for special character list:
https://owasp.org/www-community/password-special-characters
password must have:
- at least one lowercase letter: (?=.*[a-z])
- at least one uppercase letter: (?=.*[A-Z])
- at least one number: (?=.*\d)
- at least one special character: (?=.*[!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~\\])
- and be at least 8 characters: {8,}
    - pattern for remaining characters: [A-Za-z\d!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~\\]
*/
function validatePassword(password) {
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~\\])[A-Za-z\d!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~\\]{8,}$/;
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
    div.style.color = "var(--color-error)";
    div.style.maxWidth = "42ch";
    input.parentElement.appendChild(div);
    input.classList.add("validation-error");
}

function removeError(input) {
    const error = input.parentElement.querySelector(".error-message");
    if (error) {
        error.remove();
        input.classList.remove("validation-error");
    }
}

function clearErrors(form) {
    const errorMessages = form.querySelectorAll(".error-message");
    const validationError = form.querySelectorAll(".validation-error");
    errorMessages.forEach((message) => message.remove());
    validationError.forEach((input) => input.classList.remove("validation-error"));
}
