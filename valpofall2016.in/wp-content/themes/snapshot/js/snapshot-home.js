jQuery(function($){
    // Start by preloading the loader gif
    $.imgpreload(snapshot.sliderLoaderUrl);
    
    $('#home-slider, .gallery-slider' ).each(function(){
        var $slider = $(this);
        
        // Resize the main home slider image
        var sliderHeight = $slider.height();

        $slider.find('img.slide').load(function(){
            var $$ = $(this);
            if($$.height() < sliderHeight){
                $$.css({
                    'height' : sliderHeight,
                    'width' : 'auto'
                });
            }
            else if($$.width() < $slider.width()){
                $$.css({
                    'height' : 'auto',
                    'width' : '100%'
                });
            }

            $$.css('margin-top', -$$.height()/2);
        });

        // This handles resizing the window
        $(window).resize(function(){
            $slider.find('img.slide.current').load();
        })

        // Display a slide
        var displaySlide = function(i){
            if(i < 0 || i >= $slider.find(' img.slide').length){
                i = i % $slider.find(' img.slide').length;
            }
            
            var c = $slider.find('img.slide').index($slider.find('img.slide.current'));

            if(c != -1){
                // Hide the slide
                $slider.find('img.slide').eq(c)
                    .add($slider.find('.post-titles a').eq(c))
                    .clearQueue().animate({'opacity' : 0}, Number(snapshotHome.transitionSpeed), function(){
                        $(this).hide();
                    });
            }
            $slider.find('img.slide, .post-titles a').removeClass('current');

            if($slider.is('.gallery-slider')){
                var cImg = $slider.find('img.slide').eq(i).css({height: 'auto', width: '100%'});

                if(c != -1) $slider.clearQueue().animate({height: cImg.height()});
                else $slider.height(cImg.height());

                sliderHeight = cImg.height();
            }
            
            // Show the new slide
            $slider.find('img.slide').eq(i).load()
                .add($slider.find('.post-titles a').eq(i))
                .addClass('current').show().css('opacity', 0).clearQueue().animate({'opacity' : 1}, Number(snapshotHome.transitionSpeed));
        }

        // Next, preload the slide images
        $slider.find('img.slide').imgpreload(function(){    
            $slider.removeClass('loading');

            if($slider.find('img.slide').length > 1) {
                $slider.find('.navigation').fadeIn();
                displaySlide(0);

                // Temporary slide transition
                var cc = 0;
                var interval;

                var resetInterval = function(){
                    clearInterval(interval);
                    interval = setInterval(function(){
                        displaySlide(++cc);
                    }, snapshotHome.sliderSpeed);
                };
                resetInterval();

                $slider.find('a.next').click(function(){
                    displaySlide(++cc);
                    resetInterval();
                    return false;
                });

                $slider.find('a.previous').click(function(){
                    displaySlide(--cc);
                    resetInterval();
                    return false;
                });
            }
            else{
                displaySlide(0);
            }
        });
    });
})