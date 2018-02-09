/*
 * Attaches the image uploader to the input field
 */
jQuery(document).ready(function($){
 
    // Instantiates the variable that holds the media library frame.
    var pic_frame;
 
    // Runs when the image button is clicked.
    //$('.song-button').click(function(e){
	$(document).on('click', '.profilepic-button' , function(e){
		
        // Prevents the default action from occuring.
        e.preventDefault();
		target = e.target || e.srcElement;
		button_id = target.id;

        // If the frame already exists, re-open it.
        if ( pic_frame ) {
            pic_frame.open();
            return;
        }

        // Sets up the media library frame
        pic_frame = wp.media.frames.pic_frame = wp.media({
            title: pseoc_media_pic_js.title,
            button: { text:  pseoc_media_pic_js.button },
            library: { type: 'image' },
			multiple: false
        });

        // Runs when an image is selected.
        pic_frame.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = pic_frame.state().get('selection').first().toJSON();
 
            // Sends the attachment URL to our custom image input field.

			$('#pseoc_media_' + button_id).val(media_attachment.url);
			delete target;
			delete button_id;
        });
 
        // Opens the media library frame.
        pic_frame.open();
    });
});