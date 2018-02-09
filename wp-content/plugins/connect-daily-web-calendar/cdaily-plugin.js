/*
    These are script elements used by the user-interface portion of the
    various plugin widgets.
*/
/*
Copyright 2013-2017, MH Software, Inc.

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/
/** 
  * the reference to cd_scriptvars is kind of weird. The 
  * wp_localize_script method defines cd_scriptvars as 
  * a page global object that contains the contents of the 
  * localization array. 
  *  
  * The RESPONSIVE_BREAK_SIZE is the size at which we're 
  * changing our behavior to be responsive.
  */
var CDaily= typeof(CDaily)== 'undefined' ?  {
    "ajaxURL" : cd_scriptvars.ajaxURL,
    "RESPONSIVE_BREAK_SIZE" : 600,
    "DEFAULT_DIALOG_WIDTH"  : 600
} : CDaily ;


/**
 * This function is called by the Detailed List when it's 
 * running in responsive mode. 
 */
CDaily['showSingleEvent']=function(htmlData) {
    CDaily.showDialog(htmlData);
};

/**
 * Display a dialog with event data that's stored locally in
 * JSON. This script is dependent upon jQuery and jQuery UI -
 * Dialog.
 *
 * @param targetID - Selector for element to receive data.
 * @param jsonData - Cached data of events.
 * @param offset - The offset into the array to get the data
 *  			 for.
 */
CDaily["showEventJSON"]=function(jsonData, offset) {
    CDaily.showDialog(jsonData.events[offset]);
};

/**
 * This is a wrapper method for displaying a dialog. It hides 
 * the CMS specific details of how to do it from the rest of the 
 * code. 
 */
CDaily["showDialog"]=function(content,title){
    jQuery(function() {
        if (CDaily.JOOMLA) {
            var myDialog='<div class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="mod_f_a" aria-hidden="true">';
            if (title!=null) {
                myDialog+='<div class="modal-header">'+title+'</div>';
            }
            myDialog+='<div class="modal-body CDDisplayAlways">'+content+'</div>'+
                '<div class="modal-footer">'+
                '<button class="btn" data-dismiss="modal" aria-hidden="true">'+CDaily.Captions["COM_CONNECTDAILY_Close"]+'</button>'+
                '</div>'+
                '</div>';
                           
            var element=jQuery(myDialog);

            if (typeof addthis != 'undefined') {
                /*
                    This is kind of funky, but if you call addthis before the event fires, it doesn't work.
                */
                jQuery(element).on('shown.bs.modal',function(){
                    addthis.toolbox('.addthis_inline_share_toolbox');
                    if (addthis.layers.refresh){
                        addthis.layers.refresh();
                    }
                });
            }
            /*
                Joomla includes the Twitter Bootstrap.modal() method. Use it.
            */
            element.modal('show');
        } else {
            var element=jQuery('<div class="CDDisplayAlways" style="padding: 0.5em;" />'),
                    params={
                    dialogClass: "wp-dialog",
                    height: jQuery(window).height() * 0.8,
                    width: jQuery(window).width() > CDaily.RESPONSIVE_BREAK_SIZE ? CDaily.DEFAULT_DIALOG_WIDTH : 0.9 * jQuery(window).width(),
                    modal: true,
                    zIndex: 10000   // the menu can cause problems so we need to be over it.
                };

            if (title!=null) {
                params['title']=title;
            }
            element.html(content);
            element.dialog(params);
            if (typeof addthis != 'undefined') {
                addthis.toolbox('.addthis_inline_share_toolbox');
                if (addthis.layers.refresh){
                	addthis.layers.refresh();
                }
            }
        }
    });
};

CDaily["leapYear"]=function(yr) {
    if (yr % 4 == 0) {
        if (yr % 400 == 0) {
            return 1;
        } else if (yr % 100 == 0) {
            return 0;
        } else {
            return 1;
        }
    }
    return 0;
};

CDaily["daysPerMonth"]=function(yr, month) {
    var iResult = 0;
    switch (month) {
    case 1:
    case 3:
    case 5:
    case 7:
    case 8:
    case 10:
    case 12:
        iResult = 31;
        break;
    case 2:
        iResult = 28 + CDaily.leapYear(yr);
        break;
    case 4:
    case 6:
    case 9:
    case 11 :
        iResult = 30;
        break;
    default:
        break;
    }
    return iResult;
};

/**
 * Render a month view calendar. This mimics the wordpress
 * wp_get_calendar() function so that appearance and style are
 * identical.
 *
 * @param yr, the year (4 digit integer)
 * @param month, the month 1-12
 * @param hotString - A string of 1's and 0's where a 1 indicates that day has
 *    events, and a 0 indicates it does not.
 *
 * localizationData looks like:
 *
 * data {
 *
 * MonthNames array 0..11 of string
 * AbbrMonthNames array 0..11 of string
 * DayNames array 0..6 of string
 * AbbrDayNames array 0..6 of string
 * DayInitials array 0..6 of String
 * FirstDayOfWeek integer - [0]-[6]
 * }
 */
CDaily["renderCalendar"]=function(yr, month, hotString) {
    
    var localizationData=CDaily.localizationData;
    var sResult = '',iRows = 0,iDay = localizationData.FirstDayOfWeek;
    sResult += '<table class="cd-calendar" id="wp-calendar">';
    sResult += '<caption>' + localizationData.MonthNames[month - 1] + " " + yr + "</caption>";
    sResult += '<thead><tr>';

    for (var i = 0; i < 7; i++) {
        sResult += "<th scope=\"col\" title=\"" + localizationData.DayNames[iDay] + "\">" + localizationData.DayInitials[iDay] + "</th>";
        if (++iDay == 7) {
            iDay = 0;
        }
    }
    /*
        The IDs of prev and next are used by the wordpress calendar and we want to
        inherit their styling.
    */
    sResult += "</tr></thead><tfoot><tr>" +
        "<td colspan=\"3\" id=\"prev\" data-year=\""+yr + "\" data-month=\"" + month + "\" data-direction=\"-1\" class=\"pad\">&#x00ab;</td>" +
        "<td class=\"pad\">&nbsp;</td>" +
        "<td colspan=\"3\" id=\"next\" data-year=\""+yr + "\" data-month=\"" + month + "\" data-direction=\"1\" class=\"pad\">&#x00bb;</td>" +
        "</tr></tfoot><tbody>";

    var dt = new Date(yr, month - 1, 1),iDate = 1,iDaysPerMonth = CDaily.daysPerMonth(yr, month), 
        dToday=new Date(),
        iToday=dToday.getDate(), iThisMonth=dToday.getMonth(), iThisYear=dToday.getFullYear(),
        bFirst = true;
    iDay = dt.getDay();
    do {
        sResult += "<tr>";
        if (bFirst) {
            bFirst = false;
            if (iDay != localizationData.FirstDayOfWeek) {
                if (localizationData.FirstDayOfWeek == 0) {
                    sResult += "<td class=\"pad\" colspan=\"" + iDay + "\">&nbsp;</td>";
                } else {
                    sResult += "<td class=\"pad\" colspan=\"" + (iDay == 0 ? 6 : iDay - localizationData.FirstDayOfWeek) + "\">&nbsp;</td>";
                }
            }
        }
        do {
            if (hotString.charAt(iDate - 1) == '0') {
                sResult += "<td>" + iDate + "</td>";
            } else {
                sResult += "<td><a data-year=\""+yr+"\" data-month=\""+month+"\" data-day=\""+iDate+"\""+
                    (iDate==iToday && yr==iThisYear && (iThisMonth==(month-1)) ? " class=\"CDSelectedDay\"" : "")+
                    ">" + iDate + "</a></td>";
            }
            iDate++;
            if (++iDay > 6) {
                iDay = 0;
            }
        } while (iDate <= iDaysPerMonth && iDay != localizationData.FirstDayOfWeek);
        if (iDay != localizationData.FirstDayOfWeek) {
            // We're at month end. Pad it out.
            if (localizationData.FirstDayOfWeek == 0) {
                sResult += '<td class="pad" colspan="' + (7 - iDay) + '">&nbsp;</td>'
            } else {
                sResult += '<td class="pad" colspan="' + (iDay == 0 ? 1 : 7 - iDay + localizationData.FirstDayOfWeek) + '">&nbsp;</td>'
            }
        }
        sResult += "</tr>";
    } while (iDate <= iDaysPerMonth);
    sResult += '</tbody>';
    sResult += '</table>';
    return sResult;
};

CDaily["showEventsForDay"]=function(htmlData, theDate, targetDiv) {
    //  console.log("htmlData="+htmlData);
    /*
        Try to pick out the locale formatted date from
        the content stream.
    */
    var expr=new RegExp("^<h1 [^>]+>([^<]+)</h1>"),
        a=expr.exec(htmlData.trim());
    if (Array.isArray(a)) {
        theDate=a[1];
    }
    /*
        Show the dialog.
    */
    if (targetDiv==null || (typeof targetDiv == 'undefined')) {
        CDaily.showDialog(htmlData, theDate);
    } else {
        jQuery(targetDiv).html('<h2>'+theDate+'</h2>'+htmlData);
        if (typeof addthis != 'undefined') {
            addthis.toolbox('.addthis_inline_share_toolbox');
            if (addthis.layers.refresh){
                addthis.layers.refresh();
            }
        }
    }

    
};

CDaily["getJulianDayNumber"]=function(yr, mo, da) {
    var dt = new Date(yr, mo - 1, da);
    return Math.floor((dt.getTime() / 86400000) -
                      (dt.getTimezoneOffset() / 1440) + 2440588);

};


CDaily["stopEvent"]=function(event) {
    if (event != null && event.stopPropagation) {
        event.stopPropagation();
    }
};

/**
 * Add translation captions to the CDaily Global object.
 */
CDaily["addCaptions"]=function(newCaptions){

    if (!CDaily.hasOwnProperty("Captions")) {
        CDaily["Captions"]={};
    }
    var captions=CDaily.Captions;
    for (var i=0; i < newCaptions.captions.length; i++) {
        var thisCaption=newCaptions.captions[i];
        captions[thisCaption.caption]=thisCaption.value;
    }

}

/**
 * Test if this browser supports date fields in a real way.
 */
CDaily["browserSupportsDateFields"]=function(){
    /* 
       This works by instantiating a date input, setting
       the value to an invalid value, and then reading
       the value back out.
     
       If it's really a date value, the invalid value won't
       come back.
    */
    var b=document.createElement('input');
    try {
        b.type='date';
        b.value='banana';
    } catch (err) {
        // IE throws an error here. Catch it. 
        return false;
    }
    return b.value!='banana';
};

/**
 * Setup the various event hooks for the add events form.
 */
CDaily["setupAddEventsForm"]=function(){
    /*
        Remove the required attribute from the hidden
        display-none field.
    */
    jQuery('#idCDSB').removeProp('required');


    if (!CDaily.browserSupportsDateFields()) {
        /*
            The browser doesn't support date pickers, use a javascript one.
        */
        if (typeof jQuery.datepicker == 'object') {
            jQuery('#idCDstarting_date, #idCDending_date, #idCDrecurrence_start, #idCDrecurrence_end').datepicker({"dateFormat": "yy-mm-dd"});
        }
    }

    /*
        On Calendar Dropdown change, set event type to default.
    */
    var dd=document.getElementById('idCDcalendar_id');
    if (dd!=null) {
        jQuery(dd).on('change',function(event){
            var dd=event.target,
                type=jQuery(dd.options[dd.selectedIndex]).attr('data-default_type'),
                ddType=jQuery("#idCDitem_type_id option[value='"+type+"']");
            jQuery(ddType).attr('selected',true);
        });
    }


    /*
        Hook the recurrence type options to show/hide the
        various elements as required.
    */
    jQuery("[name='CDrec_type']").on('click',function(event) {
        var a=[
            '.CDOneTimeFields',
            '.CDAnnualOptions',
            '.CDRepeatOn',
            '.CDRepeatEveryOpt',
            '.CDRepeatEveryN',
            '.CDMonthlyOnly',
            '.CDDOWChecks',
            '.CDOrdinalChecks',
            '.CDDailyFields',
            '.CDWeeklyOnly',
            '.CDRecurring'
        ];

        var sClasses=jQuery(event.target).attr('data-require-classes');
        for (var i=0; i < a.length; i++) {
            jQuery(a[i]).each(function(index) {
                if (sClasses.indexOf(a[i])>=0) {
                    jQuery(this).fadeIn();
                } else {
                    jQuery(this).fadeOut();
                }
            });
        }

    });
    jQuery("input[name='CDrec_type']:checked").click();

    /*
        Hook the start date on-change to auto-populate the end date.
    */
    jQuery('#idCDstarting_date').on('change',function(){
        if (jQuery('#idCDending_date').val()=='') {
            jQuery('#idCDending_date').val(jQuery('#idCDstarting_date').val());
        }
    });

    /*
        Hook the Day of Month number to select the Day Radio
    */
    jQuery('#idCDday').on('change',function(element){
        jQuery('#idCDrgRecurDaily').prop('checked',true);
        });

    jQuery("input[name='CDrecur_array[]']").on('change',function(event){
        if (jQuery(event.target).prop('checked')) {
            jQuery('#idCDrgRecurEvery').prop('checked',true);
        }
    });
    /*
        Hook the Day of week and ordinal checkboxes to select the
        every radio.
    */
    jQuery("[name='CDday_array[]']").on('click',function(event){

        if (!jQuery(event.target).prop('checked')) {
            return;
        }

        var val=parseInt(jQuery(event.target).val());

        jQuery('#idCDrgRecurEvery').prop('checked',true);

        jQuery("[name='CDday_array[]']").each(function(index,element){
            var thisVal=parseInt(jQuery(element).val());
            if (val<8 && thisVal>=8) {
                /*
                    If a day of week is checked, uncheck day, weekday, and weekend day.
                */
                jQuery(element).removeProp('checked');
            } else if (val==8 && thisVal!=val) {
                jQuery(element).removeProp('checked')
            } else if (val>8 && thisVal<= 8) {
                jQuery(element).removeProp('checked');
            }
        });
    });
    /*
        Hooks for Locations
    */
    var loc=document.getElementById('idCDlocation_name');
    if (loc!=null) {
        // The input device can be a text box, or a select depending upon
        // whether the user has permission to add locations.
        if (typeof jQuery(loc).attr('list') == 'string') {
            // This is the text box tied to a list.
            jQuery(loc).on('change',function(event){
                /*
                    Here's what we need to do:
                 
                    find the current value in our option list.
                 
                    if we find the address
                 
                        put the address in the text box.
                 
                        If the address is verified, make the address read-only,
                        otherwise, remove the readonly attribute.
                 
                    else
                 
                        Enable the address text box
                */
                var txtAddress=document.getElementById('idCDlocation_address'),
                    lst=document.getElementById(jQuery(this).attr('list')),
                    curValue=this.value.trim(),
                    bFound=false;
                for (var i=0; i < lst.options.length; i++) {
                    var opt=lst.options[i];
                    if (curValue==opt.value) {
                        bFound=true;
                        document.frmCDAddEventForm.CDlocation_id.value=jQuery(opt).attr("data-location-id");
                        jQuery('#idCDlocation_address').val(jQuery(opt).attr('data-address'));
                        if ("1"==jQuery(opt).attr('data-verified')) {
                            jQuery('#idCDlocation_address').prop('readonly',true);
                        } else {
                            jQuery('#idCDlocation_address').removeProp('readonly');
                        }
                        break;
                    }
                }
                if (!bFound) {
                    document.frmCDAddEventForm.CDlocation_id.value='0';
                    jQuery('#idCDlocation_address').removeProp('readonly');
                }
             });
        } else {
            // This is a select
            jQuery(loc).on('change',function(event) {
                    var opt=this.options[this.selectedIndex];
                    document.frmCDAddEventForm.CDlocation_id.value=opt.value;
                    jQuery('#idCDlocation_address').val(jQuery(opt).attr('data-location_address'));
                });
        }
    }

    jQuery("input[name='CDrec_type']").on('change',function(event){
        var iValue=parseInt(jQuery(event.target).val());
        if ((iValue==0) || (iValue==5)) {
            jQuery('#idCDrgRecurEvery').prop('checked',true);
        }
    });

    /*
        If the Userland submit hook CDaily.userAddSubmitHook
        exists, hook it to the form on submit.
    */
    if (typeof CDaily['userAddSubmitHook'] == 'function') {
        jQuery('#idCDAddEventForm').on('submit',CDaily['userAddSubmitHook']);
    }
    /*
        If the Userland initHook CDaily.userAddInitHook exists,
        invoke it.
    */
    if (typeof CDaily['userAddInitHook'] == 'function') {
        CDaily.userAddInitHook();
    }
};

/**
 * onClick handler for the view events filter.
 */
CDaily["handleEventFilter"]=function(FilterDivID,element) {
    // alert(FilterDivID +" Value: "+element.value+" Checked: "+element.checked);
    var filterID=parseInt(element.value,10),
        bChecked=element.checked,
        allBox=jQuery('#'+FilterDivID+"_All")[0];

    if (filterID==-1) {
        // This is the Check All/Uncheck All checkbox. Set the child checkboxes to follow suit.
        jQuery('#'+FilterDivID+' input[type="checkbox"]').attr("checked",bChecked);
    } else {
        /*
            We're filtering for one specific filterID
        */
        if (bChecked) {
            /*
                Find out if ALL of the filter checkboxes are checked, and if so, set
                the value for the All checkbox.
            */
            var bAll=true;
            jQuery('#'+FilterDivID+' input[type="checkbox"]').each(function(index,ele) { 
                    if (ele.value!="-1") { 
                        bAll &= ele.checked 
                    }  
                });
            if (bAll) {
                allBox.checked=true;
            }
        } else {
            allBox.checked=false;
        }
    }
    jQuery('#'+FilterDivID+'_UncheckAll').css("display", allBox.checked ? "inline" : "none");
    jQuery('#'+FilterDivID+'_CheckAll').css("display", allBox.checked ? "none" : "inline");
    CDaily.applyFilter(FilterDivID);
};

/**
 * Apply the filter based on the current checkboxes. 
 *  
 *      Iterate over them and set the display value for the
 *      events in the calendar. If the item should be displayed,
 *      we set "display" to empty (the default). If it should
 *      be hidden, we set display to "none".
 *  
 *      @param FilterDivID The ID of the Container of the filter
 *                         checkboxes.
 */
CDaily["applyFilter"]=function(FilterDivID) {
    var allBox=jQuery('#'+FilterDivID+"_All")[0];
    if (allBox.checked) {
        jQuery(".CDEventTitle").css("display","");
        jQuery(".CDTimeLabel").css("display",""); 
    } else {
        var showLabels={}, hideLabels=[], anyChecked=false;
        jQuery('#'+FilterDivID+' input[type="checkbox"]').each(function(index,eleOuter) { 
            if (eleOuter.value!="-1") {
                var fld=CDaily[FilterDivID].filter_field,
                    expr='.CDEventTitle['+fld+'="'+eleOuter.value+'"]';
                jQuery(expr).each(function(index,ele){
                    anyChecked|=eleOuter.checked;
                    jQuery(ele).css("display",eleOuter.checked ? "" : "none");
                    var label=jQuery(ele).attr("data-time_label");
                    if ( (typeof label) != 'undefined' ) {
                        if (eleOuter.checked) {
                            showLabels[label]=true;
                            jQuery('#'+label).css("display","");
                        } else {
                            hideLabels.push(label);
                        }
                    }
                });
            }
        });
        if (!anyChecked) {
            jQuery(".CDEventTitle").css("display","none");
            jQuery(".CDTimeLabel").css("display","none"); 
        }
        for (var i = 0; i < hideLabels.length; i++) {
            /*
                Hide labels that are not shared with a displayed
                event.
            */
            if (!showLabels.hasOwnProperty(hideLabels[i])) {
                jQuery('#'+hideLabels[i]).css("display","none");
            }
        }
    }
}

CDaily['concatenateParameters']=function(sURL,sParameters){
    var result=sURL;
    if (sURL.indexOf('?')>0) {
        if (sParameters.indexOf("&")==0) {
            result+=sParameters;
        } else {
            result+="&"+sParameters;
        }
    } else {
        result+="?"+sParameters;
    }
    return result;
}

CDaily['eventClick'] = function(cal_item_id, date) {
    var sURL = CDaily.concatenateParameters(CDaily["ajaxURL"],(CDaily.JOOMLA ? "" : "action=cdaily&sub")+"action=cd_viewitem&format=raw&cal_item_id=" + cal_item_id + "&date=" + date);
    jQuery.ajax( {
        "dataType": "html",
        "timeout": 15000,
        "url": sURL,
        "success": function(data, textStatus, jqXHR) {
            CDaily.showSingleEvent(data);
        }
    }).error(function(jqxhr, status, error) {
            alert(error);
        });
}

