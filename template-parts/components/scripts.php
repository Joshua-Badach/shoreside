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
      speed: 1000,
      autoplay: true,
      autoplaySpeed: 10000,
      // dots: true,
    //  Tweak the dots later, for some reason there are duplicates rendering
    //  slickGoTo doesn't work within afterChange, hash out way to return to slide 1 at the end later
    });
  });
</script>
