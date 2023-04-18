<?php

$catalogQuery = new WP_Query(array(
    'category_name'     => 'catalogs',
    'order'             => 'ASC',
    'post_status'       => ' publish',
    'posts_per_page'    => 20
));
$catalogDescriptionQuery = new WP_Query(array(
    'category_name'     => 'catalog content',
    'order'             => 'ASC',
    'post_status'       => ' publish',
    'posts_per_page'    => 1
));

?>
<div class="container">
    <div class="row ourCatalogs">
        <?php
        while ($catalogDescriptionQuery->have_posts()){
            $catalogDescriptionQuery->the_post();
            echo '<h2 class="col-12">' . get_the_title() . '</h2>';
            echo '<p class="col-12">' . get_the_content() . '</p>';
        }
        wp_reset_postdata();
        ?>
    </div>
    <div class="row">
        <?php
        while ($catalogQuery->have_posts()){
            $catalogQuery->the_post();
            echo '<a href="' . get_the_content() . '" class="col-sm-3 catalog">';
            the_post_thumbnail('medium');
            echo '<h2>' . get_the_title() . '</h2>';
            echo '</a>';
        }
        wp_reset_postdata();
        ?>
    </div>
    <div class="row">
        <div class="col-12">

            <iframe
                    id="JotFormIFrame-222146149714050"
                    title="Send Us A Message Form"
                    onload="window.parent.scrollTo(0,0)"
                    allowtransparency="true"
                    allowfullscreen="true"
                    allow="geolocation; microphone; camera"
                    src="https://form.jotform.com/222146149714050"
                    frameborder="0"
                    style="min-width:100%;max-width:100%;height:539px;border:none;"
                    scrolling="no"
            >
            </iframe>
            <script type="text/javascript">
                var ifr = document.getElementById("JotFormIFrame-222146149714050");
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
        </div>
    </div>

</div>