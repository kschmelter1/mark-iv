jQuery(document).ready(function( $ ) {
  "use strict";

  /**********************
   *   Swiper Sliders   *
   **********************/

    // Cycles through each slider to allow multiple sliders per page
      $(".block-hero-slider").each(function(){
         var options = {};
         var thisSwiper = $(this).find(".swiper-container");
         // Checks the slider has more than one slide. If it doesn't, pagination is disabled for that slider.
          if ( $(this).find(".swiper-slide").length > 1 ) {
              options = {
                loop: true,
                slidesPerView: 1,
                //centeredSlides: true,
                speed: 1000,
                effect: 'fade',
                fadeEffect: {
                  crossFade: true
                },
                 pagination: {
                   el: $(this).find('.swiper-pagination'),
                   type: 'bullets',
                   clickable: true,
                   dynamicBullets: false,
                   //dynamicMainBullets: 5
                 },
                 autoplay: {
                  delay: 5000,
                }
              }
          } else {
              options = {
                  loop: false,
                  autoplay: false,
              }
          }
          var swiper = new Swiper(thisSwiper, options);
       });

       if (window.innerWidth < 1024) {
       // Cycles through each slider to allow multiple sliders per page
         $(".block-featured").each(function(){
            var options = {};
            var thisSwiper = $(this).find(".swiper-container");
            // Checks the slider has more than one slide. If it doesn't, pagination is disabled for that slider.
             if ( $(this).find(".swiper-slide").length > 1 ) {
                 options = {
                   loop: false,
                   slidesPerView: 'auto',
                   spaceBetween: 15,
                   //centeredSlides: true,
                   speed: 1000,
                    autoplay: {
                     delay: 5000,
                   },
                   breakpoints: {
                    // when window width is >= 640px
                    375: {
                      spaceBetween: 15,
                      centeredSlides: true
                    },
                    767: {
                      spaceBetween: 30,
                      centeredSlides: true
                    }
                  }
                 }
             } else {
                 options = {
                     loop: false,
                     autoplay: false,
                 }
             }
             var swiper = new Swiper(thisSwiper, options);
          });
        }

  /********************
   *   Sidebar Menu   *
   ********************/

   $('.navbar-toggler').click(function(){
     $('.primary-navbar').addClass('show');
     $('body').css('overflow', 'hidden');
   });

   $('.navbar-close').click(function(){
     $('.primary-navbar').removeClass('show');
     $('body').css('overflow', 'auto');
   });

/***********************************
 *  Bootstrap Clickable Dropdown   *
 ***********************************/
 //if ($(window).width() > 1200) {
   $('.main-navigation .navbar .dropdown').hover(function() {
     if ($(window).width() > 1200) {
     //$(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();
     $(this).find('.dropdown-menu').first().addClass('active');
      }
   }, function() {
     if ($(window).width() > 1200) {
       $(this).find('.dropdown-menu').first().removeClass('active');
     //$(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp();
      }
   });
 //}

 $('.navbar .dropdown > a').click(function() {
   location.href = this.href;
 });

 /**********************
  *  Location Filter   *
  **********************/

$('.location-search-controls select').change(function(){
  const filterCity = $('.select-locations').find("option:selected").attr('value');
  const filterType = $('.select-types').find("option:selected").attr('value');
  const filterMessage = $('.location-search-empty');
  let results = 0;
  //const newFilter = $(this).find("option:selected").attr('value');
  //const filterType = $(this).data("type");
  $('.location-search-item').each(function(){
    let active = true;
    if (filterType != "all" && $.inArray(filterType, $(this).data("type")) < 0 ) {
      active = false;
    }
    if (filterCity != "all" && $.inArray(filterCity, $(this).data("city")) < 0 ) {
      active = false;
    }

    if (active) {
      $(this).addClass('active');
      results++;
    } else {
      $(this).removeClass('active');
    }

  });
  if (results === 0) {
    filterMessage.addClass('active');
  } else {
    filterMessage.removeClass('active');
  }
});

/********************
 *   Form Effects   *
 ********************/

 $(".frm_form_field > *").focus(function(){
   $(this).parent().addClass("input--filled");
  }).blur(function(){
   $(this).parent().removeClass("input--filled");
 });

 /***************************
  * Sticky Header on Scroll *
  ***************************/

// Get the header
const header = document.getElementById("sticky");

if (header) {
  // Get the offset position of the navbar
  let sticky = header.offsetTop;
  let midNav = false;
  if (header.closest('.mid-nav')) {
    sticky = 100;
    midNav = true;
    header.classList.add("d-none");
    $("#stickyHelper").remove();
  }

  // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
  function stickyScroll() {

      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
        header.classList.remove("d-none");
      } else {
        header.classList.remove("sticky");
        if (midNav) {
          header.classList.add("d-none");
        }
      }
    }

  // When the user scrolls the page, execute myFunction
  window.onscroll = function() {stickyScroll()};
}

});
