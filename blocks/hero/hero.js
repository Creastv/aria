
// Header Area
(function($) {
$(document).ready(function () {
    // Initialize Slick Slider
    $(".hero-slider").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      dots: false,
      fade: true,
      cssEase: "linear",
      autoplay: true,
      autoplaySpeed: 4000,
      adaptiveHeight: true,
    });
  
    // Custom navigation for slider
    $(".slider-prev").on("click", function () {
      $(".hero-slider").slick("slickPrev");
    });
  
    $(".slider-next").on("click", function () {
      $(".hero-slider").slick("slickNext");
    });
  
    // Update progress bar
    $(".hero-slider").on(
      "beforeChange",
      function (event, slick, currentSlide, nextSlide) {
        const totalSlides = slick.slideCount;
        const progressPercentage = ((nextSlide + 1) / totalSlides) * 100;
        $(".slider-progress-bar").css("width", progressPercentage + "%");
      },
    );
});
})(jQuery);