jQuery(document).ready(function( $ ) {
  "use strict";


  /**********************
   *   Location Page    *
   **********************/

  // add a hash to the URL when the user clicks on a tab
  $('.gallery-toggle').on('click', function(e) {
    $('.tabbed-content').toggleClass('active');
    history.pushState(null, null, $(this).attr('href'));
  });
  if ($('.gallery-toggle')) {
    if ($(location.hash).length) {
      $('.tabbed-content').toggleClass('active');
    }
    // navigate to a tab when the history changes
    window.addEventListener("popstate", function(e) {
      var activeTab = $(location.hash);
      $('.tabbed-content').removeClass('active');
      if (activeTab.length) {
        activeTab.addClass('active');
      } else {
        $('#tab-1').addClass('active');
      }
    });
  }

  /**********************
   *  Lightbox Gallery  *
   **********************/
   if ($(window).width() > 768) {
     $('.gallery-sidebar').lightGallery({
       selector: '.img-wrap',
       hasg: true
     });
  }

});
