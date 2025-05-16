/*
| ==========================================================
| Scroll To Top
| ========================================================== */
(function($) {
$(document).ready(function () {
  "use strict";
  // Scroll To Top


  $(window).scroll(function () {
    if ($(window).scrollTop() > 500) {
      $(".go-top").fadeIn(600);
    } else {
      $(".go-top").fadeOut(600);
    }
  });

  $("#top").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 800);
    return false;
  });
});

// // Header Area
$(document).ready(function () {

  // Navbar scroll effect
  $(window).scroll(function () {
    $("header:not(.header-static)").each(function () {
      if ($(window).scrollTop() > 35) {
        $(this).css("background-color", "rgba(255, 255, 255, 0.95)");
        $(this).addClass("shadow-sm");
      } else {
        $(this).css("background-color", "transparent");
        $(this).removeClass("shadow-sm");
      }
    });
  });

  // Search functionality
  $(".search-toggle").on("click", function () {
    $(".search-overlay").addClass("active");
    setTimeout(function () {
      $(".search-form input").focus();
    }, 300);
  });

  $(".search-close").on("click", function () {
    $(".search-overlay").removeClass("active");
  });

  $(document).keyup(function (e) {
    if (e.key === "Escape") {
      $(".search-overlay").removeClass("active");
    }
  });
});

$(document).ready(function () {
  // Mobile menu toggle
  $(".mobile-menu-toggle").click(function () {
    $(".main-menu").toggleClass("active");
  });
  // Search toggle
  $(".search-toggle").click(function (e) {
    e.preventDefault();
    $(".search-container").addClass("active");
    $(".search-input").focus();
  });

  // Close search
  $(".search-close").click(function () {
    $(".search-container").removeClass("active");
  });

  // Close search on escape key
  $(document).keyup(function (e) {
    if (e.key === "Escape") {
      $(".search-container").removeClass("active");
    }
  });
});


})(jQuery);

document.addEventListener('DOMContentLoaded', function () {
  const submenuToggles = document.querySelectorAll('.submenu-toggle');

  submenuToggles.forEach(btn => {
      btn.addEventListener('click', function (e) {
          e.preventDefault();
          const li = btn.closest('li.nav-item');
          const expanded = btn.getAttribute('aria-expanded') === 'true';
          
          btn.setAttribute('aria-expanded', !expanded);
          btn.textContent = expanded ? '‹' : '›';
          li.classList.toggle('active');
      });
  });
});



const calaps = document.querySelectorAll(".calaps");
for (let i = 0; i < calaps.length; i++) {
  calaps[i].querySelector(".calaps__opener").addEventListener("click", function () {
    calaps[i].classList.toggle("active");
  });
}


if (jQuery(window).width() > 500) {
  jQuery('.go-parallex').paroller({
      factor: -0.3, // multiplier for scrolling speed and offset, +- values for direction control  
      // factorLg: 0.4, // multiplier for scrolling speed and offset if window width is less than 1200px, +- values for direction control  
      type: 'foreground', // background, foreground  
      direction: 'vertical', // vertical, horizontal  
      transition: 'translate 0.1s ease' // CSS transition, added on elements where type:'foreground' 
  });
  jQuery('.go-parallex-con').paroller({
    factor: 0.2, // multiplier for scrolling speed and offset, +- values for direction control  
    // factorLg: 0.4, // multiplier for scrolling speed and offset if window width is less than 1200px, +- values for direction control  
    type: 'foreground', // background, foreground  
    direction: 'vertical', // vertical, horizontal  
    transition: 'translate 0.1s ease' // CSS transition, added on elements where type:'foreground' 
});
}
