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
      infinite: true,
      speed: 300,
      autoplay: false,
      autoplaySpeed: 10000,
    });
  });
</script>

<!--think on how I want to implement this-->
<script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>