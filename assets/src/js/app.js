import './carousel-config';
import {carousel} from "./carousel-config";
import './sidebar';
import {sidebar} from "./sidebar";


jQuery(document).ready(function($) {

  window.LoadResultsPayload = {
    type: 'POST',
    action: 'load_results',
  };
  window.modalPayload = {
    type: 'POST',
    action: 'load_product',
  };

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

  $(document).on('click', '#sidebar a, #sidebar input, #sidebar button', function() {

    var idObj = $(this).data('category');
    var attribute = $(this).data('attribute');
    var tagObj = $(this).data('term');
    var orderByOjb = $(this).data('order');
    var onSaleObj = $(this).data('sale');
    var slug = $(this).data('slug');
    var catSlug = $('.display').data('parent');


    var pageObj = $('#contentTrigger').data('page');
    var slugObj = $('#contentTrigger').data('slug');
    var ajaxUrl = window.location.origin + "/wp-admin/admin-ajax.php";
    window.LoadResultsPayload.idObj = idObj;
    window.LoadResultsPayload.pageObj = pageObj;
    window.LoadResultsPayload.attribute = attribute;
    window.LoadResultsPayload.tagObj = tagObj;
    window.LoadResultsPayload.orderByOjb = orderByOjb;
    window.LoadResultsPayload.onSaleObj = onSaleObj;
    window.LoadResultsPayload.slug = slug;
    window.LoadResultsPayload.catSlug = catSlug;

    $.ajax({
      url: ajaxUrl,
      dataType: 'html',
      data: window.LoadResultsPayload,
      success: function (response) {
        $('#contentTrigger').html(response);

        $(sidebar);
        if (slug.indexOf('preowned') != -1 || catSlug.indexOf('preowned') != -1) {
          $('.conditionInput').prop('checked', true);
          $('.conditionInput').attr('data-category', pageObj);
          $('.conditionInput').attr('data-slug', slugObj);
        } else {
          $('.conditionInput').prop('checked', false);
          $('#conditionInput').attr('category', idObj);
          $('#conditionInput').attr('slug', slug);
          var uri = window.location.toString();
          var clear_uri = uri.substring(0, uri.indexOf("?"));
          window.history.pushState({}, document.title, clear_uri);
        };
        if (onSaleObj == true) {
          $('.saleInput').prop('checked', true);
          $('.saleInput').attr('data-sale', false);
        };
        var newUri;
        var pushCat = '?product_cat=';
        var appendTerm = '&term=';
        var pushTerm = '?term=';

        if (idObj != pageObj && idObj != '') {
          if (idObj != '' && tagObj == '') {
            newUri = pushCat + idObj;
            window.history.pushState({}, document.title, newUri);
          };
          if (idObj != '' && tagObj != ''){
            newUri = pushCat + idObj + appendTerm + tagObj;
            window.history.pushState({}, document.title, newUri);
          };
        } else {
          if (tagObj != '') {
            newUri = pushTerm + tagObj;
            window.history.pushState({}, document.title, newUri);
          };
        };
        if (mobile) {
          $('#sidebarContainer').css('position', 'absolute');
        };
        if (tagObj != ''){
          $('#categoryTab').hide();
        };
        if (idObj != pageObj || tagObj != ''){
          $('#clear').show();
          $('#sidebar hr').show();
        } else {
          $('#clear').hide();
          $('#sidebar hr').hide();
        }
      },
      error: function (response) {
        console.log(response);
      }
    });
  });

});