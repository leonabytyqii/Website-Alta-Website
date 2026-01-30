document.addEventListener("DOMContentLoaded", function () {

  const form = document.getElementById("signupForm");
  const username = document.getElementById("username");
  const email = document.getElementById("email");
  const password = document.getElementById("password");
  const confirm = document.getElementById("confirm");

  const userError = document.getElementById("userError");
  const emailError = document.getElementById("emailError");
  const passError = document.getElementById("passError");
  const confirmError = document.getElementById("confirmError");

  const usernameRegex = /^[a-zA-Z0-9]{4,}$/;
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
  const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/;

  form.addEventListener("submit", function (event) {

    userError.textContent = "";
    emailError.textContent = "";
    passError.textContent = "";
    confirmError.textContent = "";

    let valid = true;

    if (!usernameRegex.test(username.value.trim())) {
      userError.textContent = "Username must be 4+ characters.";
      valid = false;
    }

    if (!emailRegex.test(email.value.trim())) {
      emailError.textContent = "Invalid email format.";
      valid = false;
    }

    if (!passwordRegex.test(password.value)) {
      passError.textContent =
        "Password must contain 6+ characters uppercase, lowercase and number.";
      valid = false;
    }

    if (password.value !== confirm.value) {
      confirmError.textContent = "Passwords do not match.";
      valid = false;
    }

    if (!valid) {
      event.preventDefault();
    }
  });

  // MENU HAMBURGER
  const menu = document.getElementById("menu");
  const navLinks = document.getElementById("navLinks");

  if (menu && navLinks) {
    menu.addEventListener("click", () => {
      navLinks.classList.toggle("show");
      menu.classList.toggle("open");
    });
  }

});
