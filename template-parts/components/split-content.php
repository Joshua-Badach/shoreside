<?php
global $post;
$slug               =           $post->post_name;

$image_slug         =           'rps-logo';
$image_id           =           get_page_by_title($image_slug, OBJECT, 'attachment');
$image              =           $image_id->guid;

echo'<div class="container split">
  
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
    </div>';
    echo'<div class="col-sm-6">
        <script type="text/javascript" src="https://form.jotform.com/jsform/230395047849263"></script>
    </div>';

    echo '</section>
</div>';