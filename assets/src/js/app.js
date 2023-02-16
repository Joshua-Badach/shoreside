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

  // Slider carousel code

    //Portrait carousel code
    $('.carousel-product').slick({
      slidesToShow: 1,
      autoplay: true,
      speed: 500,
      autoplaySpeed: 10000,
      arrows: false,
      fade: false,
      asNavFor: '.carousel-product-nav',
      adaptiveHeight: true,
      mobileFirst: true,
      dots: false,
      infinite: true,
      lazyLoad: 'ondemand',
    });
    $('.carousel-product-nav').slick({
      slidesToShow: 4,
      speed: 500,
      arrows: false,
      asNavFor: '.carousel-product',
      dots: false,
      mobileFirst: true,
      focusOnSelect: true,
      lazyLoad: 'ondemand',
    });
    $('.carousel-product').slickLightbox({
      itemSelector: 'a',
      navigateByKeyboard: true
    });

  $('.mainCarousel').slick({
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    speed: 1000,
    autoplay: true,
    autoplaySpeed: 10000,
    mobileFirst: true,
    dots: false,
    arrows: false,
    lazyLoad: false,
  });

  // function brandCarousel(){
  $('.brand-carousel').slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    autoplay: true,
    speed: 300,
    autoplaySpeed: 10000,
    arrows: false,
    dots: false,
    mobileFirst: false,
    lazyLoad: 'ondemand',
  });
  // }

  // $('#sidebarContainer').hide();

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

  function sidebar() {
    var pageUrl = document.location.href;
    var pageObj = $('#contentTrigger').data('page');
    var slug = $('#contentTrigger').data('slug');
    var catSlug = $('.display').data('parent');
    var uri = window.location.toString();
    var clear_uri = uri.substring(0, uri.lastIndexOf('/') + 1);

    $('#sidebar hr').hide();
    $('#clear').hide();

    //Filter switch toggles
    if (catSlug.indexOf('preowned') != -1) {
      $('input:checkbox[name="condition"]').prop('checked', true);
      $('.conditionInput').attr('data-category', pageObj);
      $('.conditionInput').attr('data-slug', slug);
    }

    //Show sale toggle if user is in showroom
    if (pageUrl.indexOf('showroom') == -1) {
      $('#showroomToggle').hide();
    }

    //Prevent defaults for filter heading dropdowns
      $('#contentTrigger .filterHeading').on('click', 'a', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
      });

      //Hide filters on load if mobile
      if (!mobile) {
          $('.showCategories img').toggleClass('sidebarIconAnimate90');
          $('#categories a').show();
        } else {
        $('#categories a').hide();
      }
      //Hide filters on load if more than 5 children
      if ($('#attributes').children().length >= 5) {
          $('#attributes a').hide();
      } else {
        $('.showAttributes img').toggleClass('sidebarIconAnimate90');
        $('#attributes a').show();
      }

      // Hide tabs if empty
      if ($('#categories').children().length == 0) {
        $('#categoryTab').hide();
      }
      if ($('#attributes').children().length == 0) {
        $('#attributeTab').hide();
      }

      //Animate filtering arrow on click, show links
      $('.showCategories').on('click', function () {
        $('#categories a').toggle();
        $('.showCategories img').toggleClass('sidebarIconAnimate90');
      });

      $('.showAttributes').on('click', function () {
        $('#attributes a').toggle();
        $('.showAttributes img').toggleClass('sidebarIconAnimate90');
      });

    //Hidenslide for mobile filter
    if (mobile) {
      $('#sidebarIcon').on('click', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $('#sidebarContainer').toggle(500);
        $('#sidebarIcon img').toggleClass('sidebarIconAnimate');
        if (mobile) {
          $('#sidebarContainer').css('position', 'absolute');
        }
      });
    } else {
      $('#sidebarIcon img, #mobileFilter a').hide();
      $('#mobileFilter').css('height', '30px');
      $('#sidebarContainer').css('display', 'block');
    }

    if (pageUrl.indexOf('/?') != -1) {
      $('#clear').show();
      $('#sidebar hr').show();
    }

    $('#clear').on('click', function(){
      $(this).data('category', pageObj);
      $(this).data('attribute', '');
      $(this).data('term', '');
      $(this).data('orderby', '');
      $(this).data('slug', slug);
      $(this).data('sale', '');
      $('.display').data('parent', '');
      window.history.replaceState({}, document.title, clear_uri);
    });
  };

  sidebar();

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

  //Sidebar ajax queries
  //Clean this up

  $(document).on('click', '#sidebar a, #sidebar input, #sidebar button', function() {
    // var pageUrl = document.location.href;

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

        sidebar();
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
