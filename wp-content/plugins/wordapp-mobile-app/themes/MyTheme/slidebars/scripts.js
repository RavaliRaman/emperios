 function ( $ ) {
    // Create a new instance of Slidebars
    var controller = new slidebars();

   

    // Initialize Slidebars
    controller.init();

      $( '.sb-toggle-left' ).on( 'click', function ( event ) {
        event.stopPropagation();
        controller.open( 'slidebar-1' );
    } );
    
} ) ( jQuery );