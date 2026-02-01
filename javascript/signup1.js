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
   event.preventDefault();
    userError.textContent = "";
    emailError.textContent = "";
    passError.textContent = "";
    confirmError.textContent = "";

    let valid = true;

  if (username.value.trim() === "") {
      userError.textContent = "Shkruaj username";
      valid = false;
    }else  if (!usernameRegex.test(username.value.trim())) {
      userError.textContent = " Username duhet të ketë 4+ karaktere dhe vetëm shkronja/numra.";
      valid = false;
    }


  if (email.value.trim() === "") {
      emailError.textContent = "Shkruaj email";
      valid = false;
    } else if (!emailRegex.test(email.value.trim())) {
      emailError.textContent = "Formati i email-it është i pavlefshëm.";
      valid = false;
    }

     if (password.value === "") {
      passError.textContent = "Shkruaj password";
      valid = false;
    } else if (!passwordRegex.test(password.value)) {
      passError.textContent =
        "Password duhet të ketë 6+ karaktere, një shkronjë të madhe, një të vogël dhe një numër.";
      valid = false;
    }


   if (confirm.value === "") {
      confirmError.textContent = "Shkruaj confirm password";
      valid = false;
    }else if (password.value !== confirm.value) {
      confirmError.textContent = "Passwordet nuk përputhen.";
      valid = false;
    }
     if (valid) {
      form.submit(); 
    }
  });

  // menu
  const menu = document.getElementById("menu");
  const navLinks = document.getElementById("navLinks");

  if (menu && navLinks) {
    menu.addEventListener("click", () => {
      navLinks.classList.toggle("show");
      menu.classList.toggle("open");
    });
  }

});
