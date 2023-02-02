<?php

$image_slug = 'rps-logo';
$image_id = get_page_by_title($image_slug, OBJECT, 'attachment');
$image = $image_id->guid;

$financing_ad_slug = 'financing-ad';
$financing_ad_id = get_page_by_title($financing_ad_slug, OBJECT, 'attachment');
$financing_ad = $financing_ad_id->guid;

echo'<div class="container financing">
    <div class="row">
        <img itemprop="logo" class="col-sm-2" src="' . $image . '">
    </div>
    <section itemscope itemtype="https://schema.org/FinancialProduct" class="row">
        <h2 itemprop="brand" class="col-sm-12 hidden">Recreational Power Sports</h2>
        <h3 class="col-sm-12"><span itemprop="name">Financing</span> Application</h3>
        <div itemprop="description" class="col-sm-6">
    
        <p>Complete this form in <strong>2-3 minutes</strong> online, call us at<a itemprop="availableChannel" href="tel:7807321004"> (780) 732-1004</a>, or visit us in store at <a href="https://maps.google.com/?q=Recreational+Power+Sports" target="_blank" rel="noopener">11204 154 St, <span itemprop="areaServed">Edmonton, AB</span></a> T5M 1X7.</p> 
        
        <p>Once completed our team will reach out to you within one business day to go over the best possible options based on credit.</p>

        <p>If you have any questions please do not hesitate to email us at <a itemprop="availableChannel" href="mailto:finance@recreationalpowersports.com">finance@recreationalpowersports.com</a> and we will be happy to help you out!</p>
        
            <img alt="Get approved today!" src="' . $financing_ad . '">

        <p>Boats and PWCs, ATVS, snowmobiles, motorcycles, RVs, travel trailers, and more!</p>
        <p>We work with multiple lenders to achieve the best rates and terms specific to your individual credit. We work with all income levels and credit histories to help you build up your credit while still having fun! </p>
 
    <section>
        <h3>We can finance:</h3>
        <ul>
            <li>Units available in our <a href="' . $get_home_url . '/showroom/">inventory</a></li>
            <li>Private sale units you find through Kijiji, Marketplace, etc</li>
            <li>Repair bills for work completed through our <a href="' . $get_home_url . '/service/">Service Department</a></li>
            <li>Parts and accessories in our showroom</li>
            <li>Most makes and models! Older years accepted!</li>
        </ul>
        <p><strong>Most makes and models! Older years accepted!</strong></p>
        <sub>Approvals, rates, and terms are On Approved Credit (OAC). Some restrictions apply. Contact our team for more information.</sub>
    </section>
</div>
        <div class="col-sm-6">
        <iframe
      id="JotFormIFrame-211595240789262"
      title="Financing Application"
      onload="window.parent.scrollTo(0,0)"
      allowtransparency="true"
      allowfullscreen="true"
      allow="geolocation; microphone; camera"
      src="https://form.jotform.com/211595240789262"
      frameborder="0"
      style="
      min-width: 100%;
      height:539px;
      border:none;"
      scrolling="no"
    >
    </iframe>
    <script type="text/javascript">
      var ifr = document.getElementById("JotFormIFrame-211595240789262");
      if (ifr) {
        var src = ifr.src;
        var iframeParams = [];
        if (window.location.href && window.location.href.indexOf("?") > -1) {
          iframeParams = iframeParams.concat(window.location.href.substr(window.location.href.indexOf("?") + 1).split(\'&\'));
        }
        if (src && src.indexOf("?") > -1) {
          iframeParams = iframeParams.concat(src.substr(src.indexOf("?") + 1).split("&"));
          src = src.substr(0, src.indexOf("?"))
        }
        iframeParams.push("isIframeEmbed=1");
        ifr.src = src + "?" + iframeParams.join(\'&\');
      }
      window.handleIFrameMessage = function(e) {
        if (typeof e.data === \'object\') { return; }
        var args = e.data.split(":");
        if (args.length > 2) { iframe = document.getElementById("JotFormIFrame-" + args[(args.length - 1)]); } else { iframe = document.getElementById("JotFormIFrame"); }
        if (!iframe) { return; }
        switch (args[0]) {
          case "scrollIntoView":
            iframe.scrollIntoView();
            break;
          case "setHeight":
            iframe.style.height = args[1] + "px";
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
            if( !window.isPermitted(e.origin, [\'jotform.com\', \'jotform.pro\']) ) { break; }
            var src = args[1];
            if (args.length > 3) {
                src = args[1] + \':\' + args[2];
            }
            var script = document.createElement(\'script\');
            script.src = src;
            script.type = \'text/javascript\';
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
        var url = document.createElement(\'a\');
        url.href = originUrl;
        var hostname = url.hostname;
        var result = false;
        if( typeof hostname !== \'undefined\' ) {
          whitelisted_domains.forEach(function(element) {
              if( hostname.slice((-1 * element.length - 1)) === \'.\'.concat(element) ||  hostname === element ) {
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
    </section>
</div>';