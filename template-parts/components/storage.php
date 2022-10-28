<!--Filtering code-->
<div class="filterHeading">
    <p>Price: </p>
</div>
<div id="prices" class="objectPadding">
    <a id="asc"
       data-category="' . $idObj . '"
       data-attribute="' . $_REQUEST['attribute'] . '"
       data-term="' . $_REQUEST['tagObj'] . '"
       data-order="price"
       data-sale="' . $_REQUEST['onSaleObj'] . '"
       data-slug="' . $_REQUEST['slug'] . '">Low to High
    </a>

    <a id="desc"
       data-category="' . $idObj . '"
       data-attribute="' . $_REQUEST['attribute'] . '"
       data-term="' . $_REQUEST['tagObj'] . '"
       data-order="price-desc"
       data-sale="' . $_REQUEST['onSaleObj'] . '"
       data-slug="' . $_REQUEST['slug'] . '">High to Low
    </a>
</div>