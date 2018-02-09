jQuery(function($){
    // Hover effect for a post loop
    $('#post-loop .post .post-content').animate({'opacity': 0});
    $('#post-loop .post')
        .mouseenter(function(){
            var $$ = $(this);
            $$.find('.post-content').clearQueue().animate({'opacity': 1}, 300);
            $$.find('.corner.corner-se').clearQueue().animate({'bottom': -20, 'right' : -20}, 300);
        })
        .mouseleave(function(){
            var $$ = $(this);
            $$.find('.post-content').clearQueue().animate({'opacity': 0}, 300);
            $$.find('.corner.corner-se').clearQueue().animate({'bottom': 5, 'right' : 5}, 300);
        });
    
    // Preload single images
    if($('#post-single-viewer.image').length && !$('#post-single-viewer.image img').get(0).complete){
        $('#post-single-viewer.image').addClass('loading');
        $('#post-single-viewer.image img').css('visibility', 'hidden');
        
        $.imgpreload(snapshot.imageLoaderUrl);

        // Load the main image
        $('#post-single-viewer.image img').imgpreload(function(){
            $('#post-single-viewer.image').removeClass( 'loading' );
            $(this).css('visibility', 'visible').hide().fadeIn(850);
        });
    }
    
    // Preload the image lists
    $('#post-loop img.thumbnail').each(function(i, el){
        var $el = $(this);
        if(!$el.get(0).complete){
            $el.css('visibility', 'hidden').closest('.post-background').addClass('loading');

            $el.imgpreload(function(){
                $el.css('visibility', 'visible').hide()
                    .fadeIn('slow', function(){$el.closest('.post-background').removeClass('loading')})
            });
        }
    });
    
    $('.entry-content' ).fitVids();
});