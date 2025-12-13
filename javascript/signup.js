const btn = document.querySelector(".btn");

btn.addEventListener("click", function (event) {
  event.preventDefault();

  const fullname = document.querySelector('#fullname');
  const username = document.querySelector('#username');
  const email = document.querySelector('#email');
  const password = document.querySelector('#password');
  const confirm = document.querySelector('#confirm');

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

  // regex
  const fullnameRegex = /^[a-zA-ZÀ-ÿ\s]{3,}$/;                 
  const usernameRegex = /^[a-zA-Z0-9]{4,}$/;                 
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;        
  const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/; 

  let valid = true;
   //fullname
  if (fullname.value === "") {
    alert("Shkruaj emrin e plotë.");
    fullname.focus();
    return false;
  } else if 
    (fullname.value.trim() === "") {
    fullError.textContent = "Shkruaj emrin e plotë.";
    valid = false;
  } else if (!fullnameRegex.test(fullname.value.trim())) {
    fullError.textContent = "Emri i plotë duhet të ketë të paktën 3 shkronja.";
    valid = false;
  }

  if (username.value === "") {
    alert("Shkruaj username.");
    username.focus();
    return false;
  } else if 
    // Username
   (username.value.trim() === "") {
    userError.textContent = "Shkruaj username.";
    valid = false;
  } else if (!usernameRegex.test(username.value.trim())) {
    userError.textContent = "Username duhet të ketë 4+ karaktere dhe vetëm shkronja/numra.";
    valid = false;
  }

  if (email.value === "") {
    alert("Shkruaj email-in.");
    email.focus();
    return false;
  }
  else if 
     // Email
  (email.value.trim() === "") {
    emailError.textContent = "Shkruaj email-in.";
    valid = false;
  } else if (!emailRegex.test(email.value.trim())) {
    emailError.textContent = "Email-i nuk është valid ."; 
    valid = false;
  }
  

  if (password.value === "") {
    alert("Shkruaj password.");
    password.focus();
    return false;
  } else if 
    // Password
  (password.value.trim() === "") {
    passError.textContent = "Shkruaj password.";
    valid = false;
  } else if (!passwordRegex.test(password.value)) {
    passError.textContent =
      "Password duhet të ketë 6+ karaktere, 1 shkronjë të madhe, 1 të vogël dhe 1 numër.";
    valid = false;
  }
  

  if (confirm.value === "") {
    alert("Konfirmo passwordin.");
    confirm.focus();
    return false;
  } else if
    // Confirm
   (confirm.value.trim() === "") {
    confirmError.textContent = "Konfirmo passwordin.";
    valid = false;
  } else if (password.value !== confirm.value) {
    confirmError.textContent = "Password-at nuk përputhen!";
    valid = false;
  }
  

  if (password.value !== confirm.value) {
    alert("Password-at nuk përputhen!");
    return false;
  }
   if (valid) {
    alert("Account created successfully!");
  }
});



