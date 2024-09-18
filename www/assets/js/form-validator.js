document.addEventListener("DOMContentLoaded", function () {
  const registerForm = document.getElementById("form-register");
  const loginForm = document.getElementById("form-login");

  function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
  }

  function validatePassword(password) {
    return password.length >= 8;
  }

  function showError(form, message) {
    const errorDiv = form.querySelector(".error");
    if (errorDiv) {
      errorDiv.innerText = message;
    } else {
      const error = document.createElement("div");
      error.className = "error";
      error.innerText = message;
      form.prepend(error);
    }
  }

  if (registerForm) {
    registerForm.addEventListener("submit", function (event) {
      event.preventDefault();

      const email = registerForm.querySelector("#form-register-email").value;
      const password = registerForm.querySelector(
        "#form-register-password"
      ).value;
      const confirmPassword = registerForm.querySelector(
        "#form-register-password-confirm"
      ).value;

      if (!validateEmail(email)) {
        showError(registerForm, "Invalid email format");
        return;
      }

      if (!validatePassword(password)) {
        showError(registerForm, "Password must be at least 8 characters");
        return;
      }

      if (password !== confirmPassword) {
        showError(registerForm, "Passwords do not match");
        return;
      }

      registerForm.submit();
    });
  }

  if (loginForm) {
    loginForm.addEventListener("submit", function (event) {
      event.preventDefault();

      const email = loginForm.querySelector("#email").value;
      const password = loginForm.querySelector("#password").value;

      if (!validateEmail(email)) {
        showError(loginForm, "Invalid email format");
        return;
      }

      if (!validatePassword(password)) {
        showError(loginForm, "Password must be at least 8 characters");
        return;
      }

      loginForm.submit();
    });
  }
});
