<?php get_header();

get_template_part('template-parts/components/heroVideo') ?>

    <?php get_template_part('template-parts/components/brands') ?>
    <div class="row">
        <section class="col-lg-12">
            <h2>Our Mission</h2>
            <p>We specialize in <a href="/parts/">parts</a> and <a href="/service/">service</a> for all makes and models of boats, snowmobiles, ATVs, SxS, personal watercraft, and other recreational vehicles. We are Alberta’s largest dealer of <a href="/mirrocraft/">MirroCraft aluminum fishing boats</a>, <a href="/montego/">Montego Bay Pontoons</a>, and <a href="/shorestation/">ShoreStation docking and hoists</a>. We also offer a large selection of pre-owned units and <a href="/mercury/">Mercury Marine outboard engines</a>.</p>
                <p>We are committed to standing behind each and every product and service we offer. Let our knowledgeable team of experts help meet all of your power sports needs.</p>
        </section>
    </div>
</div>
<section>
    <h2 class="col-sm-8">How Recreational Power Sports Does It Better</h2>
    <?php get_template_part('template-parts/components/carousel' ); ?>
</section>

<?php

get_template_part( 'template-parts/components/offerings' );

get_template_part( 'template-parts/components/quote' );

get_template_part( 'template-parts/components/instagram' );

get_footer() ?>