export function breadcrumbs(){

    $('#sidebar #categories a, #sidebar #attributes a').on('click', function() {
        console.log('target hit');
        // var $this = $(this),
        //     $bc = $('<div class="item"></div>');
        //
        // $this.parents('li').each(function(n, li) {
        //     var $a = $(li).children('a').clone();
        //     $bc.prepend(' / ', $a);
        // });
        // $('.breadcrumb').html( $bc.prepend('<a href="#home">Home</a>') );
        // return false;
    })

}
