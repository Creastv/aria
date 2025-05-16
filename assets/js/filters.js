
// (function($) {
// $(document).ready(function () {
//     jQuery(document).ready(function($) {

//         const mobileBreakpoint = 767;
    
//         function isMobile() {
//             return window.innerWidth < mobileBreakpoint;
//         }
    
//         function collapseAdvancedSearchIfMobile() {
//             if (isMobile()) {
//                 $('#advancedSearch').slideUp();
//                 const $toggle = $('#toggleAdvanced');
//                 $toggle.find(".bi").removeClass("bi-chevron-up").addClass("bi-chevron-down");
//                 $toggle.contents().filter(function() {
//                     return this.nodeType === 3;
//                 }).first().replaceWith("Rozwiń ");
//             }
//         }
    
//         // Ukrycie advancedSearch na mobilu przy starcie
//         if (isMobile()) {
//             $("#advancedSearch").hide();
//             const $toggle = $("#toggleAdvanced");
//             $toggle.find(".bi").removeClass("bi-chevron-up").addClass("bi-chevron-down");
//             $toggle.contents().filter(function() {
//                 return this.nodeType === 3;
//             }).first().replaceWith("Rozwiń ");
//         }
    
//         // Obsługa toggleAdvanced na desktopie i mobile
//         $("#toggleAdvanced").click(function (e) {
//             e.preventDefault();
//             $("#advancedSearch").slideToggle();
    
//             const $icon = $(this).find(".bi");
//             const isExpanded = $icon.hasClass("bi-chevron-up");
    
//             if (isExpanded) {
//                 $icon.removeClass("bi-chevron-up").addClass("bi-chevron-down");
//                 $(this).contents().filter(function() {
//                     return this.nodeType === 3;
//                 }).first().replaceWith("Rozwiń ");
//             } else {
//                 $icon.removeClass("bi-chevron-down").addClass("bi-chevron-up");
//                 $(this).contents().filter(function() {
//                     return this.nodeType === 3;
//                 }).first().replaceWith("Zwiń ");
//             }
//         });
    
//         // ... cały pozostały kod (ulubione, filtrowanie, fetchLokale itd.) zostaje bez zmian ...
    
//         $('.js-search-btn, .clear-btn').on('click', function () {
//             collapseAdvancedSearchIfMobile();
//         });
    
//         // Reszta logiki aplikacji
//         // ...
    
//     });
    


//     $(".select2").select2({
//         placeholder: "Wybierz opcję",
//         allowClear: true,
//     });

//     // Initialize Range Slider
//     $("#metrageRange").ionRangeSlider({
//         type: "double",
//         min: 24,
//         max: 216,
//         from: 24,
//         to: 216,
//         grid: false,
//         prefix: "",
//         // postfix: " m²",
//         postfix: "",
//     });

   

//     // Clear button functionality
//     $(".clear-btn").click(function () {
//         $(".room-btn").removeClass("active");
//         $(".select2").val(null).trigger("change");

//         // Reset range slider
//         var slider = $("#metrageRange").data("ionRangeSlider");
//         slider.reset();
//     });
// });
//     var $range = $("#metrageRange");
//     if ($range.length) {
//         $range.ionRangeSlider({
//             type: "double",
//             min: $range.data('min'),
//             max: $range.data('max'),
//             from: $range.data('min'),
//             to: $range.data('max'),
//             postfix: " m²",
//             onFinish: function(data) {
//                 // Możesz tu odpalić AJAX automatycznie po zmianie slidera:
//                 // fetchLokale();
//             }
//         });
//     }

// })(jQuery);
