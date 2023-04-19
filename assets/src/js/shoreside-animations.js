export function shoresideAnimations(){

    const mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));

    $('.jobPost').hover(function(){
        $(this).find('.jobDescription').fadeIn();
        $(this).find('img').addClass('zoom');
    }, function(){
        $(this).find('.jobDescription').fadeOut();
        $(this).find('img').removeClass('zoom');
    });

    $('.categoryItems').hover(function(){
        $(this).find('img').addClass('zoom');
    }, function(){
        $(this).find('img').removeClass('zoom');
    });

    //Loading screen
    $('#loading').fadeOut();

    $(document).ajaxStart(function(){
        $('#loading').fadeIn();
    });
    $(document).ajaxStop(function(){
        $('#loading').fadeOut();
    });

    if(!mobile) {
        $('#brandContent .product').on({
            mouseenter: function () {
                $(this).find('.shoreside-product-title').fadeIn();
            },
            mouseleave: function () {
                $(this).find('.shoreside-product-title').fadeOut();
            },
        });
    }
    $('#videoTab').click(function(){
        $(this).show( { direction: "left" }, 1000);
        $('#videoSlider').toggle( { direction: "left" }, 1000);
    });
}