jQuery(document).ready(function() {

  window.onscroll = function() {navStick()};

  var navbar = document.getElementById("navbar");
  var sticky = navbar.offsetTop;
  var $window = jQuery(window);
  var brandSpan = jQuery((".brandSpan"));
  var win = jQuery(this);


  jQuery(window).on('resize', function(){
    if (win.width() <= 769 ){
      jQuery('.brands h3').hide();
      jQuery('.brands p').hide();
    }
    if (win.width() >= 769 ){
      jQuery('.brands h3').show();
      jQuery('.brands p').show();
    };
  });

  function brandShuffle(){
    var windowsize = $window.width();
    if ( win.width() < 769) {
      jQuery('.brands h3').hide();
      jQuery('.brands p').hide();
      // jQuery('.brandsContent').hide();
      // jQuery((".test")).removeClass("brands");
      // brandSpan.classList.removeClass("brands");
    }
    if (windowsize > 769 ){

      // jQuery('.brandsContent').show();
      // jQuery((".test")).addClass("brands");
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


  jQuery('.carousel').slick({
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    speed: 1000,
    autoplay: true,
    autoplaySpeed: 10000,
    dots: true,
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
    var windowsize = $window.width();
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