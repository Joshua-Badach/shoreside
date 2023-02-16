export function carousel() {
  // Slider carousel code

  //Portrait carousel code
  $('.carousel-product').slick({
    slidesToShow: 1,
    autoplay: true,
    speed: 500,
    autoplaySpeed: 10000,
    arrows: false,
    fade: false,
    asNavFor: '.carousel-product-nav',
    adaptiveHeight: true,
    mobileFirst: true,
    dots: false,
    infinite: true,
    lazyLoad: 'ondemand',
  });
  $('.carousel-product-nav').slick({
    slidesToShow: 4,
    speed: 500,
    arrows: false,
    asNavFor: '.carousel-product',
    dots: false,
    mobileFirst: true,
    focusOnSelect: true,
    lazyLoad: 'ondemand',
  });
  $('.carousel-product').slickLightbox({
    itemSelector: 'a',
    navigateByKeyboard: true
  });

  $('.mainCarousel').slick({
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    speed: 1000,
    autoplay: true,
    autoplaySpeed: 10000,
    mobileFirst: true,
    dots: false,
    arrows: false,
    lazyLoad: false,
  });

  $('.brand-carousel').slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    autoplay: true,
    speed: 300,
    autoplaySpeed: 10000,
    arrows: false,
    dots: false,
    mobileFirst: false,
    lazyLoad: 'ondemand',
  });
}