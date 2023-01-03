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

  // $(".contactform").hide();
  //
  // $(".emailButton").click(function(){
  //   $(".contactForm").toggle();
  // });

    $(window).on('resize', function(){
    if (win.width() <= 769 ){
      $('.brands h3').hide();
      $('.brands p').hide();
      $((".brandCard")).removeClass("brands");
    }

    if (win.width() >= 769 ){
      $('.brands h3').show();
      $('.brands p').show();
      $((".brandCard")).addClass("brands");
    };
  });

  function brandShuffle(){
    if ( win.width() < 769) {
      $('.brands h3').hide();
      $('.brands p').hide();
      $((".brandCard")).removeClass("brands");
    }
  }

  $(window).resize(brandShuffle());

  function navStick() {
    if (window.pageYOffset >= sticky) {
      navbar.classList.add("sticky")
    } else {
      navbar.classList.remove("sticky");
    }
  }

  $(document).on('click', '.search', function(event){
    input = jQuery('<form role="search" method="GET" id="searchform" class="searchform"><input name="s" value="" name="s" id="s" type="text"><button type="submit" class="searchFormButton">ok</button></form>');

    $('.search a').replaceWith(input);
 });

  // Slider carousel code
  $('.carousel').slick({
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    speed: 1000,
    autoplay: true,
    autoplaySpeed: 10000,
    mobileFirst: true,
    dots: true,
  });
  $('.mainCarousel').slick({
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    speed: 1000,
    autoplay: true,
    autoplaySpeed: 10000,
    mobileFirst: true,
    dots: true,
  });

  //Portrait carousel code
    $('.carousel-product').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      speed: 1000,
      autoplaySpeed: 10000,
      centerMode: true,
      fade: true,
      asNavFor: '.carousel-product-nav',
      adaptiveHeight: true,
      mobileFirst: true,
      dots: false,
    });
    $('.carousel-product-nav').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      speed: 1000,
      arrows: false,
      asNavFor: '.carousel-product',
      dots: false,
      centerMode: true,
      focusOnSelect: true,
    });
  $('#sidebarContainer').hide();

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

  //Mobile check
  var mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
  if (mobile) {
    $('.slick-arrow').delay(10000).fadeOut('slow');
  } else {

    // $('.financingText').hover(
    //   function(){
    //     $('.disclaimer').show();
    //   },
    //   function(){
    //     $('.disclaimer').fadeOut(2000);
    //   }
    // );

    // $('#sidebarIcon').hide();
    // $('#sidebarHeader').show();
    // $('#mobileFilter').hide();
    // Pan and zoom code removed for now, keeping it in case minds are changed
    // $(".portrait")
    // // tile mouse actions
    //   .on("mouseover", function() {
    //     $(this)
    //     $(".portrait-item")
    //       .css({ transform: "scale(" + $(this).attr("data-scale") + ")" });
    //   })
    //   .on("mouseout", function() {
    //     $(this)
    //     $(".portrait-item")
    //       .css({ transform: "scale(1)" });
    //   })
    //   .on("mousemove", function(e) {
    //     $(this)
    //     $(".portrait-item")
    //       .css({
    //         "transform-origin":
    //         ((e.pageX - $(this).offset().left) / $(this).width()) * 100 +
    //         "% " +
    //         ((e.pageY - $(this).offset().top) / $(this).height()) * 100 +
    //         "%"
    //       })
    //   });
    // var all = $(".portrait-item"),
    //   lightbox = $("#lightbox").get(0);
    //
    // if (all.length>0) { for (let i of all) {
    //   i.onclick = () => {
    //     let clone = i.cloneNode();
    //     clone.className = "test";
    //     lightbox.innerHTML = "";
    //     lightbox.appendChild(clone);
    //     lightbox.className = "show";
    //   };
    // }}
    // lightbox.onclick = () => {
    //   lightbox.className = "";
    // };
    // Close modal
    // $('.close-modal').click(function() {
    //   $('.modal').toggleClass('show')
    // });
    //
    // $('.modal-link').click(function(e){
    //   var modalContent = $('#modal-content');
    //   var post_link = $('show-in-modal').html();
    //
    //   e.preventDefault();
    //   //tester crap
    //   // alert('fire modal');
    //
    //   $('.modal').addClass('show', 1000, 'easeOutSine');
    //   modalContent.html('loading...');
    // });
  //finish modal later
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
    if (catSlug.indexOf('pre-owned') != -1) {
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
    var pageUrl = document.location.href;

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
          if (slug.indexOf('pre-owned') != -1 || catSlug.indexOf('pre-owned') != -1) {
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
          if (idObj != pageObj) {
            // defered again for now
            var newUri;
            var appendCat = '&product_cat=';
            var pushCat = '?product_cat=';

            if (window.location.href.indexOf("?terms=") >= -1) {
              newUri = pushCat + idObj;
              history.pushState({}, document.title, newUri);
            } else {
              if (idObj != '') {
                newUri = uri + appendCat + idObj;
                history.pushState({}, document.title, newUri);
              } else {
                newUri = uri + appendCat + pageObj;
                history.pushState({}, document.title, newUri);
              }
            }
          };
          // if (tagObj != ''){
          //   if (window.location.href.indexOf("?product_cat=") != -1){
          //     newUri = uri + '&terms=' + tagObj;
          //     history.pushState({}, document.title, newUri);
          //     alert('Terms not empty');
          //   } else {
          //     newUri = '?terms=' + tagObj;
          //     history.pushState({}, document.title, newUri);
          //     alert(newUri);
          //
          //   }
          // };
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