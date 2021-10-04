jQuery(document).ready(function( $ ) {
  "use strict";

/********************
 *   Animate CTA    *
 ********************/
 if ($(".block-cta svg")) {

   const paths = document.querySelectorAll('.block-cta svg path');

   function loopPathOpacity() {
     for ( let i=0 ; i < paths.length; i++ ) {
      // get function in closure, so i can iterate
      let togglePathOpacity = setPathOpacity( i );
      // stagger transition with setTimeout
      let delay = paths.length - i - 1;
      delay *= 750;
      //let delay = i * 750;
      setTimeout( togglePathOpacity, delay );
      }
   }

    function setPathOpacity( i ) {
      let path = paths[i];
      return function() {
        path.classList.toggle('on');
      }
    }

    setInterval(function() {
            loopPathOpacity();
      }, 1500); // every 1000 ms
 }

 });
