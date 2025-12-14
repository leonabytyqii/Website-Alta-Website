const btn = document.querySelector(".btn");

btn.addEventListener("click", function (event) {
  event.preventDefault();

  const fullname = document.getElementById("fullname");
  const username = document.getElementById("username");
  const email = document.getElementById("email");
  const password = document.getElementById("password");
  const confirm = document.getElementById("confirm");

  const fullError = document.getElementById("fullError");
  const userError = document.getElementById("userError");
  const emailError = document.getElementById("emailError");
  const passError = document.getElementById("passError");
  const confirmError = document.getElementById("confirmError");

  fullError.textContent = "";
  userError.textContent = "";
  emailError.textContent = "";
  passError.textContent = "";
  confirmError.textContent = "";

  const fullNameRegex = /^[A-Za-zÀ-ÿ]+(?:\s+[A-Za-zÀ-ÿ]+)+$/;
  const usernameRegex = /^[a-zA-Z0-9]{4,}$/;
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
  const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/;

  let valid = true;

  if (fullname.value.trim() === "") {
   fullError.textContent = "Shkruaj emrin e plotë.";
    valid = false;
  }else if (!fullNameRegex.test(fullname.value.trim())) {
    fullError.textContent = "Shkruaj emër dhe mbiemër (p.sh. Arta Krasniqi).";
    valid = false;
  }

  if (username.value.trim() === "") {
    userError.textContent = "Shkruaj username.";
    valid = false;
  }else if (!usernameRegex.test(username.value.trim())) {
    userError.textContent = "Username duhet 4+ karaktere dhe vetëm shkronja/numra.";
    valid = false;
  }

  if (email.value.trim() === "") {
    emailError.textContent = "Shkruaj email-in.";
    valid = false;
  }else if (!emailRegex.test(email.value.trim())) {
    emailError.textContent = "Email jo valid.";
    valid = false;
  }

  if (password.value.trim() === "") {
    passError.textContent = "Shkruaj password.";
    valid = false;
  }else if (!passwordRegex.test(password.value)) {
    passError.textContent =
      "Password 6+ karaktere, 1 shkronjë të madhe, 1 të vogël dhe 1 numër.";
    valid = false;
  }

  if (confirm.value.trim() === "") {
    confirmError.textContent = "Konfirmo passwordin.";
    valid = false;
  }else if (password.value !== confirm.value) {
    confirmError.textContent = "Password-at nuk përputhen.";
    valid = false;
  }

if (valid) {
    alert("Account created successfully!");
}
});
//contactus
document.addEventListener("DOMContentLoaded", () => {

  const openBtn = document.getElementById("openContact");
  const popup = document.getElementById("popup");
  const closeBtn = document.getElementById("closePopup");

  openBtn.addEventListener("click", function(e) {
    e.preventDefault();
    popup.style.display = "flex";
  });

  closeBtn.addEventListener("click", function() {
    popup.style.display = "none";
  });

  // VALIDIMI I FORMËS
  const form = document.getElementById("contactForm");
  const nameField = document.getElementById("contactName");
  const emailField = document.getElementById("contactEmail");
  const msgField = document.getElementById("contactMsg");

  form.addEventListener("submit", function(e) {
    e.preventDefault();

    if (nameField.value.trim() === "") {
      alert("Shkruaj emrin.");
      nameField.focus();
      return;
    }

    if (emailField.value.trim() === "") {
      alert("Shkruaj emailin.");
      emailField.focus();
      return;
    }

    if (!emailField.value.includes("@")) {
      alert("Email jo valid.");
      emailField.focus();
      return;
    }

    if (msgField.value.trim() === "") {
      alert("Shkruaj mesazhin.");
      msgField.focus();
      return;
    }

    alert("Mesazhi u dërgua me sukses!");
    popup.style.display = "none";
    form.reset();
  });

});

//menu
const menu=document.getElementById("menu");
const navLinks = document.getElementById("navLinks");

menu.addEventListener("click", () => {
  navLinks.classList.toggle("show");
});

