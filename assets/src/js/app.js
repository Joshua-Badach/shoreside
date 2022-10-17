jQuery(document).ready(function($) {

  window.onscroll = function() {navStick()};

  var navbar = document.getElementById("navbar");
  var sticky = navbar.offsetTop;
  var win = jQuery(this);

  jQuery(".contactform").hide();

  jQuery(".emailButton").click(function(){
    jQuery(".contactForm").toggle();
  });

    jQuery(window).on('resize', function(){
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

  jQuery(window).resize(brandShuffle());

  function navStick() {
    if (window.pageYOffset >= sticky) {
      navbar.classList.add("sticky")
    } else {
      navbar.classList.remove("sticky");
    }
  }

  jQuery(document).on('click', '.search', function(event){
    input = jQuery('<form role="search" method="GET" id="searchform" class="searchform"><input name="s" value="" name="s" id="s" type="text"><button type="submit" class="searchFormButton">ok</button></form>');

    jQuery('.search a').replaceWith(input);
 });

  // Slider carousel code
  jQuery('.carousel').slick({
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
  jQuery('.carousel-product').slick({
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
  jQuery('.carousel-product-nav').slick({
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
    $('#sidebar').css({
      'border-right':'1px solid #d3d3d3',
      'border-bottom':'1px solid #d3d3d3',
    });
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

  //refine later, check if ?filters= exists, if unique filter - append, if same filter - replace

  var pageUrl = document.location.href;
  var saleText = $('.on_sale');
  var conditionText = $('.condition');



//filter preowned switch
  $(document).on('click','.conditionInput', function(){
    var preOwned = $('.conditionInput').val();
    if ($('.conditionInput').prop('checked') == true){
      // window.history.replaceState(null, null, preOwned);
      $(conditionText).text('Used')
    }
    else {
      //refine this later, good enough for now
      // window.history.pushState({}, "", pageUrl.split("?")[0]);
      $(conditionText).text('New')
    }
  });
  //filter on sale switch
  $(document).on('click','.saleInput', function(){
    var sale = $('.saleInput').val();
    if ($('.saleInput').prop('checked') == true){
      // window.history.replaceState(null, null, sale);
      $(saleText).text('Yes')
    }
    else {
      //refine this later, good enough for now
      // window.history.pushState({}, "", pageUrl.split("?")[0]);
      $(saleText).text('No')
    }
  });

  if(pageUrl.indexOf('on_sale=sale') != -1 ) {
    $('input:checkbox[name="sale"]').prop('checked', true);
    $(saleText).text('Yes')
  }
  //hardcoded product cat for now
  if(pageUrl.indexOf('product_cat=pre-owned') != -1 ) {
    // $('input:checkbox[name="condition"]').prop('checked', true);
    $(conditionText).text('Used')
  }

  //filter prevent default, clear url state
  $(document).on('click', '#clear', function(){
    window.history.pushState({}, "", pageUrl.split("?")[0]);
    location.reload();
  });

  //hide sidebar links if over 5, modularize if more attributes are needed
  //clean this up later, lazy but I'm on a time crunch

  if( $('#categories').children().length > 5) {
    if (pageUrl.indexOf('product_cat') > -1) {
      $('.showCategories').toggleClass('sidebarIconAnimate90');
      $('#categories a').show();
      $('#categories').toggleClass('objectPadding');
    } else {
      $('#categories a').hide();
    }
  } else {
    $('#categories').addClass('objectPadding');
  }

  $('.showCategories').on('click', function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    $('#categories a').toggle();
    $('#categories').toggleClass('objectPadding');
    $('.showCategories').toggleClass('sidebarIconAnimate90');
  });

  if( $('#attributes').children().length > 5) {
    if (pageUrl.indexOf('product_tag') > -1) {
      $('.showAttributes').toggleClass('sidebarIconAnimate90');
      $('#attributes a').show();
      $('#attributes').toggleClass('objectPadding');
    } else {
      $('#attributes a').hide();
    }
  } else {
    $('#attributes').addClass('objectPadding');
  }

  $('.showAttributes').on('click', function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    $('#attributes a').toggle();
    $('#attributes').toggleClass('objectPadding');
    $('.showAttributes').toggleClass('sidebarIconAnimate90');
  });

  if(pageUrl.indexOf('?') == -1 ){
    $('.clearButton').hide();
  }

  //hidenslide
  $('#sidebarIcon').on('click', function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    $('#sidebar').toggle(500);
    $('#sidebar').css({
        "-webkit-box-shadow": "5px 5px 7px 5px #000000",
        "box-shadow": "5px 5px 7px 5px #000000",
    });
    $('#sidebarIcon img').toggleClass('sidebarIconAnimate');
    $('#sidebarContainer').css({
        "position":"absolute",
        "width": "50%"
    });
  });

  //Sidebar ajax queries
  //Clean this up
  $(document).on('click', '#categories a', function() {
    var idObj = $(this).data('value');
    var ajaxUrl = window.location.origin + "/wp-admin/admin-ajax.php";
    function result(idObj){
      // idObj = $(this).data('value');
      console.log("idObj is: ", idObj);
    }

    $.ajax({
      url: ajaxUrl,
      dataType: 'html',
      data: {
        type: 'POST',
        idObj: idObj,
        action: 'load_results',
      },
      success: function (response) {
        $('#contentTrigger').replaceWith(response);
        result(idObj);
      },
      error: function (response) {
        console.log(response);
      }
    })
    return idObj;
  });

    $(document).on('click', '#attributes a', function(){
      var idObj = $(this).data('category');
      var tagObj = $(this).data('value');
      var attribute = 'manufacturer';
      var ajaxUrl = window.location.origin + "/wp-admin/admin-ajax.php";

      $.ajax({
        url:            ajaxUrl,
        dataType:       'html',
        data: {
          type:       'POST',
          idObj:      idObj,
          tagObj:     tagObj,
          attribute:  attribute,
          action:     'load_results',
        },
        success: function (response) {
          $('#contentTrigger').replaceWith( response );
        },
        error: function (response) {
          console.log(response);
        }
      })
    });

    $(document).on('click', `.conditionInput`, function(){
      var idObj = $(this).data('value');
      var ajaxUrl = window.location.origin + "/wp-admin/admin-ajax.php";
      $.ajax({
        url:            ajaxUrl,
        dataType:       'html',
        data: {
          type:       'POST',
          idObj:      idObj,
          action:     'load_results'
        },
        success: function (response) {
          $('#contentTrigger').replaceWith( response );
        },
        error: function (response) {
          console.log(response);
        }
      })
    });

  $(document).on('click', `.saleInput`, function(){
    var idObj = $(this).data('category');
    var onSaleObj = $(this).data('value');
    var ajaxUrl = window.location.origin + "/wp-admin/admin-ajax.php";
    $.ajax({
      url:            ajaxUrl,
      dataType:       'html',
      data: {
        type:         'POST',
        idObj:        idObj,
        onSaleObj:    onSaleObj,
        action:       'load_results'
      },
      success: function (response) {
        $('#contentTrigger').replaceWith( response );
      },
      error: function (response) {
        console.log(response);
      }
    })
  });

  $(document).on('click', '#asc', function(){
    var idObj = $(this).data('category');
    var orderByOjb = $(this).data('value');
    var ajaxUrl = window.location.origin + "/wp-admin/admin-ajax.php";

    $.ajax({
      url:            ajaxUrl,
      dataType:       'html',
      data: {
        type:         'POST',
        idObj:        idObj,
        orderByObj:   orderByOjb,
        action:       'load_results'
      },
      success: function (response) {
        $('#contentTrigger').replaceWith( response );
      },
      error: function (response) {
        console.log(response);
      }
    })
  });

  $(document).on('click', '#desc', function(){
    var idObj = $(this).data('category');
    var orderByOjb = $(this).data('value');
    var ajaxUrl = window.location.origin + "/wp-admin/admin-ajax.php";

    $.ajax({
      url:            ajaxUrl,
      dataType:       'html',
      data: {
        type:         'POST',
        idObj:        idObj,
        orderByObj:   orderByOjb,
        action:       'load_results'
      },
      success: function (response) {
        $('#contentTrigger').replaceWith( response );
      },
      error: function (response) {
        console.log(response);
      }
    })
  });

  checkWidth();
  $(window).resize(checkWidth);

});