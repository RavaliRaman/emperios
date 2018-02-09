<?php
/**
  * Copyright 2014, MH Software, Inc.
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
/** JOOMLA-COMPAT **/
/** 
 *  This file renders the responsive month view, both the short
 *  code, and when invoked directly.
 */
class CDCalendarWriter extends CDailyBaseRenderer {

    private $lastTimeLabel;
    private $lastStart=0;
    private $time_data;
    private $today;

    public function __construct($plugin) {
        parent::__construct($plugin);
        $this->today=new CDDateTime();
    }

    /**
     * Return the selection dropdown for display on the calendar. 
     * This lets the user select which calendar, event type, etc. 
     * they want to view. 
     * 
     * @param $by_method 
     * @param $by_id 
     * @param $elementID 
     * @param $date 
     */
    private function getSelectionDropdown($by_method, $by_id, $elementID) {
        $reqData = $this->plugin->getPostData('display-calendar', 'jsonp/' . $by_method . '/list.js');
        if (!$reqData->wasSuccess()) {
            return '';
        }
        
        $theData = $reqData->getContentObject();
        $items = $theData->items;

        if (sizeof($items) <= 1) {
            return '';
        }
        $result = "\n<select id=\"" . $elementID . "\" data-type_string=\"" . $theData->type_string . "\" title=\"" . $theData->type_name . "\">";

        foreach ($items as $item) {
            $result .= "<option value=\"" . $item->id . "\"";
            if ($item->id == $by_id) {
                $result .= " selected";
            }
            $result .= ">" . htmlentities($item->name) . "</option>";
        }
        $result .= "</select>";
        return $result;
    }

    /**
     * Determine the time label, and return true if it 
     * should be display. 
     * 
     * @param $lastVal - BY REFERENCE value of the last string that 
     *  			   was displayed.
     * @param $dayStart - The start time for the current day.
     * @param $item 
     *  
     * @return boolean 
     */
    private function displayTimeLabel(&$lastVal, $dayStart, $item) {
        $ret=false;
        if ($item->occurrenceStartTime == null) {   // There's no time.
            $this->lastTimeLabel=null;
        } else if ($item->occurrenceStart < $dayStart) {    // This is a continuation of a multi-day event.
            $this->lastTimeLabel = null;
        } else if ($item->occurrenceStart != $this->lastStart) {    // The time is different than the last.
            $this->lastTimeLabel=null;
            $dt=$this->time_data->getDateTime($item->occurrenceStart / Time_Data::MILLIS_SECOND);
            $lastVal = $dt->format($this->time_data->time_format);
            $ret = true; 
        }
        return $ret;
    }

    /**
     * Render an event.
     * 
     * @param $item 
     */
    private function render_item($item) {
        $result = "<span class=\"CDEventTitle\" ";
        $result .= "data-item_type_id=\"" . $item->item_type_id
            . "\" data-style_id=\"" . $item->style_id
            . "\" data-calendar_id=\"" . $item->calendar_id
            . "\" data-cal_item_id=\"" . $item->cal_item_id
            . (empty($item->location_id) ? '' : '" data-location_id="'.$item->location_id)
            . "\" data-julian_date=\"" . $item->occurrenceStartJulian
            . (empty($this->lastTimeLabel) ? "" : "\" data-time_label=\"$this->lastTimeLabel" )."\" ";
        if (property_exists($item,"busy")) {
            $result.='data-busy="true" ';
        }
        $result .= "title=\"" . htmlentities($item->description, ENT_COMPAT | ENT_HTML401, "UTF-8") . "\">"
            . htmlspecialchars($item->description)
            . "<br></span>";
        return $result;
    }

    /**
     * Render all the events that occur on $date.
     * 
     * @param $date 
     * @param $items 
     */
    private function render_single_day($date, $items) {
        $tz = new DateTimeZone($this->plugin->getTimezone());
        $lStart = Time_Data::MILLIS_SECOND * ($date->getTimestamp() - $tz->getOffset($date));
        $lStartCutoff = $lStart + Time_Data::SECONDS_HOUR * 7 * Time_Data::MILLIS_SECOND;
        $dCutoff = clone $date;
        $dCutoff->incrementDays();
        $lEnd = Time_Data::MILLIS_SECOND * ($dCutoff->getTimestamp() - $tz->getOffset($dCutoff));
        $aRange = array($lStart, $lEnd);

        $tzOffset = $date->getTimezone()->getOffset($date);
        $bSome = false;
        $lastLabel = "~";
        $temp = '';
        foreach ($items as $item) {
            if (false and WP_DEBUG) {
                $dStart = new CDDateTime();
                $dStart->setTimestamp($item->occurrenceStart / Time_Data::MILLIS_SECOND + $tzOffset);
                $dEnd = new CDDateTime();
                $dEnd->setTimestamp($item->occurrenceEnd / Time_Data::MILLIS_SECOND + $tzOffset);
                /* $this->plugin->debugOut("Examining: ".$item->description
                 ."\n\tdate=$date " 
                 ."\n\tdStart=$dStart "
                 ."\n\tdEnd=$dEnd"
                 ."\n\toccurrenceStartDateTime=$item->occurrenceStartDateTime "
                 ."\n\tlStart=$lStart "
                 ."\n\tlEnd=$lEnd "
                 ."\n\toccurrenceStart=$item->occurrenceStart "
                 ."\n\toccurrenceEnd=$item->occurrenceEnd"
                 ."\n\ttzOffset=$tzOffset"
                                                 );
                                                 */
            }

            if ($this->doesRangeOverlap($aRange, array($item->occurrenceStart - $tzOffset * Time_Data::MILLIS_SECOND, $item->occurrenceEnd - $tzOffset * Time_Data::MILLIS_SECOND))) {
                if ($item->occurrenceStart < $lStart && $item->occurrenceEnd <= $lStartCutoff) {
                    /**
                     *  This handles the case where the event ends before the day
                     *  really starts. E.G. a concert that goes from 9:00 PM - 1:00
                     *  AM should not display the event on the end day...
                     */
                    $this->lastStart=0;
                    continue;
                }
                $bSome = true;
                if ($this->displayTimeLabel($lastLabel, $lStart, $item)) {
                    $this->lastTimeLabel="idCDTimeLabel_".$this->plugin->getNextID();
                    $temp .= "<span id=\"$this->lastTimeLabel\" class=\"CDTimeLabel\">" . $lastLabel . "<br></span>";
                }
                $temp .= $this->render_item($item);
                $this->lastStart=$item->occurrenceStart;
            }
        }
        $result = "<td";
        if ($this->today->getDay()==$date->getDay() && $this->today->getMonth()==$date->getMonth() && $this->today->getYear()==$date->getYear() ) {
            /*
                If this is the current date, add an additional style so we can highlight today's date.
            */
            $result.=' class="CDToday"';
        }
        $result .= "><span data-year=\"" . $date->getYear() . "\" data-month=\"" . $date->getMonth() . "\" data-day=\"" . $date->getDay() . "\" data-julian-date=\"" . $date->getJulianDate() . "\" class=\"CDDayNumeral" . ($bSome ? " Clickable" : "") . "\">" . $date->getDay() . "</span><br>"
            . $temp
            . "</td>";
        return $result;
    }

    /**
     * Return the navigation row for the calendar.
     * 
     * @param $date 
     * @param $id 
     * @param $by_method 
     * @param $by_id 
     */
    private function get_navigation_row($date, $id, $by_method, $by_id, $enable_dropdown) {
        $left_url = $this->plugin->getIconURL('COM_CONNECTDAILY_PREVARROW');
        $right_url = $this->plugin->getIconURL('COM_CONNECTDAILY_NEXTARROW');
        $result = "\n<tr class=\"CDNavigationRow\"><th class=\"CDNavPrevious\"><img id=\"imgNavLeft$id\" data-year=\"".$date->getYear()."\" data-month=\"".$date->getMonth()."\" data-direction=\"-1\" class=CDNavIcon src=\"$left_url\" alt=\"" . 
            $this->plugin->translate('COM_CONNECTDAILY_PreviousMonth', 'Navigate calendar to previous month.') . "\" title=\"" . 
            $this->plugin->translate('COM_CONNECTDAILY_PreviousMonth','Navigate calendar to previous month.') . 
            "\"></th><th style=\"width: 71%;\" colspan=\"5\">";
        if ($enable_dropdown) {
            $result .= $this->getSelectionDropdown($by_method, $by_id, "IDCDCriteria$id");
        }
        $result .= "</th><th class=\"CDNavNext\"><img data-year=\"".$date->getYear()."\" data-month=\"".$date->getMonth()."\" data-direction=\"1\" class=CDNavIcon src=\"$right_url\" alt=\"" . 
            $this->plugin->translate('COM_CONNECTDAILY_NextMonth','Navigate Calendar to Next Month') . "\" title=\"" . 
            $this->plugin->translate('COM_CONNECTDAILY_NextMonth','Navigate Calendar to Next Month') . 
            "\"></th></tr>";
        return $result;
    }

    /**
     * Return the headings for the days of the week.
     * 
     * @param $firstDow 
     */
    private function get_day_headings($firstDow) {

        $d = new CDDateTime();
        while ($d->getDow() != $firstDow) {
            $d->incrementDays();
        }
        $result = "\n<tr class=\"CDDayHeadRow\">";
        for ($i = 0; $i < 7; $i++) {
            $result .= "<th><span class=\"CDShortDow\">" . $d->format('D') . "</span> "
                . "<span class=\"CDFullDow\">" . $d->format('l') . "</span></th>";
            $d->incrementDays();
        }
        $result .= "</tr>";
        return $result;
    }

    /**
     * Render the calendar for the month.
     * 
     * @param $date 
     * @param $items 
     * @param $aParameters 
     */
    private function render_month($date, $items, $aParameters) {
        
        extract($aParameters);
        $elementID = $id;
        $firstDow = $this->plugin->getSettings()->start_of_week;
        $lastDow = ($firstDow + 6) % 7;
        $result = "\n<table class=\"CDCalendar" . ("0" == $wrap_events ? " NonWrappingTable" : "") . "\">\n";
        $result .= "<caption>" . $date->format('F') . " " . $date->format('Y') . "</caption>";
        $result .= "<thead>";
        $result .= $this->get_navigation_row($date, $elementID, $by_method, $by_id, $enable_dropdown == '1');
        $result .= $this->get_day_headings($firstDow);

        $dUse = clone $date;
        $mo = $dUse->getMonth();
        $result .= "\n</thead>\n<tbody>";
        $result .= "\n<tr class=\"CDDayRow\">";
        if ($dUse->getDow() != $firstDow) {
            $i = 0;
            $dTemp = clone $dUse;
            do {
                $i++;
                $dTemp->incrementDays(-1);
            } while ($dTemp->getDow() != $firstDow);
            $result .= "<td class=\"CDOffDays\" colspan=\"{$i}\">&nbsp;</td>";
        }
        $row = 0;

        do {
            if ($dUse->getDow() == $firstDow && $row > 0) {
                $result .= "\n<tr class=\"CDDayRow\">";
            }
            $result .= $this->render_single_day($dUse, $items);
            if ($dUse->getDow() == $lastDow) {
                $result .= "</tr>";
            }
            $row++;
            $dUse->incrementDays();
        } while ($dUse->getMonth() == $mo);

        if ($dUse->getDow() != $firstDow) {
            $i = 0;
            do {
                $i++;
                $dUse->incrementDays();
            } while ($dUse->getDow() != $firstDow);
            $result .= "<td class=\"CDOffDays\" colspan=\"{$i}\">&nbsp;</td></tr>";
        }

        $result .= "\n</tbody>\n</table>";
        return $result;
    }

    public function renderStyleCSS(){
        $reqData = $this->plugin->getPostData('styles', 'jsonp/style_id/list.js');
        $result='';
        if ($reqData->wasSuccess()) {
            $co=$reqData->getContentObject();
            foreach ($co->items as $item) {
                $result.="[data-style_id=\"".$item->id."\"] {\n".$item->style."\n}\n";
            }
        }
        return $result;
    }

    /** 
     * This function implements the cdaily_iframe shortcode. 
     *  
     * Although the plugin provides native functionality, we do have 
     * a couple of views (notably planner) where there's no 
     * corresponding CMS equivalent shortcode. Give users the option 
     * of using it if they really need it. 
     */
    function iFrameTag($atts, $content = null) {
        // Our chortcode attributes and default values
        $settings=$this->plugin->getSettings();
        extract(shortcode_atts(array(
            "height" => '1024px',
            "id" => 'cdaily_iframe',
            "options" => '',
            "style" => '',
            "view" => 'View.html',
            "width" => '100%'
        ), $atts));
        // Declare the cdaily variables and values
        $cdaily_url = $settings->url;
        if (empty($cdaily_url)) {
            return '<h1>Notice</h1>You must go to the settings tab for Connect Daily and enter the URL to the calendar.';
        }
        $cdaily_url .= $view;
        if ($options != '') {
            $cdaily_url .= '?' . $options;
        }
        // Build the HTML tag to return
        return "<iframe id=\"$id\" style=\"$style height: $height; width: $width;\" src=\"$cdaily_url\"></iframe>";
    }

    public function renderSpecificDay($fields) {
        foreach (array(
            'rollup' => '1',
            'show_resources' => '0',
            'dayspan' => '0',
            'start' => $fields['date']
            ) as $key => $default) {
            if (!array_key_exists($key,$fields) || empty($fields[$key])) {
                $fields[$key]=$default;
            }
        }
        
        $showLink=array_key_exists('render_link',$fields);
        $json_url = 'jsonp/' . $fields['by_method'] . '/' . $fields['by_id'] . '.js';
        $reqData = $this->plugin->getPostData('cdaily-singleday-list', $json_url,$fields,false);
        if (!$reqData->wasSuccess()) {
            return $reqData->getErrorText();
        } else if ($reqData->from_cache) {
            return $reqData->content;
        }
        $result = "";
        // OK, the JSON is in $reqData->content
        $items = $reqData->getContentObject()->items;
        /*
               Iterate over the items
        */
        $dt = new CDDateTime();
        $dt->setDate(intval($fields['yr']), intval($fields['mo']), intval($fields['da']));
        $dt->setTime(12, 0, 0);
        $this->time_data = new Time_Data(true);
        $result .= '<h1 id="DateBanner" class="DateBanner">' . $dt->format($this->time_data->date_format) . '</h1>';
        $skip_resource_types = $this->plugin->getSettings()->skip_resource_types;
        $lister=new CDailyEventsRenderer($this->plugin);
        $lister->showEnds=true;
        
        foreach ($items as $item) {
            /*
                Format each individual item.
            */
            $result .= "\n" . $lister->processEvent($item, $this->time_data, $skip_resource_types,$showLink);
            $this->lastStart=$item->occurrenceStart;
        }
        $result .= "\n<!-- generated at: " . $this->time_data->get_formatted_timestamp() . " -->\n";
        /*
            Save the data in the cache.
        */
        //$this->plugin->debugOut($result);
        $reqData->content = $result;
        $this->plugin->saveDataToCache($reqData);
        return $result;
    }

    /**
     * Generate the event types filter control that works in 
     * conjunction with the responsive full-sized calendar. 
     */
    public function renderEventsFilter($atts,$content=null){

        $pi=$this->plugin;

        foreach (array(
            "by_method" => 'item_type_id',
            "collapse_label" => "(-)",
            "collapse_threshold" => "6",
            "exclude_ids" => "",
            "expand_label" => "(+)",
            "title" => ""
            ) as $key => $default) {
                if (!array_key_exists($key,$atts) || empty($atts[$key])) {
                    $atts[$key]=$default;
                }
        }
        extract($atts);
        $aExclude=array();
        if (!empty($exclude_ids)) {
            $a=explode(",",$exclude_ids);
            $count=0;
            foreach ( $a as $id) {
                if (!empty($id)) {
                    $aExclude[$count++]=intval($id);
                }
            }
        }

        $reqData=$pi->getPostData("event-filter",'jsonp/'.$by_method.'/list.js',$atts,false);

        if (!$reqData->wasSuccess()) {
            return $reqData->getErrorText();
        } else if ($reqData->from_cache) {
            return $reqData->content;
        }

        $items = $reqData->getContentObject()->items;

        if (sizeof($items) <= 1) {
            $reqData->content='';
            $pi->saveDataToCache($reqData);
            return '';
        }

        $divID="IDCDFilter_".$by_method.'_'.$pi->getNextID();
        $useStyleID=false;

        if ($by_method=="item_type_id") {
            
            $info=$pi->getLicenseInfo();
            if ($info!=null){
                if (property_exists($info,"TieItemStyleToItemType")) {
                    $useStyleID=$info->TieItemStyleToItemType;
                }
            }
        } else if ($by_method=='style_id') {
            $useStyleID=true;
        }
    
        $iThreshold=intval($collapse_threshold);
        $collapse = $iThreshold > 0 && sizeof($items) > $iThreshold;
        $result='<form><fieldset id="'.$divID.'" class="CDFilter">';
            
        if (!empty($title) || $collapse) {
            $result.='<legend id="'.$divID.'_Legend"'.($collapse ? ' data-expandable="1"' : '').'>';
            if ($collapse) {
                $result.='<span id="'.$divID.'_Expand">'.$expand_label.'</span>'.
                    '<span id="'.$divID.'_Collapse" style="display: none">'.$collapse_label.'</span>';
            }
            if (!empty($title)) {
                    $result.=htmlspecialchars($title);
            }
            $result.='</legend>';
        }
        $result.='<div id="'.$divID.'_Container"'.($collapse ? ' style="display: none;">' : '>');
        if ($content!=null) {
            $result.=html_entity_decode($content);
        }

        $result.='<label class="CDnon-wrapping"><input id="'.$divID.'_All" type="checkbox" value="-1" checked> '.
            '<span id="'.$divID.'_UncheckAll">'.
            $pi->translate('COM_CONNECTDAILY_UncheckAll').'</span><span id="'.$divID.'_CheckAll" style="display: none;">'.
            $pi->translate("COM_CONNECTDAILY_CheckAll").'</span></label>';

        foreach ($items as $item) {
            if (in_array($item->id,$aExclude)) {
                continue;
            }
            $result.='<label data-'.$by_method.'="'.$item->id.'" '.
                ($useStyleID && $by_method!='style_id' ? 'data-style_id="'.$item->id.'" ' : '').
                'class="CDnon-wrapping"><input type="checkbox" value="'.$item->id.
                '" checked> '.htmlspecialchars($item->name).'</label>';
        }

        $result.='</div></fieldset></form>';
        /*
            Hook the on-click handler to the checkboxes.
        */
        $result.="\n<script type=\"text/javascript\">\n".
            "jQuery(document).ready(function(){\n".
            "   jQuery('#$divID'+' input[type=\"checkbox\"]').click(function() { CDaily.handleEventFilter('$divID',this); });\n".
            "   CDaily['$divID']={ 'filter_field' : 'data-$by_method' };\n";
            
        if ($collapse) {
            $result.='  jQuery("#'.$divID.'_Legend").click(function() {'."\n".
                'var now=jQuery("#'.$divID.'_Container").css("display");'."\n".
                'jQuery("#'.$divID.'_Container").css("display",now=="none" ? "block" : "none" );'."\n".
                'jQuery("#'.$divID.'_Expand").css("display",now=="none" ? "none" : "inline" );'."\n".
                'jQuery("#'.$divID.'_Collapse").css("display",now=="none" ? "inline" : "none"
                 );'."\n".
                "});\n";
        }
        $result.="});\n</script>\n";
        $reqData->content=$result;
        $pi->saveDataToCache($reqData);
        return $result;
    }

    /**
     * Generate output that links to an iCalendar.
     * 
     * @param $atts 
     * @param $content 
     * 
     */
    public function renderiCal($atts, $content = null) {

        $aParameters = shortcode_atts(array(
                                          "by_id"         => '',
                                          "by_method"     => ''
                                          ), $atts);
        extract($aParameters);
        $ical_url = $this->plugin->getAjaxURL("action=cd_icalendar&amp;by_method=$by_method&amp;by_id=$by_id",true);
        $ical_url = "webcal" . substr($ical_url, strpos($ical_url, ":"));
        $result = "<a class=CDiCalendarLink href=\"$ical_url\" title=\"" . 
            $this->plugin->translate('COM_CONNECTDAILY_iCalendarLink') . "\">";
        if ($content != null) {
            $result .= $content;
        }
        $result .= '</a>';
        return $result;
    }

    /**
     * render the Month Calendar. Called by the plugin code, and 
     * directly when this page is invoked. 
     * 
     * @author gsexton (11/8/2014)
     * 
     * @param $args
     * @param $bare_calendar True if the result should be the bare 
     *                       calendar without any javascript.
     */
    public function renderMonth($args, $bare_calendar = false) {
        foreach (array(
              'allow_duplicates' => '1',
              'show_resources' => '0',
              'wrap_events' => '0',
              'id' => 'cdaily_monthview',
              'enable_dropdown' => '0',
              'enable_styles' => '0'
            ) as $key => $default) {
            if (!array_key_exists($key,$args) || empty($args[$key])) {
                $args[$key]=$default;
            }
        }
        $this->plugin->convertOtherOptions($args);
        $args['maxcount']=0;
        $defDate = new CDDateTime();
        if ($defDate->getDay()!=1) {
            $defDate->incrementDays(1-$defDate->getDay());
        }

        if (isset($args['year'])) {
            $defDate->setDate(intval($args['year']),intval($args['month']),1);
        }
        $defDate->setTime(0, 0, 0);
        if (isset($args['offset'])) {
            $defDate->goMonth(intval($args['offset']));
        }
        $args['dayspan']=$defDate->daysPerMonth($defDate->getYear(), $defDate->getMonth()) + 2;
        $args['start']=$defDate->getJulianDate() - 1;

        $id=$args['id'].$this->plugin->getNextID();

        $json_url = 'jsonp/' . $args['by_method'] . '/' . $args['by_id'] . '.js';
        if ($bare_calendar) {
            
            /*
                Connect Daily doesn't actually use this paramter,
                but we put it into the request as part of the URL
                for the caching sub-system to distinguish the
                bare version of the calendar from the non-bare.
            */
            $args['bare_calendar']=1;
        }
        if ($args['enable_styles']) {
            $this->plugin->addEventStyles();
        }

        $reqData = $this->plugin->getPostData('display-calendar', $json_url, $args, false);
        if (!$reqData->wasSuccess()) {
            return $reqData->getErrorText();
        } else if ($reqData->from_cache) {
            return $reqData->content;
        }
        extract($args);
        $result = "";
        // OK, the JSON is in $cached_data
        $items = $reqData->getContentObject()->items;
        /*
               Iterate over the items
        */
        $this->time_data = new Time_Data(true,$args);
        
        
        if ($bare_calendar) {
            $result = '';
        } else {
            $result .= "<div id=\"CDMonthViewContainer$id\">";
            $ajaxOptions='';
            $aSkips=array('by_method','by_id','datefmt','other_options','id');
            foreach ($args as $key => $value){
                if (!in_array($key,$aSkips)) {
                    $ajaxOptions.='&'.$key.'='.urlencode($value);
                }
            }
        }
        
        $result .= $this->render_month($defDate, $items, $args);
        $day_url = $this->plugin->getAjaxURL('action=cd_displayday&format=raw');
        $item_url = $this->plugin->getAjaxURL('action=cd_viewitem&format=raw&cal_item_id=');
        $cal_url = $this->plugin->getAjaxURL('action=cd_calendar&format=raw');
        if (!$bare_calendar) {

            $result .= <<<EOF
</div>		

<script type="text/javascript">

jQuery(document).ready(function(){
    var by_method="$by_method",
        by_id="$by_id",
        container_id="#CDMonthViewContainer$id",
        dlg_id="#CDEventDayDialog$id",
        cd_displayoptions="$ajaxOptions";

    /**
    * Attach the onclick handlers to the day numerals and the 
    * events. 
    */
    attachHandlers();

    function attachHandlers(){

	jQuery(container_id+" .CDDayNumeral.Clickable").click(function(){
        var yr=parseInt(jQuery(this).attr("data-year")),
            mo=parseInt(jQuery(this).attr("data-month")),
            da=parseInt(jQuery(this).attr("data-day"));

        jQuery.ajax({
            "dataType" : "html",
            "timeout" : 15000,
            "url" : "$day_url&by_method="+by_method+
                "&by_id="+by_id+
                "&date="+jQuery(this).attr('data-julian-date')+
                "&yr="+yr+
                "&mo="+mo+
                "&da="+da,
            "success" : function(data,textStatus,jqXHR){
                CDaily.showEventsForDay(data,new Date(yr,mo-1,da).toDateString());
                }
            }).error(function(jqxhr,status,error){
                alert(error);
            });
	    });

	jQuery(container_id+" .CDEventTitle").not('[data-busy=true]').click(function(){

        jQuery.ajax({
            "dataType" : "html",
            "timeout" : 15000,
            "url" : "$item_url"+jQuery(this).attr('data-cal_item_id')+"&date="+jQuery(this).attr('data-julian_date'),
            "success" : function(data,textStatus,jqXHR){
                CDaily.showDialog(data);
                }
        }).error(function(jqxhr,status,error){
            alert(error);
        });
	}); // EventTitle.click

        

    jQuery(container_id+" .CDNavIcon").click(function(){

        var sURL="$cal_url&by_method="+by_method+"&by_id="+by_id+
            "&year="+jQuery(this).attr("data-year")+
            "&month="+jQuery(this).attr("data-month")+
            "&offset="+jQuery(this).attr("data-direction")+
            cd_displayoptions;

        jQuery.ajax({
            "dataType" : "html",
            "timeout" : 15000,
            "url" : sURL,
            "success" : function(data,textStatus,jqXHR){
                // code for success
                jQuery(container_id).html(data);
                jQuery(document).ready(function(){
                    jQuery('fieldset.CDFilter').each(function(index,ele){ CDaily.applyFilter(ele.id); });
                    attachHandlers();
                });
                }
           }).error(function(jqxhr,status,error){
                alert(error);
           });

    }); // This binds the on-clicks for the arrows.

    var ele=jQuery("#IDCDCriteria$id");
    if (ele!=null) {
            jQuery(ele).change(function(){
                var nav=jQuery("#imgNavLeft$id");
                by_id=jQuery(ele).val();

                var sURL="$cal_url&by_method="+by_method+"&by_id="+by_id+
                    "&year="+jQuery(nav).attr("data-year")+
                    "&month="+jQuery(nav).attr("data-month")+
                    "&offset=0"+
                    cd_displayoptions;

                jQuery.ajax({
                    "dataType" : "html",
                    "timeout" : 15000,
                    "url" : sURL,
                    "success" : function(data,textStatus,jqXHR){
                        // code for success
                        jQuery(container_id).html(data);
                        jQuery(document).ready(function(){
                            jQuery('fieldset.CDFilter').each(function(index,ele){ CDaily.applyFilter(ele.id); });
                            attachHandlers();
                        }); 
                        
                        }
                   }).error(function(jqxhr,status,error){
                            alert(error);
                           });


            });
    }

    }   // Attach Handlers Function

}); // Document ready function for this calendar.

</script>
EOF;
        $result .= $this->plugin->getRequiredCaptions(array('Close'));
        }
        $result .= "\n<!-- generated at: " . $this->time_data->get_formatted_timestamp() . " -->\n";
        
        /*
            Save the data in the cache.
        */
        $reqData->content = $result;
        $this->plugin->saveDataToCache($reqData);
        if ($reqData->getJSONError()!=null) {
            /*
                A JSON Encoding Error happend. Append it to the output so we can see
                what is happening.
            */
            $result.=$reqData->getErrorText();
        }
        return $result;
    }

    public function renderMiniCalendar($args,$id='cdaily-minicalendar'){
        // Display the widget on website.


        $targetID="calendar_wrap_$id"."_".$this->plugin->getNextID();

        $localizationdata=$this->plugin->getLocaleHelper()->getLocaleAsJSON();

        $day_url=$this->plugin->getAjaxURL("action=cd_displayday&format=raw");
        $day_map_url=$this->plugin->getAjaxURL("action=cd_daymap&format=raw");
        $this->plugin->convertOtherOptions($args);
        $displayDiv=array_key_exists('target',$args) ? '"'.$args['target'].'"' : "null";

        $result='<div ID="'.$targetID.'" class="widget_calendar calendar_wrap"><table class="cd-calendar" id="wp-calendar"><caption>&nbsp;</caption><thead><tr><th scope="col" title="Sunday">S</th><th scope="col" title="Monday">M</th><th scope="col" title="Tuesday">T</th><th scope="col" title="Wednesday">W</th><th scope="col" title="Thursday">T</th><th scope="col" title="Friday">F</th><th scope="col" title="Saturday">S</th></tr></thead><tfoot><tr><td colspan="3" id="prev" class="pad">&nbsp;</td><td class="pad">&nbsp;</td><td colspan="3" id="next" class="pad">&nbsp;</td></tr></tfoot><tbody><tr><td colspan="6" class="pad">&nbsp;</td><td>1</td></tr><tr><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td></tr><tr><td>9</td><td>10</td><td id="today">11</td><td>12</td><td>13</td><td>14</td><td>15</td></tr><tr><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td></tr><tr><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td><td>29</td></tr><tr><td>30</td><td>31</td><td class="pad" colspan="5">&nbsp;</td></tr></tbody></table></div>';

        /*
            To Save the round trip, get the for initial load.        
        */
        $tmpDate=new CDDateTime();
        if ($tmpDate->getDay()!=1) {
            $tmpDate->incrementDays(1-$tmpDate->getDay());
        }

        $yr=$tmpDate->getYear();
        $mo=$tmpDate->getMonth();
        
        
        ksort($args);
        foreach ($args as $key => $value) {
            if (!empty($value) || $value==='0') {
                $day_url.='&'.$key.'='.urlencode($value);
                $day_map_url.='&'.$key.'='.urlencode($value);
            }
        }
        $ajaxURL='';
        $aSkips=array('by_method','by_id','datefmt','other_options','id','target');    
        foreach ($args as $key => $value){
            if (!in_array($key,$aSkips)) {
                $ajaxURL.='&'.$key.'='.urlencode($value);
            }
        }

        
        $json_url='jsonp/'.$args['by_method'].'/daymap/'.$args['by_id'].'.js';
        $args['start']=$tmpDate->getJulianDate();
        $reqData=$this->plugin->getPostData('daymap',$json_url,$args);
        if (!$reqData->wasSuccess()) {
            return;
        }
        $load_data=$reqData->getContentObject();

        $day_map_url.=$ajaxURL.'&date=';
        $day_url.=$ajaxURL.'&date=';
        $result .= $this->plugin->getRequiredCaptions(array('Close'));
        $result .= <<<EOF

<script type="text/javascript">
    CDaily["localizationData"]=$localizationdata;

jQuery(document).ready(function(){

    /**
     * Attach the navigation and on-click handlers to the rendered 
     * mini-calendar. 
     */
    function attachHandlers(){
    

        jQuery("#$targetID td[data-direction]").click(function(){
            var year=parseInt(jQuery(this).attr("data-year"),10),
                month=parseInt(jQuery(this).attr("data-month"),10),
                offset=parseInt(jQuery(this).attr("data-direction"));

            month+=offset;
            if (month>12) {
                year++;
                month=1;
            } else if (month==0) {
                year--;
                month=12;
            }
            var iJulian=CDaily.getJulianDayNumber(year,month,1);
            jQuery.ajax({
                        "dataType" : "jsonp",
                        "timeout" : 15000,
                        "url" : "$day_map_url"+iJulian,
                        "success" : function(data,textStatus,jqXHR){
                        var result=CDaily.renderCalendar(year,month,data.dayMap);
                        jQuery("#$targetID").html(result);
                        attachHandlers();
                       }
                   }).error(function(jqxhr,status,error){
                            console.log(jqxhr);
                            alert(error);
                       });
        }); // Add Click function.

        jQuery("#$targetID a[data-day]").click(function(){
                var year=jQuery(this).attr("data-year"),
                    month=jQuery(this).attr("data-month"),
                    day=jQuery(this).attr("data-day"),
                    selectedLink=this;

                jQuery.ajax({
                        "dataType" : "html",
                        "timeout" : 15000,
                        "url" : "$day_url"+CDaily.getJulianDayNumber(year,month,day)+"&yr="+year+"&mo="+month+"&da="+day+($displayDiv=="null" ? "" : "&render_link=1"),
                        "success" : function(data,textStatus,jqXHR){
                        CDaily.showEventsForDay(data,new Date(year,month-1,day).toDateString(),$displayDiv);
                        if ($displayDiv!="null") {
                            jQuery("a[data-day]") . removeClass("CDSelectedDay");
                                 jQuery(selectedLink).addClass("CDSelectedDay");
                        }
                       }
                   }).error(function(jqxhr,status,error){
                            alert(error);
                           });
        }); // dayClick function.

    }   // attachHandlers()
    /**
     * Start the calendar draw process.
     */
    var result=CDaily.renderCalendar($yr,$mo,"$load_data->dayMap");

    jQuery("#$targetID").html(result);
    attachHandlers();

}); // jQuery.ready()
</script>
EOF;
        return $result;
    }
}
