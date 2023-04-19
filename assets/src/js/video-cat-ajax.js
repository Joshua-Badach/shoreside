import './sidebar';
import {sidebar} from "./sidebar";
import './sidebar-ajax';
import {sidebarAjax} from "./sidebar-ajax";

window.LoadVideoPayload = {
    type: 'POST',
    action: 'load_video_results',
};
export function videoCatAjax() {
    $(document).on('click', '#sidebar a, #sidebar input, #sidebar button', function() {

        const idObj = $(this).data('category');
        window.LoadVideoPayload.idObj = idObj;

        const ajaxUrl = window.location.origin + "/wp-admin/admin-ajax.php";

        $.ajax({
            url: ajaxUrl,
            dataType: 'html',
            data: window.LoadVideoPayload,
            success: function (response) {
                $('#shelf').html(response);

                $('#videoTab').click(function(){
                    $(this).show( { direction: "left" }, 1000);
                    $('#videoSlider').toggle( { direction: "left" }, 1000);
                });
            },
            error: function (response) {
                console.log(response);
            }
        });
    });
}