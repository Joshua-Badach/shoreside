<?php
global $post;
$slug = $post->post_name;

$id = get_term_by('slug', $slug, 'product_cat');
$idObj = $id->term_id;
$term = get_term_by('id', $idObj, 'product_cat');
$categoryDescription = category_description($idObj);

$image_slug = $term->slug.'-info';
$image_id = get_page_by_title($image_slug, 'OBJECT', 'attachment');
$image_alt = get_post_meta($image_id->ID, '_wp_attachment_image_alt', TRUE);
$infoImage = $image_id->guid;

$video = get_post_custom_values('video', $slug);

echo '<section class="container serviceLayout">
    <h2>' . $term->name . '</h2>
        <div class="row">
            <div class="col-lg-6">';
                echo $categoryDescription . '
                <img class="serviceInfo" src="'. $infoImage .'" alt="' . $image_alt . '">';
                    if ($video[0] != '') {
                        echo '<iframe class="serviceVideo" name="productVideo" scrolling="no" frameborder="1" src="https://www.youtube.com/embed/' . $video[0] . '" marginwidth="0px" allowfullscreen=""></iframe>';
                    }
            echo '</div>
    <section class="col-lg-6">
        <h2>Contact Us To Book</h2>';?>

<iframe
    id="JotFormIFrame-230514941075048"
    title="Service page form"
    onload="window.parent.scrollTo(0,0)"
    allowtransparency="true"
    allowfullscreen="true"
    allow="geolocation; microphone; camera"
    src="https://form.jotform.com/230514941075048"
    frameborder="0"
    style="min-width:100%;max-width:100%;height:539px;border:none;"
    scrolling="no"
>
</iframe>
<script type="text/javascript">
    var ifr = document.getElementById("JotFormIFrame-230514941075048");
    if (ifr) {
        var src = ifr.src;
        var iframeParams = [];
        if (window.location.href && window.location.href.indexOf("?") > -1) {
            iframeParams = iframeParams.concat(window.location.href.substr(window.location.href.indexOf("?") + 1).split('&'));
        }
        if (src && src.indexOf("?") > -1) {
            iframeParams = iframeParams.concat(src.substr(src.indexOf("?") + 1).split("&"));
            src = src.substr(0, src.indexOf("?"))
        }
        iframeParams.push("isIframeEmbed=1");
        ifr.src = src + "?" + iframeParams.join('&');
    }
    window.handleIFrameMessage = function(e) {
        if (typeof e.data === 'object') { return; }
        var args = e.data.split(":");
        if (args.length > 2) { iframe = document.getElementById("JotFormIFrame-" + args[(args.length - 1)]); } else { iframe = document.getElementById("JotFormIFrame"); }
        if (!iframe) { return; }
        switch (args[0]) {
            case "scrollIntoView":
                iframe.scrollIntoView();
                break;
            case "setHeight":
                iframe.style.height = args[1] + "px";
                if (!isNaN(args[1]) && parseInt(iframe.style.minHeight) > parseInt(args[1])) {
                    iframe.style.minHeight = args[1] + "px";
                }
                break;
            case "collapseErrorPage":
                if (iframe.clientHeight > window.innerHeight) {
                    iframe.style.height = window.innerHeight + "px";
                }
                break;
            case "reloadPage":
                window.location.reload();
                break;
            case "loadScript":
                if( !window.isPermitted(e.origin, ['jotform.com', 'jotform.pro']) ) { break; }
                var src = args[1];
                if (args.length > 3) {
                    src = args[1] + ':' + args[2];
                }
                var script = document.createElement('script');
                script.src = src;
                script.type = 'text/javascript';
                document.body.appendChild(script);
                break;
            case "exitFullscreen":
                if      (window.document.exitFullscreen)        window.document.exitFullscreen();
                else if (window.document.mozCancelFullScreen)   window.document.mozCancelFullScreen();
                else if (window.document.mozCancelFullscreen)   window.document.mozCancelFullScreen();
                else if (window.document.webkitExitFullscreen)  window.document.webkitExitFullscreen();
                else if (window.document.msExitFullscreen)      window.document.msExitFullscreen();
                break;
        }
        var isJotForm = (e.origin.indexOf("jotform") > -1) ? true : false;
        if(isJotForm && "contentWindow" in iframe && "postMessage" in iframe.contentWindow) {
            var urls = {"docurl":encodeURIComponent(document.URL),"referrer":encodeURIComponent(document.referrer)};
            iframe.contentWindow.postMessage(JSON.stringify({"type":"urls","value":urls}), "*");
        }
    };
    window.isPermitted = function(originUrl, whitelisted_domains) {
        var url = document.createElement('a');
        url.href = originUrl;
        var hostname = url.hostname;
        var result = false;
        if( typeof hostname !== 'undefined' ) {
            whitelisted_domains.forEach(function(element) {
                if( hostname.slice((-1 * element.length - 1)) === '.'.concat(element) ||  hostname === element ) {
                    result = true;
                }
            });
            return result;
        }
    };
    if (window.addEventListener) {
        window.addEventListener("message", handleIFrameMessage, false);
    } else if (window.attachEvent) {
        window.attachEvent("onmessage", handleIFrameMessage);
    }
</script>
    </section>
</div>';

