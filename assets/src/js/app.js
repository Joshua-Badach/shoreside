jQuery(document).ready(function() {

  window.onscroll = function() {navStick()};

  var navbar = document.getElementById("navbar");
  var sticky = navbar.offsetTop;
  // var promptContainer = document.getElementsByClassName(".promptContainer");
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
    lazyLoad: 'ondemand',
    // adaptiveHeight: true,
    mobileFirst: true,
    dots: true,
  });
  jQuery('.carousel-product').slick({
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    lazyLoad: 'ondemand',
    autoplaySpeed: 20000,
    fade: true,
    asNavFor: '.carousel-product-nav',
    adaptiveHeight: true,
    mobileFirst: true,
    dots: false,
  });
  jQuery('.carousel-product-nav').slick({
    slidesToShow: 5,
    slidesToScroll:1,
    speed: 2000,
    arrows: false,
    asNavFor: '.carousel-product',
    dots: false,
    centerMode: true,
    focusOnSelect: true,
  });
  // Pan and zoom code
  // var addZoom = (target) => {
  //   let container = document.getElementById(target),
  //     imgsrc = container.currentStyle || window.getComputedStyle(container, false);
  //     imgsrc = imgsrc.backgroundImage.slice(4, -1).replace(/"/g, "");
  //
  //     let img = new Image();
  //     img.src = imgsrc;
  //     img.onload = () => {
  //     let ratio = img.naturalHeight / img.naturalWidth,
  //       percentage = ratio * 100 + "%";
  //
  //
  // };


  //Fix this later
  //Hide the prompt container on mobile
  // var mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
  // if (mobile) {
  //   promptContainer.classList.add("hidden")
  // } else {
  //   alert("NOT A MOBILE DEVICE!!");
  // }

  checkWidth(); // excute function to check width on load
  jQuery(window).resize(checkWidth); // execute function to check width on resize
});