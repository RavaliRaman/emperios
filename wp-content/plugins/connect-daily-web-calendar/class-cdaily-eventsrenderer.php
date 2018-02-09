<?php
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
/** JOOMLA-COMPAT **/
/**
 * This class is for rendering Connect Daily events as lists.
 * 
 * @author gsexton (3/24/16)
 */
class CDailyEventsRenderer extends CDailyBaseRenderer {

    private $showTimes=false;
    public $showEnds=false;
    private $iCalLinks=false;

    public function __construct($plugin) {
        parent::__construct($plugin);
        $info=$plugin->getLicenseInfo();
        if ($info!=null) {
            $this->iCalLinks=$info->AnonymousDataExport;
        }
    }

    /**
     * Return a link to a map for a location. The result is returned 
     * as an unterminated "<a>" tag. 
     * 
     * @param $location 
     */
    private function get_maplink($location) {
        $result = '<a class=EventMapLink onclick="return CDaily.stopEvent(event);" target=_blank href="'.$this->plugin->getMapProviderURL();
        $s = '';
        if ($location->latitude != null && $location->longitude != null) {
            $s = number_format($location->latitude, 4) .
                " "
                . number_format($location->longitude, 4);
        } else {
            $s = $location->location_name;
            if ($location->location_address != null && $location->location_name!=$location->location_address) {
                $s .= ', ' . $location->location_address;
            }
        }
        $result .= urlencode($s) . '">';
        return $result;

    }
    /**
     * Return a location, by going over the resources array and
     * returning the name of the first one marked as a location.
     *
     * @author gsexton (12/5/2012)
     *
     * @param $resources
     */
    private function get_location($item) {
        $location = $item->location;
        if ($location != null) {
            $map = $this->get_maplink($location);
            if ($location->location_address == null || $location->location_address===$location->location_name) {
                $result = '<span class=EventLocationName>'
                    . $map
                    . $location->location_name
                    . '</a></span>';
            } else {
                $result = '<span class=EventLocationName>' . $location->location_name . '</span>'
                    . '<span class=EventLocationAddress>, ' . $map . $location->location_address . '</a></span>';
            }
            return $result;
        }
        $resources = $item->resources;
        foreach ($resources as $resource) {
            if ($resource->is_location) {
                return $resource->name;
            }
        }
        return null;
    }


    /**
     * Get the banner for the event time.
     *
     * @author gsexton (12/5/2012)
     *
     * @param $item - The event we're processing.
     * @param $time_data - see __contruct Time_Data()
     */
    private function get_time_banner($item, &$time_data) {
        $format = null;
        if ($time_data->single_date) {
            if ($item->occurrenceStartTime != null) {
                $format = $time_data->time_format;
            }
        } else {
            if ($item->occurrenceStartTime == null) {
                $format = $time_data->date_format;
            } else {
                $format = $time_data->datetime_format;
            }
        }
        $result = '';
        if ($format != null) {
            $dt = $time_data->getDateTime($item->occurrenceStart / Time_Data::MILLIS_SECOND); 
            $time = $dt->format($format);
            if ($this->showEnds) {
                $result=$time.$this->get_end_time($item,$time_data);
                $time_data->last_time = $result;
            } else {
                if ($time != $time_data->last_time) {
                    $result = $time;
                    $time_data->last_time = $result;
                }
            }
        }
        return $result;
    }

    /**
     * This method makes the contact info field clickable. IOW, if
     * the field contains a url, or if it contains Email addresses,
     * then those are converted to A tags.
     *
     * @author gsexton (12/5/2012)
     *
     * @param $s_info - The contact info value.
     * @param $description - The event title.
     *
     * @return The url-ized value of $s_info.
     */
    private function make_info_clickable($s_info, $description) {
        if (empty($s_info)) {
            return '';
        }
        if (stripos($s_info, "http") === 0 || stripos($s_info, "www") === 0) {
            // TODO: This works in WordPress because esc_url adds the scheme. Do something similar in joomla.
            return '<a href="' . (function_exists('esc_url') ? esc_url($s_info) : $s_info) . '" target=_blank>' . $s_info . '</a>';
        }
        $email_pattern = '/[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/';

        if (preg_match($email_pattern, $s_info)) {
            $replace_val = '<a href="mailto:${0}?subject=' . str_replace(' ', '%20', htmlentities($description)) . '">${0}</a>';
            $s_info = preg_replace($email_pattern, $replace_val, $s_info);
        }

        return $s_info;
    }

/**
 * Retrieve the contact info for the event.
 */
    private function get_contact_info($event) {
        $result = '';
        if ($event->contact_name != null || $event->contact_info != null) {
            $result = '<dl class=EventContact><dt>' . $this->plugin->translate(CDailyPlugin::CAPTION_PREFIX."Contact",'The person to contact for information about the event.') . '</dt><dd>';
            if ($event->contact_name != null) {
                $result .= $event->contact_name;
            }
            if ($event->contact_info != null) {
                if ($event->contact_name != null) {
                    $result .= '<br>';
                }
                $result .= $this->make_info_clickable($event->contact_info, $event->description);
            }
            $result .= '</dl>';
        }
        return $result;
    }

    /**
     * Render an iCalendar export link for a specific event.
     */
    private function get_ical_link($event){
        $ical_url=$this->plugin->getAjaxURL("action=cd_icalendar&amp;format=raw&amp;by_method=cal_item_id&amp;by_id=".$event->cal_item_id,true);
        $ical_url="webcal".substr($ical_url,strpos($ical_url,":"));
        $ical_url="\n<a class=\"CDiCalendarLink CDNonMobile\" href=\"".$ical_url."\" title=\"".$this->plugin->translate("COM_CONNECTDAILY_iCalExport")."\">".
            "<img class=\"CDNavIcon\" src=\"".$this->plugin->getIconURL('COM_CONNECTDAILY_CALENDARICON')."\">".
            "</a><br>\n";
        return $ical_url;
    }

    /**
     * Process a single event.
     *
     * @param $item - The event object
     * @param $time_data - Timeformatting data. Has two fields,
     *                  ->single_date true if all events are on a
     *                   single date, and last_time, the timestamp
     *                   value used last .
     * @param $skip_resource_types - IDs of resource types to skip.
     * @param $include_link - True to include a link to
     *                       showSingleEvent.
     * 
     * @return string The text formatted representation of the
     *         event.
     */
    public function processEvent($item, &$time_data, $skip_resource_types = "", $include_link = false) {
        $s_item = $this->get_time_banner($item, $time_data);
        if (!empty($s_item)) {
            $s_item = '<p class="EventTimeBanner">' . $s_item . '</p>';    
        }
        if (property_exists($item, "busy")) {
            $s_item.='<p class="EventDescription" data-busy="true">'. htmlspecialchars($item->description).'</p>';
            return $s_item;
        }
        
        $s_item .= "<p data-item-type-id=\"{$item->item_type_id}\" class=\"EventTitle CDMinimalUIClickableTitle\"";
        if ($include_link) {
            $s_item .= " onclick=\"return CDaily.eventClick({$item->cal_item_id},{$item->occurrenceStartJulian});\"";
        }
        $s_item .= ">" . htmlspecialchars($item->description);

        $s_location = $this->get_location($item);
        if ($s_location != null) {
            $s_item .= '<span class=EventLocationName> - ' . $s_location . '</span>';
        }

        $s_item .= '</p>';

        if ($this->shareHelper!=null && !empty($item->add_info_url)) {
            $s_item .= $this->shareHelper->getSingleItemLink($item->add_info_url, $item->description);
        }

        if ($this->iCalLinks) {
            $s_item .= $this->get_ical_link($item);
        }

        $s_item .= $this->get_contact_info($item);
        if ($item->add_info_url != null) {
            $s_item .= '<p class=EventLink><a class="EventLink" href="' . $item->add_info_url . '" target=_BLANK>' . $item->add_info_url . '</a></p>';
        }
        $s_item .= $this->get_attachments($item);
        $s_item .= $this->get_resources($item->resources, $skip_resource_types);
        if ($item->long_description != null) {
            $s_item .= '<p class="EventDescription">' . $item->long_description . '</p>';
        }
        return $s_item;
    }


    /**
     * Process the attachments for the event.
     *
     * @param $event
     *
     * @return HTML representation of attachments.
     */
    private function get_attachments($event) {
        $result = '';
        foreach ($event->attachments as $attachment) {
            $result = "\n<div class=EventAttachment>";
            if (preg_match("/image\\/.+/i", $attachment->mime_type) == 1) {
                if ($attachment->thumbnail == null) {
                    $result .= "<img src=\"$attachment->url\">";
                } else {
                    $result .= "<a href=\"$attachment->url\" title=\"$attachment->file_name; $attachment->mime_type\">" .
                        "<img alt=\"$attachment->file_name\" src=\"$attachment->thumbnail\"";
                    if (property_exists($attachment,'thumbnail_height')) {
                        $result .= ' style="height: '.$attachment->thumbnail_height.'px; width: '.$attachment->thumbnail_width.'px;"';
                    }
                    $result .= '></a>';
                }
            } else {
                $result .= "<a href=\"$attachment->url\" title=\"$attachment->file_name; $attachment->mime_type\">";
                if ($attachment->thumbnail == null) {
                    $result .= $attachment->file_name;
                } else {
                    // thumbnail
                    $result .= "<img alt=\"$attachment->file_name\" src=\"$attachment->thumbnail\"";
                    if (property_exists($attachment,'thumbnail_height')) {
                        $result .= ' style="height: '.$attachment->thumbnail_height.'px; width: '.$attachment->thumbnail_width.'px;"';
                    }
                    $result .= '>';
                }
                $result .= '</a>';
            }
            if ($attachment->description != null) {
                $result .= '<p>' . $attachment->description . '</p>';
            }
            $result .= "</div>\n";
        }
        return $result;
    }

    /**
     * This method prints the resources.
     *
     * @param $resources
     * @param $skip_resource_types - Comma-separated list of 
     *                             resource type names to skip, or *
     *                             for all.
     */
    private function get_resources($resources, $skip_resource_types = "") {
        if ($skip_resource_types==='*') {
            return '';
        }
        $s = '';
        $sType = "~";
        $found = false;
        $foundType = 0;
        foreach ($resources as $resource) {
            if (strpos("," . $skip_resource_types . ",", "," . $resource->type_description . ",") === false) {
                if ($sType != $resource->type_description) {
                    if ($found) {
                        $s .= '</dl>';
                    } else {
                        $found = true;
                    }
                    $sType = $resource->type_description;
                    $s .= '<dl class="cd_resource_list"><dt>' . $sType . '</dt><dd>';
                    $foundType = 0;
                }
                if ($foundType++ > 0) {
                    $s .= '<br/>';
                }
                $s .= $resource->name;
            }
        }
        $s .= '</dl>';
        return ($found ? $s : '');
    }

    /**
     * Actually generate the simple list.
     *
     * @param $arguments
     * @param $id - This argument names the DL element that's
     *            created. Additionally, it's used to name the
     *            Javascript JSON variable, so the id should only
     *            contain characters that are valid in a javascript
     *            variable name.
     * 
     * @return string The generated output. 
     */
    public function renderSimpleList($arguments, $id = 'cdaily_simple_list') {
        
        if (isset($arguments['show_starttimes'])) {
            $this->showTimes=!empty($arguments['show_starttimes']);
        }
        if (isset($arguments['show_endtimes'])) {
            $this->showEnds=!empty($arguments['show_endtimes']);
        }

        if (isset($arguments['skip_resource_types'])) {
            $skip_resource_types = $arguments['skip_resource_types'];
        } else {
            $skip_resource_types = $this->plugin->getSettings()->skip_resource_types;
        }
        $arguments=$this->plugin->convertOtherOptions($arguments);
        $arguments['show_resources']=0;

        $s_url = 'jsonp/' . $arguments['by_method'] . '/' . $arguments['by_id'] . '.js';
        
        $reqData = $this->plugin->getPostData('cdaily-simplelist', $s_url,$arguments , false);
        if (!$reqData->wasSuccess()) {
            return $reqData->getErrorText();
        } else if ($reqData->from_cache) {
            return $reqData->content;
        }

        // echo "<!-- dayspan=$dayspan -->";
        $tdata = new Time_Data($arguments['dayspan'] == 0, $arguments);
        if ($tdata->single_date) {
            $datefmt = $tdata->time_format;
        } else {
            if (array_key_exists('datefmt',$arguments) && !empty($arguments['datefmt'])) {
                $datefmt=$arguments['datefmt'];
            } else {
                $datefmt=$tdata->date_format;
            }
        }
        
        $events = $reqData->getContentObject()->items;
        if (array_key_exists("allow_duplicates",$arguments) && $arguments['allow_duplicates']=='1') {
            $events=$this->processDuplicates($events);
        }
        $result = "\n<dl Class=EventSimpleList id=\"" . $id . '">';
        $ilast = -1;
        $a_events = array();
        $i_array_pos = 0;
        $jsVarID = 'EventsJSON' . $id . '_' . $arguments['by_method'] . '_' . $arguments['by_id'];
        foreach ($events as $event) {
            $dt=$tdata->getDateTime($event->occurrenceStart / Time_Data::MILLIS_SECOND);
            if ($tdata->single_date) {
                if ($ilast != $event->occurrenceStart) {
                    $ilast = $event->occurrenceStart;
                    if ($event->occurrenceStartTime == null) {
                        // If we're doing single dates, and this is an untimed event, the time label is a blank string.
                        $time = '&nbsp';
                    } else {
                        $time = $dt->format($datefmt);
                        if ($this->showEnds) {
                            $time.=$this->get_end_time($event,$tdata);
                        }
                    }
                    $result .= '<dt>' . $time;
                }
            } else {
                if ($ilast != $event->occurrenceStartJulian) {
                    $ilast = $event->occurrenceStartJulian;
                    $time = $dt->format($datefmt);
                    $result .= '<dt>' . $time; 
                }
            }
            $result .= "<dd data-item-type-id=\"{$event->item_type_id}\"";
            if (property_exists($event,"busy")) {
                $result.=' data-busy="true" ';
            } else {
                $result.=" onclick=\"CDaily.showEventJSON(CDaily." . $jsVarID . ',' . $i_array_pos . ");\"";
            }
            $result.=">";
            if ($this->showTimes && $event->occurrenceStartTime!=null) {
                $result.='<span class="CDSLTimeLabel">'.$dt->format($tdata->time_format);
                if ($this->showEnds) {
                    $result.=$this->get_end_time($event,$tdata);
                }
                $result .= '</span> '; 
            }
            $result.=htmlspecialchars($event->description);
            $tdata->last_time = "~";
            /*
                The next bit generates the content displayed when a user clicks            .
                on an event. We always want the end times displayed for event              .
                details.
            */
            $showSave=$this->showEnds;  
            $this->showEnds=true;
            $a_events[$i_array_pos++] = $this->processEvent($event, $tdata, $skip_resource_types);
            $this->showEnds=$showSave;
        }
        if (count($events)==0 && array_key_exists('is_search',$arguments)) {
            $result.='<br><h3>'.$this->plugin->translate('COM_CONNECTDAILY_NoEventsFound').'</h3>';
        }
        $result .= "</dl>\n<!-- Generated: " . $tdata->get_formatted_timestamp() . " -->\n";
        $result .= $this->plugin->getRequiredCaptions(array('Close'));
        $result .= "\n<script type=\"text/javascript\">\nCDaily[\"" . $jsVarID . '"]={ "events" : ' . json_encode($a_events) . '};';
        $result .= "\n</script>\n";
        $reqData->content = $result;
        if (!array_key_exists('is_search',$arguments)) {
            //  Don't save searches to Cache...
            $this->plugin->saveDataToCache($reqData);
        }
        return $result;
    }

    /**
     * Render the Responsive Detailed List of Events. 
     *  
     * @return String the rendered content as text/html 
     */
    public function renderDetailedList($arguments, $id = 'cdaily_detailed_list'){
        /*
            Set the argument defaults if not present.
        */
        foreach (array(
            'datefmt' => false,
            'show_endtimes' => 0,
            'allow_duplicates' => 0,
            'dayspan' => 90,
            'maxcount' => 12,
            'other_options' => false
            ) as $key => $def) {
            if (!isset($arguments[$key]) || empty($arguments[$key])) {
                $arguments[$key]=$def;
            }
        }
        $arguments['show_resources']=0;
        $arguments=$this->plugin->convertOtherOptions($arguments);
        $this->showEnds=!empty($arguments['show_endtimes']);

        $json_url = 'jsonp/' . $arguments['by_method'] . '/' . $arguments['by_id'] . '.js';
        $reqData = $this->plugin->getPostData('cdaily-detailed-list', $json_url, $arguments, false);
        if (!$reqData->wasSuccess()) {
            return $reqData->getErrorText();
        } else if ($reqData->from_cache) {
            return $reqData->content;
        }

        $result = "<div id=\"$id\">";

        // OK, the JSON is in $cached_data
        $items = $reqData->getContentObject()->items;
        $time_data = new Time_Data(!(strpos($json_url, '&dayspan=0') === false),$arguments);
        $skip_resource_types = $this->plugin->getSettings()->skip_resource_types;
        /*
               Iterate over the items
        */
        foreach ($items as $item) {
            /*
                Format each individual item.
            */
            $result .= "\n" . $this->processEvent($item, $time_data, $skip_resource_types, true);
        }
        if (count($items)==0 && array_key_exists('is_search',$arguments)) {
            $result.='<br><h3>'.$this->plugin->translate('COM_CONNECTDAILY_NoEventsFound').'</h3>';
        }
        $result .= "\n<!-- generated at: " . $time_data->get_formatted_timestamp() . " -->\n";
        $result .= "\n</div>\n";
        $result .= $this->plugin->getRequiredCaptions(array('Close'));
        /*
            Save the data in the cache.
        */
        $reqData->content = $result;
        if (!array_key_exists('is_search',$arguments)) {
            // Don't save searches to cache.
            $this->plugin->saveDataToCache($reqData);
        }
        

        return $result;
    }

    /**
     * Process a request for viewing a specific item. 
     *  
     * @return string content type is text/html. 
     */
    public function processViewItem($reqFields) {
        $by_id = $reqFields['cal_item_id'];
        foreach (array(
            'allow_duplicates' => 0,
            'show_resources' => 0
            ) as $key => $default) {
            if (!isset($reqFields[$key]) || empty($reqFields[$key])) {
                $reqFields[$key]=$default;
            }
        }
        if (isset($reqFields['date']) && !isset($reqFields['start'])) {
            $reqFields['start']=$reqFields['date'];
        }

        $json_url = 'jsonp/cal_item_id/' . $by_id . '.js';
        $reqData = $this->plugin->getPostData('cdaily-singleevent-list', $json_url, $reqFields,false);
        if (!$reqData->wasSuccess(false)) {
            return $reqData->getErrorText();
        } else if ($reqData->from_cache) {
            return $reqData->content;
        }

        $result = "";
        // OK, the JSON is in $cached_data
        
        $items = $reqData->getContentObject()->items;

        /*
               Iterate over the items
        */

        $time_data = new Time_Data(true);
        // Force a full time banner to be displayed.
        $time_data->single_date = false;
        $skip_resource_types = $this->plugin->getSettings()->skip_resource_types;
        foreach ($items as $item) {
            /*
                Format each individual item.
            */
            $result .= "\n" . $this->processEvent($item, $time_data, $skip_resource_types);
        }
        $result .= "\n<!-- generated at: " . $time_data->get_formatted_timestamp() . " -->\n";
        /*
            Save the data in the cache.
        */
        $reqData->content = $result;
        $this->plugin->saveDataToCache($reqData);
        return $result;
    }

    /**
     * Copy a Connect Daily event object and return the new 
     * instance. 
     *  
     * @param $item the event to create a copy of. 
     *  
     * @return a copy of the event. 
     */
    private function copyItem($item) {
        $s=json_encode($item);
        return json_decode($s);
    }

    /**
     * This method handles multi-day event duplication for 
     * display. 
     *  
     * @param $items Array of events 
     *  
     * @return array of events expanded. 
     */
    private function processDuplicates($items) {
        if (count($items)==0) {
            return $items;
        }
        $res=array();
        /*
            Steps:
         
            Get the start and end dates.
         
            For each date in the range
         
                Iterate over all the events
         
                If an event occurs during the span of the day,
                copy it and add it to the array.
         
                If the STARTDATE is not on that date,
                BLANK OUT the occurrenceStartTime and re-set
                the occurrenceStartJulian and occurrenceStart
                properties to that date.
        */
        $tz=new DateTimeZone($this->plugin->getTimezone());
        $d=new CDDateTime();
        $dEnd=new CDDateTime();
        $d->setTimestamp($items[0]->occurrenceStart/Time_Data::MILLIS_SECOND);
        $d->setTimezone($tz);
        $d->setTime(0,0,0);
        $dEnd->setTimestamp($items[count($items)-1]->occurrenceEnd/Time_Data::MILLIS_SECOND);
        $dEnd->setTimezone($tz);
        do {
            $today=array($d->getTimestamp(),$d->getTimestamp()+Time_Data::SECONDS_DAY);
            foreach ($items as $event) {
                $thisEvent=array($event->occurrenceStart/Time_Data::MILLIS_SECOND,$event->occurrenceEnd/Time_Data::MILLIS_SECOND);
                if ($this->doesRangeOverlap($today,$thisEvent)) {
                    $t=$event->occurrenceStart/Time_Data::MILLIS_SECOND;
                    if ($t>=$today[0] && $t<=$today[1]) {
                        // the event starts today - do nothing
                    } else {
                        // This is a continuation of a multi-day event, copy and diddle.
                        $event=$this->copyItem($event);
                        $event->occurrenceStartTime=null;
                        $event->occurrenceStart=$d->getTimestamp()*Time_Data::MILLIS_SECOND;
                        $event->occurrenceStartJulian=$d->getJulianDate();
                    }
                    array_push($res,$event);
                    
                }
            }
            $d->incrementDays();
        } while ($d->getTimestamp()<$dEnd->getTimestamp());
        return $res;
    }
}
