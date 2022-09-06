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

  checkWidth(); // excute function to check width on load
  jQuery(window).resize(checkWidth); // execute function to check width on resize
});