<?php get_header();

get_template_part('template-parts/components/heroVideo');

get_template_part('template-parts/components/brands');

get_template_part('template-parts/components/mission');

?>
<section>
<h2 class="col-sm-8">How Recreational Power Sports Does It Better</h2>
<?php get_template_part('template-parts/components/carousel' ); ?>
</section>
<?php

get_template_part( 'template-parts/components/offerings' );

get_template_part( 'template-parts/components/quote' );

get_template_part( 'template-parts/components/instagram' );

get_footer() ?>