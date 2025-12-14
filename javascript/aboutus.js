const menu = document.getElementById("menu");
const navLinks = document.querySelector(".nav-links");

if (menu && navLinks) {
  menu.addEventListener("click", () => {
    navLinks.classList.toggle("show");
  });

  // kur klikohen linkat në mobile, mbylle menunë
  navLinks.querySelectorAll("a").forEach(a => {
    a.addEventListener("click", () => navLinks.classList.remove("show"));
  });
}

const popup = document.getElementById("popup");
const openContact = document.getElementById("openContact");
const closePopup = document.getElementById("closePopup");
const contactForm = document.getElementById("contactForm");

function openPop() {
  if (!popup) return;
  popup.classList.add("show");
}

function closePop() {
  if (!popup) return;
  popup.classList.remove("show");
}

if (openContact) {
  openContact.addEventListener("click", (e) => {
    e.preventDefault();
    openPop();
  });
}

if (closePopup) closePopup.addEventListener("click", closePop);

if (popup) {
  popup.addEventListener("click", (e) => {
    if (e.target === popup) closePop();
  });
}

document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") closePop();
});

if (contactForm) {
  contactForm.addEventListener("submit", (e) => {
    e.preventDefault();
    alert("Message sent!");
    closePop();
    contactForm.reset();
  });
}
