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
    navigateByKeyboard: true,
    arrows: true
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
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: true,
    centerPadding: '40px',
    speed: 300,
    autoplaySpeed: 5000,
    arrows: false,
    dots: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 5,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 920,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 690,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
        }
      }
    ]
  });

  $('.brand-carousel-mobile').slick({
    slidesToShow: 3,
    slidesToScroll: 3,
    autoplay: true,
    speed: 300,
    autoplaySpeed: 5000,
    arrows: false,
    dots: false,
    mobileFirst: true,
    lazyLoad: 'ondemand',
  });
}