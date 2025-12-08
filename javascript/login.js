const btn = document.querySelector('.btn');

    btn.addEventListener('click', function (event) {
      event.preventDefault();

      const username = document.getElementById('username');
      const password = document.getElementById('password');

      if (username.value === "") {
        alert("Shkruaj username.");
        username.focus();
        return false;
      }

      if (password.value === "") {
        alert("Shkruaj password.");
        password.focus();
        return false;
      }

      alert("Logged in successfully");
    });