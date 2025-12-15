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
document.addEventListener("DOMContentLoaded", () => {
  const menu = document.getElementById("menu");
  const navLinks = document.getElementById("navLinks");
  if (!menu || !navLinks) return;

  menu.addEventListener("click", () => {
    navLinks.classList.toggle("show");
    menu.classList.toggle("open");
  });
});