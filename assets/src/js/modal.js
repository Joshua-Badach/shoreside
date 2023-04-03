// window.modalPayload = {
//     type: 'POST',
//     action: 'load_job',
// };
//
// var mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
//
// export function modalAjax($){
//
//     $(document).on('click', '.jobPost', function(e) {
//
//         e.preventDefault();
//         e.stopImmediatePropagation();
//
//         const idObj = $(this).attr('href');
//
//         const ajaxUrl = window.location.origin + "/wp-admin/admin-ajax.php";
//         window.modalPayload.idObj = idObj;
//
//         $.ajax({
//             url: ajaxUrl,
//             dataType: 'html',
//             data: window.modalPayload,
//             success: function (response) {
//                 $('#modalContent').html(response);
//
//             },
//             error: function (response) {
//                 console.log(response);
//             }
//         });
//     });
// }


// $(document).on('click', '.modal-link a', function(e){
//   var ajaxUrl = window.location.origin + "/wp-admin/admin-ajax.php";
//   var productUrl = $(this).attr('href');
//
//   window.modalPayload.product = productUrl;
//
//   e.preventDefault();
//   e.stopImmediatePropagation();
//   $('.modal').show();
//   $(document.body.parentNode).css('overflow', 'hidden')
//   $(document).on('click', '.modal', function(){
//     $('.modal').hide();
//     $(document.body.parentNode).css('overflow', '')
//   });
//   $.ajax({
//
//     url: ajaxUrl,
//     dataType: 'html',
//     data: window.modalPayload,
//
//     success: function (response) {
//       $('#modalContent').html(response);
//     },
//     error: function (response) {
//       console.log(response);
//     }
//   });
// });