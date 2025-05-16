// // appointment-slider
(function($) {
$(document).ready(function () {
  // Initialize Slick Slider
  $(".appointment-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    fade: true,
    cssEase: "linear",
    autoplay: false,
    adaptiveHeight: true,
  });

  // Custom navigation for slider
  $(".slider-prev").on("click", function () {
    $(".appointment-slider").slick("slickPrev");
  });

  $(".slider-next").on("click", function () {
    $(".appointment-slider").slick("slickNext");
  });

  // Update progress bar
  $(".appointment-slider").on(
    "beforeChange",
    function (event, slick, currentSlide, nextSlide) {
      const totalSlides = slick.slideCount;
      const progressPercentage = ((nextSlide + 1) / totalSlides) * 100;
      $(".slider-progress-bar").css("width", progressPercentage + "%");
    },
  );
});
})(jQuery);