$('document').ready(function() { // Handle the slidingbar toggle click
jQuery( '#menu-item-592' ).click( function(){
    var $slidingbar = $( '#slidingbar' );

    //Expand
    if ( slidingbar_state === 0 ) {
        $slidingbar.slideDown( 240, 'easeOutQuad' );
        jQuery( '.sb-toggle' ).addClass( 'open' );
        slidingbar_state = 1;

        // Reinitialize google maps
        if ( $slidingbar.find( '.shortcode-map' ).length ) {
            $slidingbar.find( '.shortcode-map' ).each( function() {
                jQuery( this ).reinitialize_google_map();
            });
        }

        // Reinitialize carousels
        if( $slidingbar.find( '.fusion-carousel' ).length ) {
            generate_carousel();
        }

        jQuery( '#slidingbar' ).find( '.fusion-carousel' ).fusion_recalculate_carousel();

        // reinitialize testimonial height; only needed for hidden wrappers
        if ( $slidingbar.find( '.fusion-testimonials' ).length ) {
            var $active_testimonial = $slidingbar.find( '.fusion-testimonials .reviews' ).children( '.active-testimonial' );

            $slidingbar.find( '.fusion-testimonials .reviews' ).height( $active_testimonial.height() );
        }

        //Collapse
    } else if( slidingbar_state == 1 ) {
        $slidingbar.slideUp(240,'easeOutQuad');
        jQuery( '.sb-toggle' ).removeClass( 'open' );
        slidingbar_state = 0;
    }
});
}));
