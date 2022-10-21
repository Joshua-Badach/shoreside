jQuery(document).ready(function($) {

  window.LoadResultsPayload = {
    type: 'POST',
    action: 'load_results',
  };

  window.onscroll = function() {navStick()};

  var navbar = document.getElementById("navbar");
  var sticky = navbar.offsetTop;
  var win = $(this);

  $(".contactform").hide();

  $(".emailButton").click(function(){
    $(".contactForm").toggle();
  });

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
    lazyLoad: 'ondemand',
    mobileFirst: true,
    dots: true,
  });

  //Portrait carousel code
  $('.carousel-product').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    lazyLoad: 'ondemand',
    speed: 1000,
    autoplaySpeed: 10000,
    fade: true,
    asNavFor: '.carousel-product-nav',
    adaptiveHeight: true,
    // mobileFirst: true,
    dots: false,
  });
  $('.carousel-product-nav').slick({
    slidesToShow: 3,
    slidesToScroll:1,
    speed: 1000,
    arrows: false,
    asNavFor: '.carousel-product',
    dots: false,
    centerMode: true,
    focusOnSelect: true,
  });


  //Mobile check
  var mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
  if (mobile) {
    $('.slick-arrow').delay(10000).fadeOut('slow');
    $('#sidebar').hide();
    $('#mobileFilter').show();
    $('#contentTrigger').removeClass('content');
    $('#sidebarHeader').hide();
    // $('.select2-container').removeAttr('style').css('z-index', '100');

  } else {
    $('#sidebarIcon').hide();
    $('#sidebarHeader').show();
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

    //Filter switch toggles
    if (pageUrl.indexOf('product_cat=pre-owned') != -1) {
      $('input:checkbox[name="condition"]').prop('checked', true);
    }
    $(document).on('click', '.conditionInput', function () {
      if ($('.conditionInput').prop('checked') == true) {
      }
    });
    if (pageUrl.indexOf('on_sale=true') != -1) {
      $('input:checkbox[name="sale"]').prop('checked', true);
    }
    $(document).on('click', '.saleInput', function () {
      if ($('.saleInput').prop('checked') == true) {
      }
    });

    //filter prevent default, clear url state
    //handle this via ajax later
    $(document).on('click', '#clear', function () {
      window.history.pushState({}, "", pageUrl.split("?")[0]);
      location.reload();
    });

    //Show sale toggle if user is in showroom
    if (pageUrl.indexOf('showroom') == -1) {
      $('#showroomToggle').hide();
    }

    //Prevent defaults for filter heading dropdowns
      $('#contentTrigger .filterHeading').on('click', 'a', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
      });

    //Hide filters on load if more than 5 children, push state to url, check if state exists if so expand filter

    if ($('#categories').children().length >= 5) {
      if (pageUrl.indexOf('product_cat') > -1) {
        $('.showCategories img').toggleClass('sidebarIconAnimate90');
        $('#categories a').show();
      } else {
        $('#categories a').hide();
      }
    }
    if ($('#categories').children().length == 0) {
      $('#categoryTab').hide();
    }
    if ($('#attributes').children().length >= 5) {
        if (pageUrl.indexOf('product_tag') > -1) {
          $('.showAttributes img').toggleClass('sidebarIconAnimate90');
          $('#attributes a').show();
        } else {
          $('#attributes a').hide();
        }
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

    if (pageUrl.indexOf('?') == -1) {
      $('.clearButton').hide();
    }



    //Hidenslide for mobile filter
    $('#sidebarIcon').on('click', function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();
      $('#sidebar').toggle(500);
      $('#sidebar').css({
        "-webkit-box-shadow": "5px 5px 7px 5px #000000",
        "box-shadow": "5px 5px 7px 5px #000000",
      });
      $('#sidebarIcon img').toggleClass('sidebarIconAnimate');
      $('#sidebarContainer').css({
        "position": "absolute",
        "width": "50%"
      });
    });
  }

  sidebar();
  //Sidebar ajax queries
  //Clean this up

  $(document).on('click', '#sidebar a, #sidebar input', function() {
    var idObj = $(this).data('category');
    var attribute = $(this).data('attribute');
    var tagObj = $(this).data('term');
    var orderByOjb = $(this).data('orderby');
    var onSaleObj = $(this).data('sale');

    var ajaxUrl = window.location.origin + "/wp-admin/admin-ajax.php";

    window.LoadResultsPayload.idObj = idObj;
    window.LoadResultsPayload.attribute = attribute;
    window.LoadResultsPayload.tagObj = tagObj;
    window.LoadResultsPayload.orderByOjb = orderByOjb;
    window.LoadResultsPayload.onSaleObj = onSaleObj;


    $.ajax({
      url: ajaxUrl,
      dataType: 'html',
      data: window.LoadResultsPayload,

      success: function (response) {
        $('#contentTrigger').html(response);
        sidebar();
        if (idObj == 'pre-owned'){
          $('.conditionInput').prop('checked', true);
        };
        if (onSaleObj == true){
          $('.saleInput').prop('checked', true);
        };
        //Filter push url state
        // $(document).on('click', '#categories a', function() {
        //   window.history.pushState({}, "?product_cat=" + idObj, pageUrl);
        // });
      },
      error: function (response) {
        console.log(response);
      }
    });
    return idObj, attribute, tagObj, orderByOjb, onSaleObj;
  });

  checkWidth();
  $(window).resize(checkWidth);

});