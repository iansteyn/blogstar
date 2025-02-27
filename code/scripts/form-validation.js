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

