import './carousel-config';
import {carousel} from "./carousel-config";
import './sidebar';
import {sidebar} from "./sidebar";
import './sidebar-ajax';
import {sidebarAjax} from "./sidebar-ajax";
import {shoresideAnimations} from "./shoreside-animations";
import './shoreside-animations';
import {breadcrumbs} from "./breadcrumbs";
import './breadcrumbs';
import {videoCatAjax} from "./video-cat-ajax";
import './video-cat-ajax';

jQuery(document).ready(function($) {
  $(shoresideAnimations);
  $(breadcrumbs);

  window.onscroll = function() {navStick()};

  const navbar = document.getElementById("navbar");
  const shelf = document.getElementById("shelf");
  const sticky = navbar.offsetTop;
  const pageUrl = document.location.href;

  function navStick() {
    if (window.pageYOffset >= sticky) {
      navbar.classList.add("sticky");
      shelf.style.marginTop = "20px";
    } else {
      navbar.classList.remove("sticky");
      shelf.style.marginTop = "0px";
    }
  }

  $(carousel);

  $('.financingText').on( 'click', function(){
    $('.disclaimer').show();
  });

  $(document).mouseup(function(e){
    const disclaimer = $('.disclaimer');
    const financing = $('.financingText');
    if (!financing.is(e.target) && financing.has(e.target).length === 0){
      disclaimer.hide();
    };
  });

//Mobile check
  const mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));

  if (mobile) {
    const home = $(location).attr("origin");
    const logo = $('<img>', {src:'/wp-content/themes/shoreside/assets/src/library/images/rps-logo-small.webp', alt:'Recreational Power Sports Logo', width:'66.67', height:'50'})

    $('.slick-arrow').delay(10000).fadeOut('slow');
    $('.mega-toggle-blocks-left').append(logo);

    $(document).on('click', '.mega-toggle-blocks-left', function(){
      window.history.replaceState({}, document.title, home);
      location.reload(true);
    });
  }

  setTimeout(function(){
    $('#prompt-CWnFXGNPWNYNiMFgwS5X-iframe').fadeOut('slow');
  }, 10000 );

  if(pageUrl.indexOf("showroom") > -1 || pageUrl.indexOf("parts-and-accessories") > -1){
    $(sidebar);
    $(sidebarAjax);
    $(videoCatAjax)
  }

  (function($) {
    const slider = $('.brand-carousel');
    const slider_length = $('.brand-carousel > section').length -1;
    function jumpBack() {
      setTimeout(function() {
        slider.slick("slickGoTo", 0);
      }, 10000);
    }
    slider.on("afterChange", function(event, slick, currentSlide) {
      if ( Math.round(slider_length / currentSlide) <= 2) {
          jumpBack();
      }
    });
  })($);

});