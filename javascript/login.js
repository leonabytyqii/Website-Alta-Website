const btn = document.querySelector('.btn');

    btn.addEventListener('click', function (event) {
      event.preventDefault();

      const username = document.getElementById('username');
      const password = document.getElementById('password');

       const userError = document.getElementById('userError');
       const passError = document.getElementById('passError');
  

       userError.textContent = "";
       passError.textContent = "";

      const usernameRegex = /^[a-zA-Z0-9]{4,}$/;
      const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/;

      let valid = true;
      if (username.value.trim() === "") {
       userError.textContent = "Shkruaj username.";
       valid = false;
      }  else if (!usernameRegex.test(username.value)) {
        userError.textContent = "Username duhet të ketë 4+ karaktere dhe vetëm shkronja/numra.";
       valid = false;
  }

      if (password.value.trim() === "") {
        passError.textContent = "Shkruaj password.";
        valid = false;
      }   else if (!passwordRegex.test(password.value)) {
       passError.textContent = "Password duhet të ketë 6+ karaktere, 1 shkronjë të madhe, 1 të vogël dhe 1 numër.";
      valid = false;
  }


    if (valid) {
  document.getElementById("loginForm").submit();
}
    });


//menu
const menu = document.getElementById("menu");
const navLinks = document.getElementById("navLinks");

menu.addEventListener("click", () => {
  navLinks.classList.toggle("show");
  menu.classList.toggle("open");
});

