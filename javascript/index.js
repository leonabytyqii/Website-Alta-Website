let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function showSlides(n) {
  const slides = document.getElementsByClassName("mySlides");

  if (slides.length === 0) return;

  if (n > slides.length) slideIndex = 1;
  if (n < 1) slideIndex = slides.length;

  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  slides[slideIndex - 1].style.display = "block";
}



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

