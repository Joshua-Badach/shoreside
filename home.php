<?php get_header();

get_template_part('template-parts/components/heroVideo') ?>
<div class="container">
    <div class="row">
        <section class="col-lg-5 home-block">
            <img src="<?php echo get_template_directory_uri() . '/assets/src/library/images/logo.png' ?>" alt="Recreational Power Sports Logo" alt="Recreational Power Sports Logo">
            <h2 class="home-heading"><?php echo get_option('blogdescription'); ?></h2>
        </section>
    </div>
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
<div class="container">
    <section class="row">
        <h2 class="offset-lg-5 col-lg-7">What we offer</h2>
        <a href="/showroom/" class="offset-lg-1 col-sm-3">
            <img src="<?php echo get_template_directory_uri() . '/assets/src/library/images/salesStock.jpg' ?>" alt="placeholder" width="200px" height="200px"><br>
            <p>Showroom</p>
        </a>
        <a href="/parts-and-accessories/" class="offset-lg-1 col-sm-3">
            <img src="<?php echo get_template_directory_uri() . '/assets/src/library/images/partsStock.jpg' ?>" alt="placeholder" width="200px" height="200px"><br>
            <p>Parts</p>
        </a>
        <a href="/service/" class="offset-lg-1 col-sm-3">
            <img src="<?php echo get_template_directory_uri() . '/assets/src/library/images/serviceStock.jpg' ?>" alt="placeholder" width="200px" height="200px"><br>
            <p>Service</p>
        </a>
    </section>
    <section class="row">
        <h2>Keyword placeholder header</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aspernatur delectus dignissimos maxime nobis numquam saepe tempore voluptatem. Assumenda autem distinctio error expedita laudantium maxime officiis praesentium quos repellat soluta.</p>
        <button>Learn More</button>
    </section>
</div>
<?php get_template_part( 'template-parts/components/quote' ); ?>
<div class="container">
    <div class="row">
        <p class="col-lg-12">
            <span>Follow Us</span> <img src="http://placekitten.com/50/50" alt=""> <span>@recreationalpowersports</span>
        </p>
        <?php get_template_part( 'template-parts/components/instagram' ); ?>
    </div>
</div>
<?php get_footer() ?>