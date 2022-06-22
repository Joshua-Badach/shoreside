<!--footer scripts-->
<script>
  window.onscroll = function() {navStick()};

  var navbar = document.getElementById("navbar");
  var sticky = navbar.offsetTop;

  function navStick() {
    if (window.pageYOffset >= sticky) {
      navbar.classList.add("sticky")
    } else {
      navbar.classList.remove("sticky");
    }
  }
</script>
<script>
  jQuery(document).ready(function(){
    jQuery('.carousel').slick({
      infinite: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      speed: 1000,
      autoplay: true,
      autoplaySpeed: 10000,
      dots: true,
    });
  });
</script>
<script>
    jQuery(document).ready(function(jQuery) {
      jQuery('.close-modal').click(function() {
        jQuery('.modal').toggleClass('show');
      });
    });
</script>
