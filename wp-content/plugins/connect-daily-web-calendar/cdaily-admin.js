/*
    Scripts used by the Connect Daily Plugin Admin Pages.
*/
/**
  * Copyright 2013, MH Software, Inc.
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * This program is distributed in the hope that it will be useful,
  * but WITHOUT ANY WARRANTY; without even the implied warranty of
  * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  * GNU General Public License for more details.
  * You should have received a copy of the GNU General Public License
  * along with this program; if not, write to the Free Software
  * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/
var CDaily= typeof(CDaily) == 'undefined' ?  {
    "RESPONSIVE_BREAK_SIZE" : 600,
    "DEFAULT_DIALOG_WIDTH"  : 600
} : CDaily;

CDaily["showTerms"] = function(event) {
    var div=jQuery("#CDailyHostedTerms");
    if (div.css("display")=="block") {
        div.css("display","none");
    } else {
        div.css("display","block");
    }
    
    if (event != null && event.stopPropagation) {
        event.stopPropagation();
    }

};

/**
 * Validate the settings form. 
 */
CDaily["validate_settings_form"] = function() {
    var configured = jQuery("input[name=cd_configured]").val(), sMessage = '';
    if (configured == 'Y') {
        // Check the URL
        //  cdaily_url
        var theURL = jQuery("input[name=cdaily_url]").val();
        if (theURL == null || theURL.length == 0) {
            sMessage += "You must supply a URL to the Connect Daily Calendar.\n";
        }
    } else {
        var sForm = jQuery('input[name=rgCalendarChoice]:checked', '#cdSettingsForm').val();
        if (sForm == 'create') {
            // Check
            //
            // Password and Confirm match.
            //
            var pw = jQuery("input[name=cdNewUserPassword]").val(),
                confirmPw = jQuery("input[name=cdNewUserConfirmPassword]").val();
            if (pw.length == null || pw.length == 0) {
                sMessage += "You must supply a password to use for your Connect Daily user account.\n";
            } else if (confirmPw == null || pw.length == 0 || pw != confirmPw) {
                sMessage += "The confirm value for the password does not match. Please verify the values and resubmit the form.\n"
            }

            // Terms checkbox marked.
            if (!jQuery("#idCDTC").is(':checked')) {
                sMessage += "You must accept the hosting terms and conditions for the calendar to continue.\n";
            }
            // Site_URL Present
            //
            if (jQuery("input[name=site_url]").val() == null) {
                sMessage += "You must specify the URL to your WordPress site to continue.\n";
            }
        } else {
            var url = jQuery("#IDCDailyURL").val();
            if (url == null || url.length == 0) {
                sMessage += "You must specify the URL to your Connect Daily calendar to continue.\n";
            }
        }

    }
    if (sMessage.length != 0) {
        alert(sMessage);
    }
    return sMessage.length == 0;
};

/**
 * Hide/unhide the fieldsets for creating a calendar or using an 
 * existing one. 
 */
CDaily["toggleSettingsFieldSets"] = function() {
    var ele=document.getElementById('idCreateNewCalendar');
    if (ele.checked) {
        jQuery('#fldSetCreateNewCalendar').show();
        jQuery('#CDailyCreateInstructions').show();
        jQuery('#fldSetConnectExistingCalendar').hide();
        jQuery('#CDailyInstructions').hide();
        jQuery('#idJoomlaCDailySettings').hide();
    } else {
        jQuery('#fldSetCreateNewCalendar').hide();
        jQuery('#CDailyCreateInstructions').hide();
        jQuery('#fldSetConnectExistingCalendar').show();
        jQuery('#CDailyInstructions').show();
        jQuery('#idJoomlaCDailySettings').show();
    }
};

CDaily["initByMethod"] = function(sel, curValue) {
    while (sel.options.length > 0) {
        sel.options.remove(0);
    }
    jQuery.each(CDaily.typeData.items, function(index, obj) {
            var opt = new Option(obj.type_label, obj.type_string);
            if (curValue == obj.type_string) {
                opt.selected = true;
            }
            sel.options.add(opt);
        });
};

CDaily["initForDropdownFromMethod"]=function(selMethod,value){
    var method=jQuery(selMethod).val(),
        selID=jQuery(selMethod).attr('id');
    selID=selID.replace("_method","_id");
    var sel=document.getElementById(selID);
    if (typeof value === "undefined") {
            value=-1;
    }
    return CDaily.initForDropdown(method,sel,value);
}

/**
 * This method initializes the "for" dropdown. IOW, if the by
 * method is "calendar_id", this populates the dropdown with
 * a list of calendars.
 *
 * This function is dependent upon jQuery for doing the AJAX
 * request.
 *
 * @param by_method - The method we're using. E.G. calendar_id
 * @param sel   - SELECT widget.
 * @param selvalue - The value to initialize.
 */
CDaily["initForDropdown"] = function(by_method, sel, selvalue) {

    var iValue = parseInt(selvalue, 10);
    /* We need to wipe out the existing options from the dropdown. */
    while (sel.options.length > 0) {
        sel.options[0] = null;
    }

    jQuery.each(CDaily.typeData.items, function(indexOuter, typeObj) {
        if (typeObj.type_string==by_method) {

            jQuery.each(typeObj.items, function(index, obj) {
                    var opt = new Option(obj.name, obj.object_id  );
                    if (iValue == obj.object_id) {
                        opt.selected = true;
                    }
                    sel.options.add(opt);
                });
        }
    });
};

/**
 * Return true if this script is running in a page generated by 
 * WordPress. 
 */
CDaily["isWordpress"]=function(){
    return (typeof ajaxurl =='string') && (ajaxurl.indexOf('admin-ajax.php')>0);
}

CDaily["isJoomla"]=function(){
    return typeof CDaily.JOOMLA==='boolean' && CDaily.JOOMLA;
}

/**
 * Our admin page hooks for jQuery to execute.
 */
jQuery(document).ready(function() {
    if (CDaily.isWordpress()) {
        /*
            You can't really put your own url or javascript in a
            wordpress menu option. So, this is a hack to change
            the url of our link.
         
        */
        var lnk = jQuery('a[href="admin.php?page=cdaily-sslogin"]');
        if (lnk.length != 0) {
            //
            // Single Signin Login Method
            //
            lnk.attr("href", "javascript:CDaily.doSingleSignon();");
        }
    }
});

CDaily["endsWith"] = function(str, suffix) {
    return str.indexOf(suffix, str.length - suffix.length) !== -1;
};

/**
 * This generates the shortcode tag to insert.
 */
CDaily["generateShortCode"] = function() {
    var sType = jQuery('#cd-shortcode-type').val();
    var sResult = '',s;
    if (sType == 'event' ) {
        sResult='<div style="border: 1px solid black;">Add <b>by_id="nn"</b> to the short-code list a specific event, or \ncall page with argument <b>?cal_item_id=nn</b>\nwhere nn is the cal_item_id of the event.</div>[cdaily_event]';
    } else if (sType == 'search') {
        sResult = '[cdaily_search dayspan="60" by_method="' + jQuery('#cd-list-events-by_method').val() +
            '" by_id="' + jQuery('#cd-list-events-by_id').val() + '"]';
    } else if (sType == 'minicalendar') {
        sResult = '[cdaily_minicalendar by_method="' + jQuery('#cd-list-events-by_method').val() +
            '" by_id="' + jQuery('#cd-list-events-by_id').val() + '"]';
    } else if (sType == 'ical') {
        sResult = '[cdaily_icalendar by_method="' + jQuery('#cd-list-events-by_method').val() +
            '" by_id="' + jQuery('#cd-list-events-by_id').val() + '"]' +
            '<img style=\"height: 32px; width: 32px; " alt="iCalendar" src="' + CDaily.pluginPath + '/images/calendar.svg">' +
            '[/cdaily_icalendar]';
    } else if (sType == 'rcalendar') {
        sResult = '[cdaily_monthview by_method="' + jQuery('#cd-list-events-by_method').val() +
            '" by_id="' + jQuery('#cd-list-events-by_id').val() + '"' +
            (jQuery('#cd-rcalendar-wrap').prop("checked") ? " wrap_events=\"1\"" : "") +
            (jQuery('#cd-rcalendar-enabledropdown').prop("checked") ? " enable_dropdown=\"1\"" : "") +
            (jQuery('#cd-rcalendar-enablestyles').prop("checked") ? " enable_styles=\"1\"" : "") +
            ']';
    } else if (sType == 'detailed_list') {
        sResult = '[cdaily_detailedlist by_method="' + jQuery('#cd-list-events-by_method').val() +
            '" by_id="' + jQuery('#cd-list-events-by_id').val() + '" ';
        s = jQuery('#cd-max-events').val();
        if (s == '') {
            s = '6';
        }
        sResult += ' maxcount="' + s +'"';
        s = jQuery('#cd-max-days').val();
        if (s == '') {
            s = '30';
        }
        sResult += ' dayspan="' + s +'"';

        if (jQuery('#cd-allow-duplicates').prop("checked")) {
            s = '0';
        } else {
            s = '1';
        }
        sResult += ' allow_duplicates="' + s + '"';
        if (jQuery('#cd-show-endtimes').prop("checked")) {
            s = '1';
        } else {
            s = '0';
        }
        sResult += ' show_endtimes="' + s + '"]';
    } else if (sType == 'simple_list') {
        sResult = '[cdaily_simplelist by_method="' + jQuery('#cd-list-events-by_method').val() +
            '" by_id="' + jQuery('#cd-list-events-by_id').val() + '" ';
        s = jQuery('#cd-max-events').val();
        if (s == '') {
            s = '6';
        }
        sResult += 'maxcount="' + s;
        s = jQuery('#cd-max-days').val();
        if (s == '') {
            s = '30';
        }
        sResult += '" dayspan="' + s + '" ';
        if (jQuery('#cd-show-starttimes').prop("checked")) {
            s = '1';
        } else {
            s = '0';
        }
        sResult += 'show_starttimes="' + s + '" ';
        if (jQuery('#cd-show-endtimes').prop("checked")) {
            s = '1';
        } else {
            s = '0';
        }
        sResult += 'show_endtimes="' + s + '" ';
        if (jQuery('#cd-allow-duplicates').prop("checked")) {
            s = '0';
        } else {
            s = '1';
        }
        sResult += 'allow_duplicates="' + s + '"]';
    } else if (sType == 'add_event') {
        sResult = '[cdaily_addevent allow_recurrence="'+
            (jQuery('#cd-allow-recurrence').prop('checked') ? "1" : "0")+
            '"]';
    } else if (sType == 'filter') {
        sResult='[cdaily_filter by_method="'+jQuery('#cd-filter-by-method').val()+'" ';
        s=jQuery('#cd-filter-title').val().trim();
        if (s.length>0) {
            sResult+=' title="'+s+'"';
        }
        s=jQuery('#cd-collapse-threshold').val().trim();
        if (s.length>0) {
            sResult+=' collapse_threshold="'+s+'"';
        }
        s=jQuery('#cd-collapse-label').val().trim();
        if (s.length>0) {
            sResult+=' collapse_label="'+s+'"';
        }
        s=jQuery('#cd-expand-label').val().trim();
        if (s.length>0) {
            sResult+=' expand_label="'+s+'"';
        }
        sResult+='][/cdaily_filter]';
    } else {
        var sView = jQuery('#cd-iframe-view').val();
        sResult = '[cdaily_iframe ';
        s = jQuery('#cd-iframe-height').val();
        if (s != '') {
            sResult += ' height="' + s + '" ';
        }
        s = jQuery('#cd-iframe-width').val();
        if (s != '') {
            sResult += ' width="' + s + '" ';
        }
        if (sType!='add_event') {
            sResult += ' options="' + jQuery('#cd-list-events-by_method').val() + '=' + jQuery('#cd-list-events-by_id').val() + '" ';
        }
        if (sView != '') {
            sResult += ' view="' + sView + '"';
        }
        sResult += ']';

    }

    tinyMCE.activeEditor.execCommand('mceInsertContent', false, sResult);
    tinyMCE.activeEditor.windowManager.close();

};

/**
 * This function toggles the options on the tinyMCE editor page
 * based on the choice made from the shortcode type dropdown.
*/
CDaily["toggleFieldSets"] = function() {

    var sVal = jQuery('#cd-shortcode-type').val(),
        sel=document.getElementById('cd-shortcode-type'),
        opt=sel.options[sel.selectedIndex],
        sRequires=jQuery(opt).attr("data-requires"),
        styleVal, 
        elements=[
            "#cd-event-list-settings",
            "#cd-events",
            "#cd-iframe-settings",
            '#cd-filter-options',
            '#cd-add-options',
            "#cd-rcalendar-settings",
            "#lbl-cd-iframe-view",
            "#lbl-cd-show-endtimes",
            "#lbl-cd-show-starttimes"
        ];

    elements.forEach(function(item,index) {
        if (sRequires.indexOf(item)>=0) {
            styleVal=item.indexOf('#lbl')==0 ? 'inline' : 'block';
        } else {
            styleVal='none';
        }
        jQuery(item).css('display',styleVal);
    });

    var helpBaseURL="http://www.mhsoftware.com/caldemo/manual/en/pageFinder.html?page=";
    if (sVal == 'ical') {
        jQuery('#cdShortCodeHelpLink').attr("href", helpBaseURL+"iCalExporter.htm");
    } else if (sVal == 'simple_list') {
        jQuery('#cdShortCodeHelpLink').attr("href", helpBaseURL+"WordPressMiniCalendarWidget.html");
    } else if (sVal == 'detailed_list') {
        jQuery('#cdShortCodeHelpLink').attr("href", helpBaseURL+"WPDetailedListOfEventsShortCode.html");
    } else if (sVal == 'rcalendar') {
        jQuery('#cdShortCodeHelpLink').attr("href", helpBaseURL+"WPResponsiveMonthView.html");
    } else if (sVal =='filter' ) {
        jQuery('#cdShortCodeHelpLink').attr("href", helpBaseURL+"PluginFilter.html");
    } else if (sVal =='add_event' ) {
        jQuery('#cdShortCodeHelpLink').attr("href", helpBaseURL+"CMSAddEventForm.html");
    } else {
        jQuery('#cdShortCodeHelpLink').attr("href", helpBaseURL+"WPIFrameShortCodes.html");
    }
};

/**
 * By feature detection, try to detect safari.
 */
CDaily["isSafari"]=function(){
    // Safari 3.0+ "[object HTMLElementConstructor]" 
    var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || safari.pushNotification);
    return isSafari;
}

/**
 * Implement our login link.
 */
CDaily["doSingleSignon"]=function(){
    var sURL;
    if (CDaily.hasOwnProperty("ssoAjaxURL")) {
        sURL=CDaily.ssoAjaxURL;
    } else {
        sURL=CDaily.ajaxURL
        if (sURL.indexOf('?')<0) {
            sURL+='?';
        } else {
            sURL+='&';
        }
        sURL+=(CDaily.isWordpress() ? 'action=cdaily&sub' : '')+'action=cd_sso';
    }
    var args={
        "dataType": "jsonp",
        "timeout": 5000,
        "url": sURL,
        "success": function(data, textStatus, jqXHR) {
            if (data.hasOwnProperty('error')) {
                alert(data.error);
                return;
            }
            window.open(data.url);
        }
    };
    if (CDaily.isSafari()) {
        /*
            Safari doesn't let you do a window.open in an async callback,
            while firefox has deprecated async callbacks...
        */
        args["async"]=false;
    }
    jQuery.ajax(args).error(function(jqxhr, status, error) {
            console.log("error=" + error);
            console.log(jqxhr.responseText);
            alert('Single Signon Failed!');
    });
};


/*
    The code below is for the editor popup.
*/

CDaily["forInitialized"]=false;

CDaily["setupByDD"]=function(){
	if (!CDaily.forInitialized) {
                var widget=document.getElementById('cd-list-events-by_method');
                CDaily.initByMethod(widget,null);
                CDaily.initForDropdownFromMethod(widget);
	}
	CDaily.forInitialized=true;
};

/**
 * This method is used to validate the URL that's entered in the 
 * configuration screen. It does some sanity checks, and some 
 * transforms to clean things up. 
 */
CDaily["cdaily_url_onChange"]=function(element){
    var url=element.value.trim();
    if (url.length > 0) {
        if (url.indexOf('/')<0 || (url.lastIndexOf('/')-1)==url.indexOf('//')) {
            url+='/';
        }
        var wcPattern=new RegExp("^webcal://","i");
        if (wcPattern.test(url)) {
            url=url.replace(wcPattern,"");
        }
        var schemePattern=new RegExp("^http[s]?://","i");
        if (!schemePattern.test(url)) {
            url='http://'+url;
        }
        if (url.indexOf('mhsoftware.com')>=0) {
            url=url.replace(schemePattern,'https://');
        }
        
        if (!url.endsWith('/')) {
            url=url.substr(0,url.lastIndexOf('/')+1);
        }
        if (!url.endsWith("/")) {
            url+="/";
        }
        element.value=url;
    }
    return true;
}

/**
 * Makes an ajax call to the back-end when a user dimisses a 
 * hint so we don't keep showing it over and over. 
 */
CDaily["dismissHint"]=function(hintName,containerID){

    var args={
        "dataType": "jsonp",
        "timeout": 5000,
        "url": CDaily.ajaxURL+'?'+(CDaily.isWordpress() ? 'action=cdaily&sub' : '')+'action=cd_dismisshint&hintName='+hintName,
        "async" : true,
        "success": function(data, textStatus, jqXHR) {
            if (data.hasOwnProperty('error')) {
                alert(data.error);
                return;
            } else {
                // jQuery(containerID).css('display','none');
                jQuery(containerID).fadeOut(600);
            }
        }
    };

    jQuery.ajax(args).error(function(jqxhr, status, error) {
            console.log("error=" + error);
            console.log(jqxhr.responseText);
            alert('Dismissing Hint Failed: '+jqxhr.responseText);
    });
};

