import {sidebar} from "./sidebar";

window.LoadResultsPayload = {
  type: 'POST',
  action: 'load_results',
};
window.modalPayload = {
  type: 'POST',
  action: 'load_product',
};

var mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));


export function sidebarAjax(){

  $(document).on('click', '#sidebar a, #sidebar input, #sidebar button', function() {

    var idObj = $(this).data('category');
    var attribute = $(this).data('attribute');
    var tagObj = $(this).data('term');
    var orderByOjb = $(this).data('order');
    var onSaleObj = $(this).data('sale');
    var slug = $(this).data('slug');
    var catSlug = $('.display').data('parent');


    var pageObj = $('#contentTrigger').data('page');
    var slugObj = $('#contentTrigger').data('slug');
    var ajaxUrl = window.location.origin + "/wp-admin/admin-ajax.php";
    window.LoadResultsPayload.idObj = idObj;
    window.LoadResultsPayload.pageObj = pageObj;
    window.LoadResultsPayload.attribute = attribute;
    window.LoadResultsPayload.tagObj = tagObj;
    window.LoadResultsPayload.orderByOjb = orderByOjb;
    window.LoadResultsPayload.onSaleObj = onSaleObj;
    window.LoadResultsPayload.slug = slug;
    window.LoadResultsPayload.catSlug = catSlug;

    $.ajax({
      url: ajaxUrl,
      dataType: 'html',
      data: window.LoadResultsPayload,
      success: function (response) {
        $('#contentTrigger').html(response);

        $(sidebar);
        if (slug.indexOf('preowned') != -1 || catSlug.indexOf('preowned') != -1) {
          $('.conditionInput').prop('checked', true);
          $('.conditionInput').attr('data-category', pageObj);
          $('.conditionInput').attr('data-slug', slugObj);
        } else {
          $('.conditionInput').prop('checked', false);
          $('#conditionInput').attr('category', idObj);
          $('#conditionInput').attr('slug', slug);
          var uri = window.location.toString();
          var clear_uri = uri.substring(0, uri.indexOf("?"));
          window.history.pushState({}, document.title, clear_uri);
        };
        if (onSaleObj == true) {
          $('.saleInput').prop('checked', true);
          $('.saleInput').attr('data-sale', false);
        };
        var newUri;
        var pushCat = '?product_cat=';
        var appendTerm = '&term=';
        var pushTerm = '?term=';

        if (idObj != pageObj && idObj != '') {
          if (idObj != '' && tagObj == '') {
            newUri = pushCat + idObj;
            window.history.pushState({}, document.title, newUri);
          };
          if (idObj != '' && tagObj != ''){
            newUri = pushCat + idObj + appendTerm + tagObj;
            window.history.pushState({}, document.title, newUri);
          };
        } else {
          if (tagObj != '') {
            newUri = pushTerm + tagObj;
            window.history.pushState({}, document.title, newUri);
          };
        };
        if (mobile) {
          $('#sidebarContainer').css('position', 'absolute');
        };
        if (tagObj != ''){
          $('#categoryTab').hide();
        };
        if (idObj != pageObj || tagObj != ''){
          $('#clear').show();
          $('#sidebar hr').show();
        } else {
          $('#clear').hide();
          $('#sidebar hr').hide();
        }
      },
      error: function (response) {
        console.log(response);
      }
    });
  });
}