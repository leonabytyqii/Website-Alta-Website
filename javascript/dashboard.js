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