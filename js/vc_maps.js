/**
 * Created by xuantruong on 6/15/16.
 */
'use strict';
!function($) {
    // Recent news shortcode
    var current_value = '';
    $( '.rn_categories' ).on( 'change', function( event ) {
        if( $( this ).prop( 'checked' ) ) {
            current_value = $( this ).val();
            if( current_value == 0 ) {
                $( '.rn_categories' ).each( function() {
                    $( this ).prop( 'checked', false );
                } );
                $( this ).prop( 'checked', true );
            }
        }


    });


}(window.jQuery);

