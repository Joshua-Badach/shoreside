jQuery(document).ready(function() {

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
    autoplaySpeed: 15000,
    fade: true,
    asNavFor: '.carousel-product-nav',
    adaptiveHeight: true,
    mobileFirst: true,
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
  // Pan and zoom code

  //Mobile check
  var mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
  if (mobile) {
    $('.slick-arrow').delay(10000).fadeOut('slow');
  }

  setTimeout(function(){
    $('#prompt-CWnFXGNPWNYNiMFgwS5X-iframe').fadeOut('slow');
  }, 10000 );

  checkWidth();
  jQuery(window).resize(checkWidth);
});