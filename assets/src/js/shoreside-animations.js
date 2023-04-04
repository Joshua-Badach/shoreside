export function shoresideAnimations(){

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
}