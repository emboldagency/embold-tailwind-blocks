document.addEventListener("DOMContentLoaded", function () {
  let sliderDelay;

  if (document.body.classList.contains("wp-admin")) {
    sliderDelay = 3500;
  } else {
    sliderDelay = 0;
  }
  setTimeout(function () {
    new Splide(".hero-splide", {
      autoplay: true,
      type: "fade",
      rewind: true,
      gap: "2rem",
      arrows: false,
      lazyLoad: "nearby",
    }).mount();
  }, sliderDelay);
});
