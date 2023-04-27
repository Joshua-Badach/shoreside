
var mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));


export function sidebar() {
  var pageUrl = document.location.href;
  var pageObj = $('#contentTrigger').data('page');
  var slug = $('#contentTrigger').data('slug');
  var catSlug = $('.display').data('parent');
  var uri = window.location.toString();
  var clear_uri = uri.substring(0, uri.lastIndexOf('/') + 1);

  $('#sidebar hr').hide();
  $('#clear').hide();

  // switch to an on click event
  //Filter switch toggles
  if (catSlug.indexOf('preowned') != -1) {
    $('.conditionInput').attr('data-category', pageObj);
    $('.conditionInput').attr('data-slug', slug);
  }
  //
  // if (slug.indexOf('preowned') !== -1 || catSlug.indexOf('preowned') !== -1) {
  //   $('.conditionInput').attr('data-category', pageObj);
  //   $('.conditionInput').attr('data-slug', slugObj);
  // } else {
  //   $('.conditionInput').prop('checked', false);
  //   $('#conditionInput').attr('category', pageObj);
  //   $('#conditionInput').attr('slug', slug);
  //   window.history.replaceState({}, document.title, clear_uri);
  // };

  //Show sale toggle if user is in showroom
  // if (pageUrl.indexOf('showroom') == -1) {
  //   $('#showroomToggle').hide();
  // }

  //Prevent defaults for filter heading dropdowns
  $('#contentTrigger .filterHeading').on('click', 'a', function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();
  });

  //Hide filters on load if mobile
  if (!mobile) {
    $('.showCategories img').toggleClass('sidebarIconAnimate90');
    $('#categories a').show();
  } else {
    $('#categories a').hide();

  }
  //Hide filters on load if more than 5 children
  if ($('#attributes').children().length >= 5) {
    $('#attributes a').hide();
  } else {
    $('.showAttributes img').toggleClass('sidebarIconAnimate90');
    $('#attributes a').show();
  }

  // Hide tabs if empty
  if ($('#categories').children().length == 0) {
    $('#categoryTab').hide();
  }
  if ($('#attributes').children().length == 0) {
    $('#attributeTab').hide();
  }

  //Animate filtering arrow on click, show links
  $('.showCategories').on('click', function () {
    $('#categories a').toggle();
    $('.showCategories img').toggleClass('sidebarIconAnimate90');
  });

  $('.showAttributes').on('click', function () {
    $('#attributes a').toggle();
    $('.showAttributes img').toggleClass('sidebarIconAnimate90');
  });

  //Hidenslide for mobile filter
  if (mobile) {
    $('#sidebarContainer').hide();
    $('#sidebarIcon').on('click', function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();
      $('#sidebarContainer').toggle(500);
      $('#sidebarIcon img').toggleClass('sidebarIconAnimate');

      // if (mobile) {
        $('#sidebarContainer').css('position', 'absolute');
      // }
    });
  } else {
    $('#sidebarIcon img, #mobileFilter a').hide();
    $('#mobileFilter').css('height', '30px');
    $('#sidebarContainer').css('display', 'block');
  }

  if (pageUrl.indexOf('/?') != -1) {
    $('#clear').show();
    $('#sidebar hr').show();
  }

  $('#clear').on('click', function(){
    $(this).data('category', pageObj);
    $(this).data('attribute', '');
    $(this).data('term', '');
    $(this).data('orderby', '');
    $(this).data('slug', slug);
    $(this).data('sale', '');
    $('.display').data('parent', '');
    window.history.replaceState({}, document.title, clear_uri);
  });
};
