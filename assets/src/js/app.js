import './carousel-config';
import {carousel} from "./carousel-config";
import './sidebar';
import {sidebar} from "./sidebar";
import './sidebar-ajax';
import {sidebarAjax} from "./sidebar-ajax";


jQuery(document).ready(function($) {

  window.onscroll = function() {navStick()};

  var navbar = document.getElementById("navbar");
  var sticky = navbar.offsetTop;
  var win = $(this);

  //Mobile check
  var mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));

  function navStick() {
    if (window.pageYOffset >= sticky) {
      navbar.classList.add("sticky")
    } else {
      navbar.classList.remove("sticky");
    }
  }

  $(carousel);

  $('.financingText').on( 'click', function(){
    $('.disclaimer').show();
  });

  $(document).mouseup(function(e){
    var disclaimer = $('.disclaimer');
    var financing = $('.financingText');
    if (!financing.is(e.target) && financing.has(e.target).length === 0){
      disclaimer.hide();
    };
  });
  if(!mobile) {
    $('#brandContent .product').on({
      mouseenter: function () {
        $(this).find('.shoreside-product-title').css('visibility', 'visible');
      },
      mouseleave: function () {
        $(this).find('.shoreside-product-title').css('visibility', 'hidden');
      },
    });

    $(window).on('resize', function(){
      if (win.width() <= 1024 ){
        $('.brands h3').hide();
        $('.brands p').hide();
        $('.brandCard').removeClass('brands');
        $('#brandSection').removeClass('container');
      };
      if (win.width() >= 1024 ){
        $('.brands h3').show();
        $('.brands p').show();
        $('.brandCard').addClass('brands');
        $('#brandSection').addClass('container');
      };
    });
    function brandShuffle(){
      if ( win.width() < 1024) {
        $('.brands h3').hide();
        $('.brands p').hide();
        $('.brandCard').removeClass('brands');
        $('#brandSection').removeClass('container');

      }
    }
    $(window).resize(brandShuffle());
  }

  if (mobile) {
    var home = $(location).attr("origin");
    var logo = $('<img>', {src:'/wp-content/themes/shoreside/assets/src/library/images/rps-logo-small.png', alt:'Recreational Power Sports Logo'})

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

  $(sidebar);

  //Loading screen
  $(document).ajaxStart(function(){
    $('#loading').show();
  });
  $(document).ajaxStop(function(){
    $('#loading').hide();
  });

  $(sidebarAjax)
  // $(document).on('click', '.modal-link a', function(e){
  //   var ajaxUrl = window.location.origin + "/wp-admin/admin-ajax.php";
  //   var productUrl = $(this).attr('href');
  //
  //   window.modalPayload.product = productUrl;
  //
  //   e.preventDefault();
  //   e.stopImmediatePropagation();
  //   $('.modal').show();
  //   $(document.body.parentNode).css('overflow', 'hidden')
  //   $(document).on('click', '.modal', function(){
  //     $('.modal').hide();
  //     $(document.body.parentNode).css('overflow', '')
  //   });
  //   $.ajax({
  //
  //     url: ajaxUrl,
  //     dataType: 'html',
  //     data: window.modalPayload,
  //
  //     success: function (response) {
  //       $('#modalContent').html(response);
  //     },
  //     error: function (response) {
  //       console.log(response);
  //     }
  //   });
  // });

});