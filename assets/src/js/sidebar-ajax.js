import {sidebar} from "./sidebar";


window.LoadResultsPayload = {
  type: 'POST',
  action: 'load_results',
};

const mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));


export function sidebarAjax(){

  $(document).on('click', '#sidebar a, #sidebar input, #sidebar button', function() {

    const idObj = $(this).data('category');
    const attribute = $(this).data('attribute');
    const tagObj = $(this).data('term');
    const orderByOjb = $(this).data('order');
    const onSaleObj = $(this).data('sale');
    const slug = $(this).data('slug');
    const catSlug = $('.display').data('parent');
    const pageObj = $('#contentTrigger').data('page');
    const slugObj = $('#contentTrigger').data('slug');

    const ajaxUrl = window.location.origin + "/wp-admin/admin-ajax.php";
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
        let newUri;
        let pushCat = '?product_cat=';
        let appendTerm = '&term=';
        let pushTerm = '?term=';
        let uri = window.location.toString();
        let clear_uri = uri.substring(0, uri.indexOf("?"));
      // || catSlug.indexOf('preowned') != -1
        if (slug.indexOf('preowned') !== -1) {
          $('.conditionInput').prop('checked', true);
          $('.conditionInput').attr('data-category', idObj);
          $('.conditionInput').attr('data-slug', slugObj);
          window.history.pushState({}, document.title, pushCat + idObj);
        } else {
          $('.conditionInput').prop('checked', false);
          $('#conditionInput').attr('category', pageObj);
          $('#conditionInput').attr('slug', slug);
          window.history.pushState({}, document.title, clear_uri);
        };
        if (onSaleObj == true) {
          $('.saleInput').prop('checked', true);
          $('.saleInput').attr('data-sale', false);
        };

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