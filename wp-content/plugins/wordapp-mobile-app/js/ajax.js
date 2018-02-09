
jQuery(document).ready(function() {
	
	//jQuery('.entry-title').html("hello");
	//wa_pns('big Test','iOS');
	
});



function wa_pns(posttitle,type) {
 	//jQuery('.entry-title').html("helloP");

    jQuery.ajax({
 
        type: 'POST',
        url: wapnsajax.ajaxurl,
        data: {
            action: 'wa_add_pn',
            apftitle: posttitle,
            apfcontents: type
        },
        success: function(data, textStatus, XMLHttpRequest) {
            
        },
 
        error: function(MLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        }
 
    });
}
 