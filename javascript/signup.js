const btn = document.querySelector(".btn");

btn.addEventListener("click", function (event) {
  event.preventDefault();

  const fullname = document.querySelector('#fullname');
  const username = document.querySelector('#username');
  const email = document.querySelector('#email');
  const password = document.querySelector('#password');
  const confirm = document.querySelector('#confirm');

  if (fullname.value === "") {
    alert("Shkruaj emrin e plotë.");
    fullname.focus();
    return false;
  }

  if (username.value === "") {
    alert("Shkruaj username.");
    username.focus();
    return false;
  }

  if (email.value === "") {
    alert("Shkruaj email-in.");
    email.focus();
    return false;
  }

  if (password.value === "") {
    alert("Shkruaj password.");
    password.focus();
    return false;
  }

  if (confirm.value === "") {
    alert("Konfirmo passwordin.");
    confirm.focus();
    return false;
  }

  if (password.value !== confirm.value) {
    alert("Password-at nuk përputhen!");
    return false;
  }

  alert("Account created successfully!");
});
