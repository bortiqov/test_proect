let header = document.querySelector(".site-header");
if (header) {
  document.addEventListener("scroll", function (e) {
    if (window.scrollY !== 0) {
      header.classList.add("scroll");
    } else {
      header.classList.remove("scroll");
    }
  });
}
// Lang
let dropBtns = document.querySelectorAll(".lang-drop a");
let dropMenu = document.querySelector(".lang-drop-menu");
dropBtns.forEach((el) =>
  el.addEventListener("click", function () {
    if (dropMenu.classList.contains("hide")) {
      dropMenu.classList.remove("hide");
      setTimeout(() => {
        dropMenu.classList.add("hidden");
      }, 500);
    } else {
      dropMenu.classList.toggle("hidden");
      dropMenu.classList.add("hide");
    }
  })
);
// Search
let searchPart = document.querySelector(".search-part");
let searchBtn = document.querySelector(".search-btn");
searchBtn.addEventListener("click", function () {
  searchPart.classList.toggle("active");
  if (searchPart.classList.contains("active")) {
    document.querySelector(".search-input").focus();
  }
});
//
document.querySelector("#nav-icon1").addEventListener("click", function () {
  document.querySelector(".site-header nav").classList.toggle("open");
});
document.querySelector(".nav-overlay").addEventListener("click", function () {
  document.querySelector(".site-header nav").classList.remove("open");
});
if (window.innerWidth < 500) {
  document.querySelector(".site-nav").append(searchPart);
}
// AoS
let effects = [
  "fade-up",
  "fade-down",
  "fade-right",
  "fade-left",
  "fade-up-right",
  "fade-up-left",
  "flip-left",
  "flip-right",
  "flip-up",
  "flip-down",
  "zoom-in",
  "zoom-in-up",
  "zoom-in-left",
  "zoom-in-right",
  "zoom-out",
  "zoom-out-up",
  "zoom-out-down",
  "zoom-out-right",
  "zoom-out-left",
];
let cards1 = document.querySelectorAll(".feature-card");
cards1.forEach((el, index) => {
  el.setAttribute(
    "data-aos",
    effects[Math.floor(Math.random() * effects.length - 1)]
  );
  el.setAttribute("data-aos-delay", index * 50);
});
let cards2 = document.querySelectorAll(".blog-card");
cards2.forEach((el, index) => {
  el.setAttribute(
    "data-aos",
    effects[Math.floor(Math.random() * effects.length - 1)]
  );
  el.setAttribute("data-aos-delay", index * 50);
});

setTimeout(() => {
  AOS.init({ once: true });
});
// Tilt JS
VanillaTilt.init(document.querySelectorAll(".feature-card .text-part"), {
  max: 10,
  speed: 400,
});
VanillaTilt.init(document.querySelectorAll(".fillial-card"), {
  max: 10,
  speed: 400,
});
// Swiper Controller
let swiper = new Swiper("#mainSlider", {
  direction: "vertical",
  effect: "fade",
  // loop: true,
  allowTouchMove: false,
  autoplay: {
    duration: 3500,
  },
  pagination: {
    el: ".main-pagination",
    clickable: true,
  },
});

let swiper2 = new Swiper("#cardsEffect", {
  effect: "cards",
  grabCursor: true,
  pagination: {
    el: ".cards-slide-pagination",
    clickable: true,
  },
});

//Video Play
let controller = document.querySelector("#playBtn");
let video = document.querySelector("#myVideo");
let pauseSrc = "./images/svg/pause-icon.svg";
let playSrc = "./images/svg/play-icon.svg";
controller.addEventListener("click", function () {
  controller.classList.add("play");
  setTimeout(() => {
    controller.querySelector("img").src = pauseSrc;
    video.play();
    video.setAttribute("controls", "controls");
    controller.style.opacity = 0;
  }, 1000);
});
