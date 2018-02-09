jQuery(document).ready(function($) {

  var iContent = $('#fullpreviews').contents();
            iContent.find('div').hover(function () {
                jQuery(this).css("border", "1px solid red");
            }, function () {
                jQuery(this).css("border", "1px solid #c4c7cb");
            });
            
            iContent.find('div').click(function () {
               alert(this.id);
            });
                

 
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function(html) {
        var switchery = new Switchery(html, {
            size: 'small'
        });
    });
    // Add Color Picker
    $('.cpa-color-picker').wpColorPicker();
    var i = "";
    $('.advancedColors').click(function(e) {
        e.preventDefault();
        $(".advancedColorsDiv").slideToggle();
    });

	$('#WordApp_structure_iconrounded').change(function() {
    // this will contain a reference to the checkbox   
    if (this.checked) {
	     $('#icon_url').css('border-radius', '35px');
        // the checkbox is now checked 
    } else {
	     $('#icon_url').css('border-radius', '0px');
        // the checkbox is now no longer checked
    }
});
    $('.fontpicker').fontselect();

    // Click steps
    //Cancel
    $('.install-startup').click(function(e) {
        e.preventDefault();
        //alert("hello");
        var i = 1;
        var name = $(this).data('name');
		var localRemote = $(this).data('local');
		var remoteURL = ''
		remoteURL = $(this).data('url');
		
        $('.install-startup').removeClass('active-install');
        $(this).addClass('active-install');

        $('.install-startup').html('Install Now');
        $('.active-install').html('Installed');
        $('#appThemeSelected').val(name);
        $('#appThemeLocal').val(localRemote);
		$('#appThemeRemoteURL').val(remoteURL);

    });
    //Cancel
    $('.cancelReturn').click(function(e) {
        e.preventDefault();
        //alert("hello");
        var i = 1;
        $('#appName').fadeIn();
        $('#thirdStep').hide();
        $('#appTheme').hide();

        $('.progress .circle').removeClass().addClass('circle');
        $('.progress .bar').removeClass().addClass('bar');
        $('.progress .circle:nth-of-type(' + i + ')').addClass('active');
        $('.progress .circle:nth-of-type(3) .label').html('3');
        $('.progress .circle:nth-of-type(2) .label').html('2');
        $('.progress .circle:nth-of-type(1) .label').html('1');

        return false;
    });
       
    $('.WordApp_img_remove').click(function(e) {
        e.preventDefault();
        var dfa = $( this ).data( "default" );
        var imagesrc = $( this ).data( "imagesr" );
        var imageval = $( this ).data( "imagevalue" );
        $( '#'+imageval ).val("");
        $('#'+imagesrc).attr('src', dfa);
        return false;
    });
    
    
    
    //Step #1
    $('#submitStepOne').click(function(e) {
        e.preventDefault();
        //alert("hello");
        var i = 2;
        var oldval = $('#appNameInput').val();


        var neval = oldval.toLowerCase()
            .replace(/[^\w ]+/g, '')
            .replace(/[^a-zA-Z]+/g, '')
            .replace(/ +/g, '');

        var name = neval;
        if (!name) {
            alert('You must enter a valid app name');
            return false;
        }
        $('#appName').hide();
        $('#thirdStep').hide();
        $('#appTheme').fadeIn();

        $('.progress .circle').removeClass().addClass('circle');
        $('.progress .bar').removeClass().addClass('bar');
        $('.progress .circle:nth-of-type(' + i + ')').addClass('active');
        $('.progress .circle:nth-of-type(' + (i - 1) + ')').removeClass('active').addClass('done');
        $('.progress .circle:nth-of-type(' + (i - 1) + ') .label').html('&#10003;');
        $('.progress .bar:nth-of-type(' + (i - 1) + ')').addClass('active');
        $('.progress .bar:nth-of-type(' + (i - 2) + ')').removeClass('active').addClass('done');
        $('#appNameInput').val(name);
        $('#nameChoosen').html(name);


        return false;
    });

    $('.submitStepTwoNo').click(function(e) {
        e.preventDefault();
        //alert("hello");
        $('#the-table').fadeOut();
        $('#the-list').fadeIn();
        return false;
    });
      $('.submitStepTwoYes').click(function(e) {
        e.preventDefault();
        //alert("hello");
        $('#the-table').fadeOut();
        $('#the-list').fadeIn();
        $('#install-1').click();
        $('#submitStepTwo').click();
        
        return false;
    });
    
    //Step #1
    $('#submitStepTwo').click(function(e) {
        e.preventDefault();
        //alert("hello");
        var i = 3;
        var name = $('#appThemeSelected').val();
        if (!name) {
            confirm('You must choose a theme!');
            return false;
        }
        $('#appName').hide();
        $('#appTheme').hide();
        $('#thirdStep').fadeIn();

        $('.progress .circle').removeClass().addClass('circle');
        $('.progress .bar').removeClass().addClass('bar');
        $('.progress .circle:nth-of-type(' + i + ')').addClass('active');
        $('.progress .circle:nth-of-type(' + (i - 1) + ')').removeClass('active').addClass('done');
        $('.progress .circle:nth-of-type(' + (i - 2) + ')').removeClass('active').addClass('done');
        $('.progress .circle:nth-of-type(' + (i - 1) + ') .label').html('&#10003;');
        $('.progress .bar:nth-of-type(' + (i - 1) + ')').addClass('active');
        $('.progress .bar:nth-of-type(' + (i - 2) + ')').removeClass('active').addClass('done');
        $('#themeChoosen').html(name);

        return false;
    });


    // Add UPLOAD LOGO
    $('#upload_logo_button').click(function(e) {
        e.preventDefault();
        var image = wp.media({
                title: 'Upload Logo',
                multiple: false
            }).open()
            .on('select', function(e) {
                var uploaded_image = image.state().get('selection').first();
                console.log(uploaded_image);
                var image_url = uploaded_image.toJSON().url;
                $('#logo_url').attr('src', image_url);
                $('#WordAppColor_logo').val(image_url);

            });
        i = "logo";
        return false;
    });

    $('#upload_background_button').click(function(e) {
        e.preventDefault();
        var image = wp.media({
                title: 'Upload app background image',
                multiple: false
            }).open()
            .on('select', function(e) {
                var uploaded_image = image.state().get('selection').first();
                console.log(uploaded_image);
                var image_url = uploaded_image.toJSON().url;
                $('#background_url').attr('src', image_url);
                $('#WordAppColor_background').val(image_url);

            });
        i = "background";
        return false;
    });
    // Add UPLOAD LOGO
    $('#upload_logo_button_icon').click(function(e) {
        e.preventDefault();
        var image = wp.media({
                title: 'Upload App Icon',
                multiple: false
            }).open()
            .on('select', function(e) {
                var uploaded_image = image.state().get('selection').first();
                console.log(uploaded_image);
                var image_url = uploaded_image.toJSON().url;
                $('#icon_url').attr('src', image_url);
                $('#WordAppColor_icon').val(image_url);

            });
        //  tb_show('Upload a icon', 'media-upload.php?TB_iframe=true', false);
        i = "icon";
        return false;
    });
    // Add UPLOAD Splash
    $('#upload_logo_button_splash').click(function(e) {
        e.preventDefault();
        var image = wp.media({
                title: 'Upload Splash Image',
                multiple: false
            }).open()
            .on('select', function(e) {
                var uploaded_image = image.state().get('selection').first();
                console.log(uploaded_image);
                var image_url = uploaded_image.toJSON().url;
                $('#splash_url').attr('src', image_url);
                $('#WordAppColor_splash').val(image_url);

            });
        i = "splash";
        return false;
    });

    //Upload slideshow
    $('#upload_slideshow_one').click(function(e) {
        e.preventDefault();
        var image = wp.media({
                title: 'Upload slide #1',
                multiple: false
            }).open()
            .on('select', function(e) {
                var uploaded_image = image.state().get('selection').first();
                console.log(uploaded_image);
                var image_url = uploaded_image.toJSON().url;
                $('#icon_urlss_one').attr('src', image_url);
                $('#WordApp_slideshow_1').val(image_url);

            });
        i = "slideone";
        return false;
    });

    $('#upload_slideshow_two').click(function(e) {
        e.preventDefault();
        var image = wp.media({
                title: 'Upload slide #2',
                multiple: false
            }).open()
            .on('select', function(e) {
                var uploaded_image = image.state().get('selection').first();
                console.log(uploaded_image);
                var image_url = uploaded_image.toJSON().url;
                $('#icon_urlss_two').attr('src', image_url);
                $('#WordApp_slideshow_2').val(image_url);

            });
        i = "slidetwo";
        return false;
    });

    $('#upload_slideshow_three').click(function(e) {
        e.preventDefault();
        var image = wp.media({
                title: 'Upload slide #3',
                multiple: false
            }).open()
            .on('select', function(e) {
                var uploaded_image = image.state().get('selection').first();
                console.log(uploaded_image);
                var image_url = uploaded_image.toJSON().url;
                $('#icon_urlss_three').attr('src', image_url);
                $('#WordApp_slideshow_3').val(image_url);

            });
        i = "slidethree";
        return false;
    });

    $('#upload_slideshow_four').click(function(e) {
        e.preventDefault();
        var image = wp.media({
                title: 'Upload slide #4',
                multiple: false
            }).open()
            .on('select', function(e) {
                var uploaded_image = image.state().get('selection').first();
                console.log(uploaded_image);
                var image_url = uploaded_image.toJSON().url;
                $('#icon_urlss_four').attr('src', image_url);
                $('#WordApp_slideshow_4').val(image_url);

            });
        i = "slidefour";
        return false;
    });

    $('#upload_slideshow_five').click(function(e) {
        e.preventDefault();
        var image = wp.media({
                title: 'Upload slide #5',
                multiple: false
            }).open()
            .on('select', function(e) {
                var uploaded_image = image.state().get('selection').first();
                console.log(uploaded_image);
                var image_url = uploaded_image.toJSON().url;
                $('#icon_urlss_five').attr('src', image_url);
                $('#WordApp_slideshow_5').val(image_url);

            });
        i = "slidefive";
        return false;
    });

    $('#fullpreviewApp').click(function() {
        var theurlStuff = $('#fullpreviewApp').data("id");


        tb_show('Preview you app', theurlStuff + '&TB_iframe=true', false);
        i = "fullPreview";
		
        return false;
    });
    $('#fullpreviewApp2').click(function() {
        var theurlStuff = $('#fullpreviewApp2').data("id");


        tb_show('Preview you app', theurlStuff + '&TB_iframe=true', false);
        i = "fullPreview";

        return false;
    });
    $('#fullpreviews').contents().find('a').click(function(event) {
        alert("This is only a demo click ont the full preview button above to view your app in full.");
        event.preventDefault();
    });

    $('#previewApp').click(function() {
        //tb_show('Preview you app in mobile web browser', '#TB_inline?inlineId=myPreview&height=400&width=400&modal=false');
		
		var theurlStuff = $('#previewApp').data("id");
        tb_show('Preview you app', theurlStuff + '&TB_iframe=true', false)
       
        i = "preview";
        // #TB_window width: 440px;
        //$("#TB_window").width('440px');
        return false;
    });
    
    $('#previewAppTop').click(function() {
        //tb_show('Preview you app in mobile web browser', '#TB_inline?inlineId=myPreview&height=400&width=400&modal=false');
		
		var theurlStuff = $('#previewAppTop').data("id");
        tb_show('Preview you app', theurlStuff + '&TB_iframe=true', false)
       
        i = "preview";
        // #TB_window width: 440px;
        //$("#TB_window").width('440px');
        return false;
    });

    $('#previewApp2').click(function() {
        tb_show('Preview you app in mobile web browser', '#TB_inline?inlineId=myPreview&height=400&width=400&modal=false');
        i = "preview";
        // #TB_window width: 440px;
        $("#TB_window").width('440px');
        return false;
    });


    //Hide show page list
    $('#listStyle').click(function() {
        $("#pageInfo").hide();
        $("#pageInfoList").show();
        $("#pageInfoTiles").hide();

    });
    $('#pageStyle').click(function() {
        $("#pageInfo").show();
        $("#pageInfoList").hide();
        $("#pageInfoTiles").hide();
    });
     $('#pageStyleNone').click(function() {
        $("#pageInfo").hide();
        $("#WordAppOptionsPage").val($("#WordAppOptionsPage option:first").val());
        
    });
    $('#tilesStyle').click(function() {
        $("#pageInfo").hide();
        $("#pageInfoList").hide();
        $("#pageInfoTiles").show();
    });

    //Bottom Bar Hide Show
    $('#bottomBarOff').click(function() {
        $("#bottomInfo").hide();
    });
    $('#bottomBarOn').click(function() {
        $("#bottomInfo").show();
    });
    //top Bar Hide Show
    $('#topBarOff').click(function() {
        $("#topInfo").hide();
    });
    $('#topBarOn').click(function() {
        $("#topInfo").show();
    });
    //side Bar Hide Show
    $('#sideBarOff').click(function() {
        $("#sideInfo").hide();
    });
    $('#sideBarOn').click(function() {
        $("#sideInfo").show();
    });
    $('#pushNoteSend').click(function() {
        // e.preventDefault();
        $('#sendToAD').attr('action', "https://secure.buildapps.biz/mobrock/app/sendToAD.php?pro=1").submit();
        //$( "#sendToAD" ).submit();
        //window.location.href = 'http://app-developers.biz/wordapp-specials/?user=' + $('#user').val()+ '&email=' +  $('#email').val()+ '&url=' +  $('#url').val()+ '&download=' +  $('#download').val();
    });
    $('#goToWordApp').click(function() {
        window.location.href = 'admin.php?page=WordAppBuilder';
    });
    $('#goCommunity').click(function() {
        window.location.href = 'http://community.app-developers.biz/?user=' + $('#user').val();
    });

    $('#jqIcons').click(function() {
        tb_show('Icon list', 'https://api.jquerymobile.com/resources/icons-list.html?TB_iframe=true', false);
        i = "jquery icons";
        return false;
    });

    //After uploading call this script

    window.original_send_to_editor = window.send_to_editor;
    //After uploading call this script
    window.send_to_editor = function(html) {
        var image_url = $('img', html).attr('src');
        // alert(image_url);

        if (i == "logo") {
            $('#logo_url').attr('src', image_url);
            $('#WordAppColor_logo').val(image_url);
        } else if (i == "background") {
            $('#background_url').attr('src', image_url);
            $('#WordAppColor_background').val(image_url);
        } else if (i == "splash") {
            $('#splash_url').attr('src', image_url);
            $('#WordAppColor_splash').val(image_url);
        } else if (i == "icon") {
            $('#icon_url').attr('src', image_url);
            $('#WordAppColor_icon').val(image_url);
        } else if (i == "slideone") {
            $('#icon_urlss_one').attr('src', image_url);
            $('#WordApp_slideshow_1').val(image_url);
        } else if (i == "slidetwo") {
            $('#icon_urlss_two').attr('src', image_url);
            $('#WordApp_slideshow_2').val(image_url);
        } else if (i == "slidethree") {
            $('#icon_urlss_three').attr('src', image_url);
            $('#WordApp_slideshow_3').val(image_url);
        } else if (i == "slidefour") {
            $('#icon_urlss_four').attr('src', image_url);
            $('#WordApp_slideshow_4').val(image_url);
        } else if (i == "slidefive") {
            $('#icon_urlss_five').attr('src', image_url);
            $('#WordApp_slideshow_5').val(image_url);
        } else {
            window.original_send_to_editor(html);
        }


        tb_remove();
    };

    $('#txtCount').simplyCountable({
        counter: '#counter',
        countType: 'characters ',
        maxCount: 105,
        countDirection: 'down'
    });
    $('#txtCount').keyup(function() {
		$('#notification_text_text').html($('#txtCount').val());
		});

    $("#sendPush").click(function(e) {
        var apikey = $('#apiKey').val();
        var apiLogin = $('#apiLogin').val();
        var nonce = $('#wa_push_nonce').val();
        var message = $('#txtCount').val();

		var datetime24 = $('#datetime24').val();
		/*
        var fullUrl = 'https://secure.buildapps.biz/mobrock/app/pnSend.php?apiKey=' + apikey + '&apiLogin=' + apiLogin + '&message=' + $('#txtCount').val() + '';
        //alert(fullUrl);
        */
        
        
	        
	        //alert(nonce);

	        jQuery.ajax({
 
        type: 'POST',
        url: wapnsajax.ajaxurl,
        data: {
            action: 'wa_add_pn_send',
            apikey: apikey,
            apiLogin: apiLogin,
            apikey: apikey,
            message:message,
            wa_push_nonce: nonce,
            datetime24:datetime24
            
        },
        success: function(data, textStatus, XMLHttpRequest) {
           alert("Your message was sent! Depending on the number of downloads, sending may take a few hours. You can check the status in PN Messages tab."); 
        },
 
        error: function(MLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        }
 
    });
	        
	        /*
	        
            $.ajax({
                type: 'GET',
                url: fullUrl,
                dataType: 'jsonp',
                success: function(jsonData) {
                    //alert(jsonData['pnTrue']);
                    if (jsonData.pnSent == 'true') {
                        alert("Your message was sent! Depending on the number of downloads, sending may take a few hours.");

                    } else {
                        alert("Your message was sent! Depending on the number of downloads, sending may take a few hours.");

                    }
                },
                error: function() {
                    alert("Your message was sent! Depending on the number of downloads, sending may take a few hours.");
                }
            });
            */
        
    }); //End Send Push


    $("#submitPub").click(function(e) {

        var user = $('#user').val();
        var blogname = $('#blogname').val();
        var name = $('#name').val();
        var url = $('#url').val();
        var email = $('#email').val();

        var fullUrl = 'https://secure.buildapps.biz/mobrock/app/pubSend.php?blogname=' + blogname + '&user=' + user + '&url=' + url + '&name=' + name + '&email=' + email + '&message=' + $('#txtCount').val() + '&callback=?';

        $.ajax({
            type: 'GET',
            url: fullUrl,
            dataType: 'json',
            success: function(jsonData) {
                //alert(jsonData['pnTrue']);
                if (jsonData.pubSent === 'true') {
                    alert("Your message was sent to our developers! To get your app for free don\'t forget to invites some frients!\n\n\n  Or help us with our crowdfunding efforts :)");
                    $('#sendToAD').attr('action', "http://secure.buildapps.biz/mobrock/app/sendToAD.php?free=1").submit();

                    //window.location.href = 'admin.php?page=WordAppMoreDownloads';
                } else {

                    alert("There seems to be a problem. Please check you API codes and try again.");
                }
            },
            error: function() {
                alert("Your message was sent to our developers! To get your app for free don\'t forget to invites some frients!\n\n\n  Or help us with our crowdfunding efforts :)");
                $('#sendToAD').attr('action', "https://secure.buildapps.biz/mobrock/app/sendToAD.php?free=1").submit();
                // window.location.href = 'admin.php?page=WordAppMoreDownloads';
            }
        });

    }); //End Send Publication


    $("#submitPubPremium").click(function(e) {

        $('#sendToAD').attr('action', "https://secure.buildapps.biz/mobrock/app/sendToADPro.php?premium=1").submit();


    });

    $("#submitPubPro").click(function(e) {

        var user = $('#user').val();
        var blogname = $('#blogname').val();
        var name = $('#name').val();
        var url = $('#url').val();
        var email = $('#email').val();

        var fullUrl = 'https://secure.buildapps.biz/mobrock/app/pubSend.php?blogname=' + blogname + '&user=' + user + '&url=' + url + '&name=' + name + '&email=' + email + '&message=' + $('#txtCount').val() + '&callback=?';

        $.ajax({
            type: 'GET',
            url: fullUrl,
            dataType: 'json',
            success: function(jsonData) {
                //alert(jsonData['pnTrue']);
                if (jsonData.pubSent === 'true') {
                    alert("Your message was sent to our developers! To get your app for free don\'t forget to invites some frients!\n\n\n  Or help us with our crowdfunding efforts :)");
                    window.location.href = 'admin.php?page=WordAppMoreDownloads';
                } else {

                    alert("There seems to be a problem. Please check you API codes and try again.");

                }
            },
            error: function() {
                alert("Your message was sent to our developers! To get your app for free don\'t forget to invites some frients!\n\n\n  Or help us with our crowdfunding efforts :)");
                window.location.href = 'admin.php?page=WordAppMoreDownloads';
            }
        });

    }); //End Send Publication


//Sending app to Phone
 $("#number").on("countrychange", function(e, countryData) {
  // do something with countryData
  $('#numberdialcode').val(countryData.dialCode);
 // console.log(countryData.dialCode);
});
 $("#submitPhone").click(function(e) {

  var numbertel = $('#number').val();
  var numberdialcode = $('#numberdialcode').val();
  var site = $('#site').val();
$.post("http://app-developers.biz/sms/sms.php",
    {
         number:numbertel,
			      numberdialcode:numberdialcode,
			      site:site
    },
    function(data, status){
        //alert("Data: " + data + "\nStatus: " + status);
    });
    alert("Thanks! You will recieve an SMS in a few minutes with intructions.");


    /*
   $.ajax({
                type: 'post',
				url: 'http://app-developers.biz/sms/sms.php',
				data: {
			      number:numbertel,
			      numberdialcode:numberdialcode,
			      site:site
			    },
                dataType: 'jsonp',
                success: function(jsonData) {
                    //alert(jsonData['pnTrue']);
                    if (jsonData.pnSent == 'true') {
                        alert("Your message was sent! Depending on the number of downloads, sending may take a few hours.");

                    } else {
                        alert("Your message was sent! Depending on the number of downloads, sending may take a few hours.");

                    }
                },
                error: function() {
                    alert("Your message was sent! Depending on the number of downloads, sending may take a few hours.");
                }
            });*/
            
            
 });

    $("#inviteFriends").click(function(e) {
        var user = $('#user').val();
        var blogname = $('#blogname').val();
        var name = $('#name').val();
        var url = $('#url').val();

        var fullUrl = 'http://mobile-rockstar.com/app/invite.php';
        //alert(fullUrl);
        if (name === '' || user === '' || $('#emails').val() === '') {

            alert("There seems to be a problem. Both your name & your friends emails addresses are required.");

        } else {
            $.ajax({
                type: 'POST',
                url: fullUrl,
                data: {
                    'emails': $('#emails').val(),
                    'name': name,
                    'user': user,
                    'blogname': blogname,
                    'url': url
                },
                dataType: 'jsonp',
                success: function(jsonData) {
                    //alert(jsonData['pnTrue']);
                    if (jsonData.inviteSent === 'true') {
                        alert("THANK YOU!! Your message was sent! Your account will be updated in a few hours.");
                        window.location.href = 'http://community.app-developers.biz/wordapp-specials/';
                    } else {

                        alert("There seems to be a problem. Please check &  try again.");

                    }
                },
                error: function() {
                    alert("THANK YOU!! Your message was sent! Your account will be updated in a few hours.");
                    window.location.href = 'http://community.app-developers.biz/wordapp-specials/';
                }
            });
        }
    }); // END INVITE

    var formHasChanged = false;
    var submitted = false;

    $(document).on('change', '#mainForm', function(e) {
        formHasChanged = true;
    });

    window.onbeforeunload = function(e) {
        if (formHasChanged && !submitted) {
            var message = "You have not saved your changes.",
                e = e || window.event;
            if (e) {
                e.returnValue = message;
            }
            return message;
        }
    };

    $("form").submit(function() {
        submitted = true;
    });
    
    
     $('#datetime24').combodate({
    minYear: 1975,
    maxYear: 2020});   


});


