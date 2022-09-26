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
    $('#contentTrigger').removeClass('content');
    // $('.select2-container').removeAttr('style').css('z-index', '100');

  } else {
    $('#mobileFilter').hide();
    // Pan and zoom code
    $(".portrait")
    // tile mouse actions
      .on("mouseover", function() {
        $(this)
        $(".portrait-item")
          .css({ transform: "scale(" + $(this).attr("data-scale") + ")" });
      })
      .on("mouseout", function() {
        $(this)
        $(".portrait-item")
          .css({ transform: "scale(1)" });
      })
      .on("mousemove", function(e) {
        $(this)
        $(".portrait-item")
          .css({
            "transform-origin":
            ((e.pageX - $(this).offset().left) / $(this).width()) * 100 +
            "% " +
            ((e.pageY - $(this).offset().top) / $(this).height()) * 100 +
            "%"
          })
      });
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
  //
  // $("#some_id").click( function(e) {
  //   e.preventDefault();
  //
  //   $.ajax({
  //     type : "post",
  //     dataType : "json",
  //     url : OBJ.ajaxurl,
  //     data : {
  //       action: "my_ajax_action"
  //     },
  //     success: function(response) {
  //       if( response.type == "success" ) {
  //         'it worked'
  //       }
  //       else {
  //         'nope'
  //       }
  //     }
  //   });
  // });

  setTimeout(function(){
    $('#prompt-CWnFXGNPWNYNiMFgwS5X-iframe').fadeOut('slow');
  }, 10000 );


  // $('.load_results').click( function(e){
  //   e.preventDefault();
  //   ajax_next_posts()
  //   $('body').addClass('ajaxLoading');
  // });
  //
  // var ajaxLock = false; // ajaxLock is just a flag to prevent double clicks and spamming
  //
  // if( !ajaxLock ) {
  //
  //   function ajax_next_posts() {
  //
  //     ajaxLock = true;
  //
  //     // How many posts there's total
  //     var totalPosts = parseInt( jQuery( '#found-posts' ).text() );
  //
  //     // How many have been loaded
  //     var postOffset = jQuery( 'li.product' ).length
  //
  //     // How many do you want to load in single patch
  //     var postsPerPage = 1;
  //
  //     var ajaxUrl = $(this).data('url');
  //
  //
  //     // Ajax call itself
  //     $.ajax({
  //       method: 'POST',
  //       url: ajaxUrl,
  //       data: {
  //         action: 'ajax_next_posts',
  //         post_offset: postOffset,
  //         posts_per_page: postsPerPage,
  //         // product_cat: cat_id
  //       },
  //       dataType: 'json'
  //     })
  //       .done( function( response ) { // Ajax call is successful
  //         // console.log( response );
  //
  //         // Add new posts
  //         jQuery( '.content' ).append( response[0] );
  //
  //         // Log SQL query
  //         jQuery( '#query > pre' ).text( response[2] );
  //
  //         // Update the count of total posts
  //         // jQuery( '#found-posts' ).text( response[1] );
  //
  //         ajaxLock = false;
  //
  //         console.log( 'Success' );
  //
  //         $('body').removeClass('ajaxLoading');
  //
  //         // How many posts there's total
  //         var totalPosts = parseInt( jQuery( '#found-posts' ).text() );
  //         console.log( "Total Posts: " + totalPosts );
  //
  //         // How many have been loaded
  //         var postOffset = jQuery( 'li.product' ).length
  //         console.log( "Posts currently showing: " + postOffset );
  //
  //         // Hide button if all posts are loaded
  //         if( totalPosts < postOffset + ( 1 * postsPerPage ) ) {
  //           jQuery( '.load_results' ).fadeOut();
  //         }
  //
  //       })
  //       // .fail( function() {
  //       .fail( function(jqXHR, textStatus, errorThrown) { // Ajax call is not successful, still remove lock in order to try again
  //
  //         ajaxLock = false;
  //
  //         console.log(XMLHttpRequest);
  //         console.log(textStatus);
  //         console.log(errorThrown);
  //
  //         console.log( 'Failed' );
  //
  //       });
  //   }
  // }
  //

  //refine later, check if ?filters= exists, if unique filter - append, if same filter - replace

  var pageUrl = document.location.href;

//filter preowned switch
  $(document).on('click','.conditionInput', function(){
    var preOwned = $('.conditionInput').val();
    var conditionText = $('.condition');
    if ($('.conditionInput').prop('checked') == true){
      window.history.replaceState(null, null, preOwned);
      $(conditionText).text('Used')
      location.reload();
    //  remove reload crap after ajax, leave selected after reload
    }
    else {
      //reine this later, good enough for now
      window.history.pushState({}, "", pageUrl.split("?")[0]);
      $(conditionText).text('New')
      location.reload();
    }
  });
  //filter on sale switch
  $(document).on('click','.saleInput', function(){
    var sale = $('.saleInput').val();
    var saleText = $('.on-sale');
    if ($('.saleInput').prop('checked') == true){
      window.history.replaceState(null, null, sale);
      $(saleText).text('Yes')
      location.reload();
      //  remove reload crap after ajax, leave selected after reload
    }
    else {
      //reine this later, good enough for now
      window.history.pushState({}, "", pageUrl.split("?")[0]);
      $(saleText).text('No')
      location.reload();
    }
  });

  //filter prevent default, pass value to url
  $(document).on('click', '#sidebar a', function(){
    var filter = $(this).attr('href');
    window.history.replaceState(null, null, filter);
  });

  //filter prevent default, clear url state
  $(document).on('click', '#clear', function(){
    // e.preventDefault();
    window.history.pushState({}, "", pageUrl.split("?")[0]);
    location.reload();
  });

  // $('.content').filter(function(){
    //
    // });

    // $.ajax({
    //   type : 'get',
    //   url : pageUrl,
    //   success : function(data) {
    //     $("body")
    //   },
    // });


  $(document).on('click', '.load_results', function(){
    var that = $(this);
    var page = $(this).data('page');
    var newPage = page++;
    var ajaxUrl = $(this).data('url');

    $.ajax({

      url : ajaxUrl,
      type : 'post',
      data : {
        action : 'load_results'
      },
      error : function( response ){
        console.log( response );
      },
      success : function( response ){
        $('.content').append( response )
      },
    });
  });

  checkWidth();
  $(window).resize(checkWidth);

});