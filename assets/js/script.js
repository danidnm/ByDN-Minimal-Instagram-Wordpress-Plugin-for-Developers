jQuery(document).ready(function() {

    jQuery('.insta-show-more').on( "click", function() {
        console.log('click');
        jQuery(this).parent().hide();
        jQuery(this).parent().next().show();
    } );

    jQuery('.insta-show-less').on( "click", function() {
        console.log('click2');
        jQuery(this).parent().hide();
        jQuery(this).parent().prev().show();
    });

})
