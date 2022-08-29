jQuery(document).ready(function() {

  window.onscroll = function() {navStick()};

  var navbar = document.getElementById("navbar");
  var sticky = navbar.offsetTop;
  var win = jQuery(this);


  jQuery('.contactForm').css({
    "visibility": "hidden",
    "margin-top": "-150%"
  });


  jQuery(document).on('click', '.emailButton', function(e){
    jQuery('.contactForm').css({
      "visibility": "visible",
      "margin-top": "0"
    });
  });

    jQuery(window).on('resize', function(){
    if (win.width() <= 769 ){
      jQuery('.brands h3').hide();
      jQuery('.brands p').hide();
      jQuery((".brandCard")).removeClass("brands");
    }

    if (win.width() >= 769 ){
      jQuery('.brands h3').show();
      jQuery('.brands p').show();
      jQuery((".brandCard")).addClass("brands");
    };
  });

  function brandShuffle(){
    if ( win.width() < 769) {
      jQuery('.brands h3').hide();
      jQuery('.brands p').hide();
      jQuery((".brandCard")).removeClass("brands");
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
    //svg scope here
    input = jQuery('<form role="search" method="GET" id="searchform" class="searchform"><input name="s" value="" name="s" id="s" type="text"><button type="submit" class="searchFormButton">ok</button></form>');

    jQuery('.search a').replaceWith(input);
 });
  // //finish this later, or not at all depending on how rps wants to go forward, the animations are at least salvageable
  // jQuery(".form-set form:not(:first-child)").each(function(e) {
  //   if (e != 0)
  //     jQuery(this).hide();
  // });
  //
  // jQuery(".next").click(function() {
  //   if (jQuery(".form-set form:visible").next().length != 0)
  //     jQuery(".form-set form:visible").next().show().prev().hide();
  //   else {
  //     jQuery(".form-set form:visible").hide();
  //     jQuery(".form-set form:first").show();
  //   }
  //   return false;
  // });
  //
  // jQuery('#submit').click(function() {
  //   var data1 = jQuery('.form-1').serializeArray();
  //   var data2 = jQuery('.form-2').serializeArray();
  //   for(i in data1 ){
  //     console.log(data1[i]);
  //   }
  //   for(i in data2){
  //     console.log(data2[i]);
  //   }
  // });


  jQuery('.carousel').slick({
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    speed: 1000,
    autoplay: true,
    autoplaySpeed: 10000,
    lazyLoad: 'ondemand',
    // adaptiveHeight: true,
    mobileFirst: true,
    dots: true,
  });
  jQuery('.carousel-product').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    speed: 1000,
    autoplay: true,
    autoplaySpeed: 10000,
    lazyLoad: 'ondemand',
    adaptiveHeight: true,
    mobileFirst: true,
    dots: false,
  });


  jQuery('.close-modal').click(function() {
    jQuery('.modal').toggleClass('show');
  });
  // Close modal

  function close(){
  jQuery('.close-modal').click(function() {
    jQuery('.modal').toggleClass('show');
  });
  }

  function checkWidth() {
    var windowsize = jQuery(window.width());
    if (windowsize > 767) {
      // if the window is greater than 767px wide then do below. we don't want the modal to show on mobile devices and instead the link will be followed.

      jQuery(".modal-link").click(function(e) {
        var modalContent = jQuery("#modal-content");
        var post_link = jQuery('.show-in-modal').html(); // get content to show in modal
        //var post_link = $(this).attr("href"); // this can be used in WordPress and it will pull the content of the page in the href

        e.preventDefault(); // prevent link from being followed

        jQuery('.modal').addClass('show', 1000, "easeOutSine"); // show class to display the previously hidden modal
        modalContent.html("loading..."); // display loading animation or in this case static content
        modalContent.html(post_link); // for dynamic content, change this to use the load() function instead of html() -- like this: modalContent.load(post_link + ' #modal-ready')
        jQuery("html, body").animate({ // if you're below the fold this will animate and scroll to the modal
          scrollTop: 0
        }, "slow");
        return false;
      });
    }
  };

  checkWidth(); // excute function to check width on load
  jQuery(window).resize(checkWidth); // execute function to check width on resize
});