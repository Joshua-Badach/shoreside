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

  jQuery('.carousel').slick({
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    speed: 1000,
    autoplay: true,
    autoplaySpeed: 10000,
    // lazyLoad: 'ondemand',
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
  jQuery('.carousel-product-nav').slick({
    slidesToShow: 6,
    slidesToScroll:1,
    arrows: false,
    asNavFor: '.carousel-product',
    dots: false,
    centerMode: true,
    focusOnSelect: true,
  });

  // if ( jQuery('.carousel-product').length ) {
  //   var $slider = jQuery('.carousel-product')
  //     .on('init', function(slick) {
  //       jQuery('.carousel-product').fadeIn(1000);
  //     })
  //     .slick({
  //       slidesToShow: 1,
  //       slidesToScroll: 1,
  //       arrows: true,
  //       autoplay: true,
  //       lazyLoad: 'ondemand',
  //       autoplaySpeed: 3000,
  //       asNavFor: '.carousel-product-nav'
  //     });
  //
  //   var $slider2 = jQuery('.carousel-product-nav')
  //     .on('init', function(slick) {
  //       jQuery('.carousel-product-nav').fadeIn(1000);
  //     })
  //     .slick({
  //       slidesToShow: 4,
  //       slidesToScroll: 1,
  //       lazyLoad: 'ondemand',
  //       asNavFor: '.carousel-product',
  //       dots: false,
  //       centerMode: false,
  //       focusOnSelect: true
  //     });
  //
  //   //remove active class from all thumbnail slides
  //   jQuery('.carousel-product-nav .slick-slide').removeClass('slick-active');
  //
  //   //set active class to first thumbnail slides
  //   jQuery('.carousel-product-nav .slick-slide').eq(0).addClass('slick-active');
  //
  //   // On before slide change match active thumbnail to current slide
  //   jQuery('.carousel-product').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
  //     var mySlideNumber = nextSlide;
  //     jQuery('.carousel-product-nav .slick-slide').removeClass('slick-active');
  //     jQuery('.carousel-product-nav .slick-slide').eq(mySlideNumber).addClass('slick-active');
  //   });
  //
  //
  //   // init slider
  //   require(['js-sliderWithProgressbar'], function(slider) {
  //
  //     jQuery('.carousel-product').each(function() {
  //
  //       me.slider = new slider(jQuery(this), options, sliderOptions, previewSliderOptions);
  //
  //       // stop slider
  //       //me.slider.stop();
  //
  //       // start slider
  //       //me.slider.start(index);
  //
  //       // get reference to slick slider
  //       //me.slider.getSlick();
  //
  //     });
  //   });
  //   var options = {
  //     progressbarSelector    : '.bJS_progressbar'
  //     , slideSelector        : '.bJS_slider'
  //     , previewSlideSelector : '.bJS_previewSlider'
  //     , progressInterval     : ''
  //     // add your own progressbar animation function to sync it i.e. with a video
  //     // function will be called if the current preview slider item (".b_previewItem") has the data-customprogressbar="true" property set
  //     , onCustomProgressbar : function($slide, $progressbar) {}
  //   }
  //
  //   // slick slider options
  //   // see: https://kenwheeler.github.io/slick/
  //   var sliderOptions = {
  //     slidesToShow   : 1,
  //     slidesToScroll : 1,
  //     arrows         : false,
  //     fade           : true,
  //     autoplay       : true
  //   }
  //
  //   // slick slider options
  //   // see: https://kenwheeler.github.io/slick/
  //   var previewSliderOptions = {
  //     slidesToShow   : 3,
  //     slidesToScroll : 1,
  //     dots           : false,
  //     focusOnSelect  : true,
  //     centerMode     : true
  //   }
  // }

  checkWidth(); // excute function to check width on load
  jQuery(window).resize(checkWidth); // execute function to check width on resize
});