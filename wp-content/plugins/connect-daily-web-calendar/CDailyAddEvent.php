<?php
/**
  * Copyright 2016, MH Software, Inc.
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
  * This class implements the Native Add Event Form. 
  *  
 */
require_once 'class-cdaily-datetime.php';

class CDailyAddEvent  {

    /** CDailyPlugin   */
    private $plugin;
    /** Fields and types, and required.   */
    private $fields=null;


    public function __construct($plugin){
        $this->plugin=$plugin;
    }

    public function getFieldsList(){
        if ($this->fields!=null) {
            return $this->fields;
        }
        $this->fields=array(
            "add_info_url" => array("type" => "url", "required" => false,  "maxlength" => 128),
            "cal_item_id" => array("type" => "int", "required" => false),
            "calendar_id" => array("type" => "int", "required" => true),
            "contact_info" => array("type" => "string", "required" => false, "maxlength" => 128),
            "contact_name" => array("type" => "string", "required" => false, "maxlength" => 128),
            "day" => array("type" => "int", "required" => false, "default" => 1),
            "day_array" => array("type" => "intset", "required" => false,"default" => array()),
            "description" => array("type" => "string", "required" => true, "maxlength" => 80),
            "ending_date" => array("type" => "date", "required" => false),
            "ending_time" => array("type" => "string", "required" => false, "maxlength" => 12),
            "item_type_id" => array("type" => "int", "required" => true),
            "location_address" => array("type" => "string", "required" => false, "maxlength" => 255),
            "location_id" => array("type" => "int", "required" => false),
            "location_name" => array("type" => "string", "required" => false, "maxlength" => 128),
            "long_description" => array("type" => "string", "required" => false),
            "month_array" => array("type" => "intset", "required" => false, "default" => array()),
            "rec_type" => array("type" => "int", "required" => true, "default" => 3),
            "recur_array" => array("type" => "intset", "required" => false, "default" => array()),
            "recurrence_end" => array("type" => "date", "required" => false),
            "recurrence_start" => array("type" => "date", "required" => false),
            "recur_option" => array("type" => "int", "required" => false, "default" => 2),
            "resource_list" => array("type" => "intset", "required" => false),
            "rgDailyType" => array("type" => "int", "required" => false, "default" => 1),
            "rinterval" => array("type" => "int", "required" => false, "default" => 1),
            "starting_date" => array("type" => "date","required" => false),
            "starting_time" => array("type" => "string", "required" => false, "maxlength" => 12),
            "VDATA" => array("type" => "string", "required" => false)
        );
        return $this->fields;
    }

    public function getDefaultsObject($addData,$otherDefaults){
        $o=new Stdclass();
        foreach ($this->getFieldsList() as $fldName => $options) {
            if (isset($options['default'])) {
                $o->{$fldName}=$options['default'];
            } else {
                switch ($options['type']) {
                case 'int':
                    $o->{$fldName}=0;
                    break;
                default:
                    $o->{$fldName}='';
                    break;
                }
            }
        }
        if (sizeof($addData->calendars)>0) {
            if (array_key_exists('calendar_id', $otherDefaults)) {
                $o->calendar_id=$otherDefaults['calendar_id'];
            } else {
                $o->calendar_id=$addData->calendars[0]->id;
            }
        }
        foreach ($addData->calendars as $objCalendar) {
            if ($objCalendar->id==$o->calendar_id) {
                // If it's on the request, it will get overridden below.
                $o->item_type_id=$objCalendar->default_type;
            }
        }

        foreach ($otherDefaults as $key => $value){
            if (property_exists($o,$key)) {
                $o->{$key}=$value;
            }
        }
        return $o;
    }

    private function __($mnemonic,$context=null) {
        return $this->plugin->translate($mnemonic,$context);
    }

    private function getDayCheckboxes($lc,$name,$current=array()){
        if (gettype($current)=='string') {
            $t=array();
            foreach (explode(',',$current) as $value) {
                array_push($t,intval($value,10));
            }
            $current=$t;
        }
        $s="\n<fieldset class=\"CDDOWChecks\" id=\"CDDaysOfWeek\">\n";
        $extras=array(
                    $this->plugin->translate('COM_CONNECTDAILY_Day'),
                    $this->plugin->translate('COM_CONNECTDAILY_WeekDay'),
                    $this->plugin->translate('COM_CONNECTDAILY_WeekendDay')
                    );

        $longLabels=array_merge($lc->DayNames,$extras);
        $shortLabels=array_merge($lc->AbbrDayNames,$extras);

        for ($i=0; $i < 10; $i++) {
            $s.='<label class="CDnon-wrapping';
            if ($i>6) {
                $s.=' CDOrdinalChecks';
            }
            $val=$i+1;
            $s.='">'.
                '<input type="checkbox" name="'.$name.'[]" id="id'.$name.$i.'" value="'.$val.'"'.(in_array($val,$current) ? ' checked' : '').'> '.
                '<span class=CDMobile>'.htmlentities($shortLabels[$i]).'</span>'.
                '<span class=CDNonMobile>'.htmlentities($longLabels[$i]).'</span>'.
                "</label>\n";
        }
        $s.="</fieldset>\n";
        return $s;
    }

    private function getOrdinalsCheckboxes($name,$current=array()){
        if (gettype($current)=='string') {
            $t=array();
            foreach (explode(',',$current) as $value) {
                array_push($t,intval($value,10));
            }
            $current=$t;
        }

        $labels=array(null,"1st","2nd","3rd","4th","Last","EveryOther");
        $s="\n<fieldset id=\"CDRecurrenceOrdinals\">";
        for ($i=1; $i < 7; $i++) {
            $s.='<label class="CDnon-wrapping">'.
                '<input type="checkbox" name="'.$name.'[]" id="id'.$name.$i.'" value="'.$i.'"'.(in_array($i,$current) ? ' checked' : '').'> '.
                htmlentities($this->plugin->translate('COM_CONNECTDAILY_'.$labels[$i])).
                "</label>\n";
        }
        $s.="\n</fieldset>\n";
        return $s;
    }

    private function getMonthCheckboxes($lc,$name,$current=array()) {
        if (gettype($current)=='string') {
            $t=array();
            foreach (explode(',',$current) as $value) {
                array_push($t,intval($value,10));
            }
            $current=$t;
        }
        $s="\n<fieldset class=\"CDAnnualOptions\" id=\"CDMonthsOfYear\">\n";
        for ($i=0; $i < 12; $i++) {
            $val=$i+1;
            $s.='<label class="CDnon-wrapping">'.
                '<input type="checkbox" name="'.$name.'[]" id="id'.$name.$i.'" value="'.$val.'"'.(in_array($val,$current) ? ' checked' : '').'> '.
                '<span class=CDMobile>'.htmlentities($lc->AbbrMonthNames[$i]).'</span>'.
                '<span class=CDNonMobile>'.htmlentities($lc->MonthNames[$i]).'</span>'.
                "</label>\n";
        }
        $s.="</fieldset>\n";
        return $s;
    }

    /**
     * @return String
     */
    private function getDropdown($name,$options,$current=0){
        $s='<select name="'.$name.'" id="id'.$name.'">';
        if ('CDlocation_name'==$name) {
            $s.="<option data-location_address=\"\" value=\"0\">".htmlentities($this->__('COM_CONNECTDAILY_SelectLocation'))."</option>";
        }
        foreach ($options as $option) {
            $s.='<option value="'.$option->id.'"';
            foreach ($option as $propName => $propValue ) {
                /*
                    Iterate over the properties on the object and set them
                    as data- attributes on the option.
                */
                switch ($propName) {
                case 'id':
                    break;
                case 'name':
                    break;
                default:
                    $s.=' data-'.$propName.'="'.$propValue.'"';
                    break;
                }
            }
            $s.=($option->id==$current ? ' selected' : '').
                '>'.htmlspecialchars($option->name).'</option>';
        }
        $s.='</select>';
        return $s;
    }

    /**
     * Return our locations as a data-list. The Location input field 
     * uses the datalist to implement a lookup feature. Pretty neat.
     */
    private function getLocationDataList($id, $locations){
        $s="\n<datalist id=\"".$id."\">\n";
        foreach ($locations as $location) {
            
            $s.='<option data-address="'.htmlspecialchars(property_exists($location,'location_address') ? $location->location_address : '').'" '.
                'data-location-id="'.$location->id.'" '.
                'data-verified="'.($location->verified ? '1' : '0').'"'.
                '>'.
                htmlspecialchars($location->name).
                "</option>\n";
        }
        $s.="\n</datalist>\n";
        return $s;
    }

    private function valueEquals($val,$test,$returnTrue='checked',$returnFalse='') {
        if ($val==$test) {
            return $returnTrue;
        } else {
            return $returnFalse;
        }
    }

    private function getRequiredAttribute($fldMeta,$fldName){
        
        return array_key_exists($fldName,$fldMeta) ? ($fldMeta[$fldName]['required'] ? ' required' : '') : '';
    }

    /**
     * Return the resource selection widget as an HTML string. 
     *  
     * @param $resources the Object Array of candidate resources. 
     *  
     * @param $currentSelections The currently selected options (if 
     *                           the form submit fails and it's
     *                           being re-displayed).
     */
    private function getResourceSelector($resources,$currentSelections) {
        if (empty($currentSelections)) {
            $currentSelections=array();
        } else if (gettype($currentSelections)==='string') {
            $currentSelections=explode(',',$currentSelections);
        }
        $s='<div class=CDResourceList><dl>';
        $selected='';
        $available='';
        $curType='~';
        foreach ($resources as $resource) {
            if ($resource->type_description!=$curType) {
                if (!empty($selected) || !empty($available)) {
                    $s.=$selected.$available.'</dd>';
                    $selected='';
                    $available='';
                }
                $curType=$resource->type_description;
                $s.='<dt>'.htmlspecialchars($curType).'<dd>';
            }
            $isSelected=in_array($resource->id,$currentSelections);
            $thisResource='<label><input type="checkbox" name="CDresource_list[]" value="'.$resource->id.'"'
                .' id="CDresource_list_'.$resource->id.'"';
            if ($isSelected) {
                $thisResource.=' checked';
            }
            $thisResource.='> '.htmlspecialchars($resource->name).'</label><br>';
            if ($isSelected) {
                $selected.=$thisResource;
            } else {
                $available.=$thisResource;
            }
        }
        $s.=$selected.$available.'</dd></dl></div>';
        return $s;
    }

    /** 
     * Return the rendered add events form as a String. 
     *  
     * @param $options, options for the form generation. 
     * @param $oCurrent Current value 
     *  
     * @return String - The rendered add Event form.
     */
    public function addEventForm($options,$oCurrent=null){
        $lc=$this->plugin->getLocaleHelper()->getLocale();

       
        $showRecurrence=isset($options['allow_recurrence']) && '1'==$options['allow_recurrence'];
        $addData=$this->plugin->getPostData('add-event-form','json/addData.js',array('request_number' => 'PUBLIC_ADD_DATA'));
        
                
        if (!$addData->wasSuccess()) {
            return $addData->getErrorText();
        }
        $addData=$addData->getContentObject();

        if (!property_exists($this,'timePlaceHolder') && property_exists($addData,'TimeFormat')) {
            $this->{'timePlaceHolder'}=$addData->TimeFormat;
            $this->plugin->{'datePlaceHolder'}=$addData->DateFormat;
        }

        if ($oCurrent==null) {
            $oCurrent=$this->getDefaultsObject($addData,$options);
        } else if (gettype($oCurrent) == 'array') {
            $oCurrent=$this->getDefaultsObject($addData,$oCurrent);
            if ($oCurrent->description!=null) {
                $oCurrent->description=htmlentities($oCurrent->description);
            }
        } 
        $fldMeta=$this->getFieldsList();
        if (isset($options['required_fields'])) {
            $fldMeta=$this->mergeRequiredFields($fldMeta,$options['required_fields']);
        }

        $calendarCount=sizeof($addData->calendars);
        $calInput='';
        if ($calendarCount>1) {
            $calInput=$this->getDropdown('CDcalendar_id',$addData->calendars,$oCurrent->calendar_id);
        } else {
            $calInput='<input type="hidden" name="CDcalendar_id" value="'.$oCurrent->calendar_id.'">';
        }
        $result='<div id="CDailyAddEventsForm">'.
            '<form name=frmCDAddEventForm id="idCDAddEventForm" method="POST">'.
            '<input type="hidden" value="0" name="CDcal_item_id">'.
            '<input type="hidden" value="1" name="CDrgDailyType">'.
            '<input type="text" value="'.$oCurrent->VDATA.'" class="CDMobile CDNonMobile" name="CDVDATA" id="idCDSB" required>';
            
         if ($calendarCount<=1) {
             $result.=$calInput;
         }
         if (!$showRecurrence) {
             $result.='<input type=hidden name="CDrec_type" value="'.$oCurrent->rec_type.'">';
         }
         $result.='<dl>';
        if ($calendarCount>1) {
            $result.='<dt><label for="idCDcalendar_id">'.$this->__('COM_CONNECTDAILY_Calendar').'</label></dt>'.
                $calInput;
        }
        $result.=<<<EOFONE

            <dt><label for="idCDTitle">{$this->__('COM_CONNECTDAILY_Title')}</label></dt>
            <dd><input type="text" name="CDdescription" id="idCDTitle" value="{$oCurrent->description}" maxlength="{$fldMeta['description']['maxlength']}" required autofocus></dd>

            <dt><label for="idCDitem_type_id">{$this->__('COM_CONNECTDAILY_ItemType')}</label></dt>
            <dd>{$this->getDropdown('CDitem_type_id',$addData->calitemtypes,$oCurrent->item_type_id)}</dd>
EOFONE;
        if ($showRecurrence) {
            $result.=<<<EOFTWO
            <dt><label for="idCDTitle">{$this->__('COM_CONNECTDAILY_Recurrence')}</label></dt>
            <dd>
            <fieldset>
            <label class="CDnon-wrapping" for="idCDrecur_type_onetime">
                <input data-require-classes='.CDOneTimeFields' type="radio" name="CDrec_type" id="idCDrecur_type_onetime" value="3" {$this->valueEquals($oCurrent->rec_type,3)}>
                {$this->__('COM_CONNECTDAILY_OneTime')}
            </label>
            <label class="CDnon-wrapping" for="idCDrecur_type_daily">
                <input data-require-classes='.CDRepeatEveryN .CDRecurring .CDDailyFields' type="radio" name="CDrec_type" id="idCDrecur_type_daily" value="5" {$this->valueEquals($oCurrent->rec_type,5)}>
                {$this->__('COM_CONNECTDAILY_Daily')}
            </label>
            <label class="CDnon-wrapping" for="idCDrecur_type_weekly">
                <input data-require-classes='.CDRepeatEveryN .CDRecurring .CDWeeklyOnly .CDDOWChecks' type="radio" name="CDrec_type" id="idCDrecur_type_weekly" value="0" {$this->valueEquals($oCurrent->rec_type,0)}>
                {$this->__('COM_CONNECTDAILY_Weekly')}
            </label>

            <label class="CDnon-wrapping" for="idCDrecur_type_monthly">
                <input data-require-classes='.CDRepeatEveryN .CDRecurring .CDDOWChecks .CDOrdinalChecks .CDMonthlyOnly .CDRepeatOn .CDRepeatEveryOpt' type="radio" name="CDrec_type" id="idCDrecur_type_monthly" value="1" {$this->valueEquals($oCurrent->rec_type,1)}>
                {$this->__('COM_CONNECTDAILY_Monthly')}
            </label>

            <label class="CDnon-wrapping" for="idCDrecur_type_annual">
                <input data-require-classes='.CDRecurring .CDAnnualOptions .CDDOWChecks .CDOrdinalChecks .CDRepeatOn .CDRepeatEveryOpt' type="radio" name="CDrec_type" id="idCDrecur_type_annual" value="2" {$this->valueEquals($oCurrent->rec_type,2)}>
                {$this->__('COM_CONNECTDAILY_Annual')}
            </label>
        <!--
                TODO: Decide if Im going to support Specific Dates or Exception Dates in the 
                plugin submission form.
            -->
        </fieldset>
    </dd>
EOFTWO;
        }   // if $showRecurrence
        $result.=<<<EOFTHREE
            <dt>{$this->__('COM_CONNECTDAILY_Start')}</dt>
            <dd>
            <label class="CDnon-wrapping CDOneTimeFields">
                {$this->__('COM_CONNECTDAILY_Date')}
                {$this->plugin->getDatePicker('CDstarting_date',null,$oCurrent->starting_date)}
            </label>
            <label class="CDnon-wrapping">
                {$this->__('COM_CONNECTDAILY_Time')}
                <input type="time" name="CDstarting_time" value="{$oCurrent->starting_time}" placeholder="{$this->timePlaceHolder}"  maxlength="{$fldMeta['starting_time']['maxlength']}" {$this->getRequiredAttribute($fldMeta,'starting_time')}>
            </label>
            </dd>

            <dt>{$this->__('COM_CONNECTDAILY_End')}</dt>
            <dd>
            <label class="CDnon-wrapping CDOneTimeFields">
                {$this->__('COM_CONNECTDAILY_Date')}
                {$this->plugin->getDatePicker('CDending_date',null,$oCurrent->ending_date)}
            </label>
            <label class="CDnon-wrapping">
                {$this->__('COM_CONNECTDAILY_Time')}
                <input type="time" name="CDending_time" value="{$oCurrent->ending_time}" placeholder="{$this->timePlaceHolder}" maxlength="{$fldMeta['ending_time']['maxlength']}" {$this->getRequiredAttribute($fldMeta,'ending_time')}>
            </label>
            </dd>
EOFTHREE;
        if ($showRecurrence) {
            $result.=<<<EOFFOUR
            <!--
                Recurrence Options
            -->
            <!--
                Recurrence Start Date and Recurrence End Date
            -->
            <dd>
                <label class="CDnon-wrapping CDRecurring">
                    {$this->__('COM_CONNECTDAILY_RecurrenceStartDate')}
                    {$this->plugin->getDatePicker('CDrecurrence_start',null,$oCurrent->recurrence_start)}
                </label>
                <label class="CDnon-wrapping CDRecurring">
                    {$this->__('COM_CONNECTDAILY_RecurrenceEndDate')}
                    {$this->plugin->getDatePicker('CDrecurrence_end',null,$oCurrent->recurrence_end)}
                </label>
            </dd>
            <!--
                Recurs On Day nn
            -->
            <dt class="CDRepeatOn">
                <label>
                <input type=radio name="CDrecur_option" id="idCDrgRecurDaily" value="1" {$this->valueEquals($oCurrent->recur_option,1)}>
                {$this->__('COM_CONNECTDAILY_Day')}
                </label>
            </dt>
            <dd class="CDRepeatOn">
                <label>
                    {$this->__('COM_CONNECTDAILY_DayOfMonth')}
                    <input type="number" min="1" max="31" step="1" value="{$oCurrent->day}" name="CDday" id="idCDday">
                </label>
            </dd>
            <dt class="CDRepeatEveryOpt">
                <label>
                    <input type=radio name="CDrecur_option" id="idCDrgRecurEvery" value="2" {$this->valueEquals($oCurrent->recur_option,2)}>
                    {$this->__('COM_CONNECTDAILY_Every')}
                </label>
            </dt>
            <!--
                Ordinals
            -->
            <dd class="CDOrdinalChecks">
                {$this->getOrdinalsCheckboxes('CDrecur_array',$oCurrent->recur_array)}
            </dd>
            <!--
                Days of Week including Day, Weekday, Weekend Day

            -->
            <dt class="CDDOWChecks">{$this->__('COM_CONNECTDAILY_DaysOfWeek')}</dt>
            <dd class="CDDOWChecks">
                {$this->getDayCheckboxes($lc,"CDday_array",$oCurrent->day_array)}
            </dd>
            <dd class="CDRepeatEveryN">
                <!--
                    Repeat Every N Days, Weeks, Months.
                -->
                <label class="CDnon-wrapping">{$this->__('COM_CONNECTDAILY_RepeatEvery')}
                <input type="number" min="0" max="30" step="1" name="CDrinterval" id="idCDrinterval" value="{$oCurrent->rinterval}">
                <span class="CDDailyFields">{$this->__('COM_CONNECTDAILY_DaysMaybePlural')}</span>
                <span class="CDWeeklyOnly">{$this->__('COM_CONNECTDAILY_Week_s')}</span>
                <span class="CDMonthlyOnly">{$this->__('COM_CONNECTDAILY_Month_s')}</span>
                </label>
            </dd>

            <!--
                Months of the Year
            -->
            <dt class="CDAnnualOptions">
                {$this->__('COM_CONNECTDAILY_OfMonth')}
            </dt>
            <dd class="CDAnnualOptions">
                    {$this->getMonthCheckboxes($lc,"CDmonth_array",$oCurrent->month_array)}
            </dd>
EOFFOUR;
        }   // if show recurrence
        $result.=<<<EOFFIVE
            
            <dt><label for="idCDcontact_name">{$this->__('COM_CONNECTDAILY_ContactName')}</label></dt>
            <dd><input type="text" name="CDcontact_name" id="idCDcontact_name" value="{$oCurrent->contact_name}" maxlength="{$fldMeta['contact_name']['maxlength']}" {$this->getRequiredAttribute($fldMeta,'contact_name')}></dd>

            <dt><label for="idCDcontact_info">{$this->__('COM_CONNECTDAILY_ContactInfo')}</label></dt>
            <dd><input type="text" name="CDcontact_info" id="idCDcontact_info" value="{$oCurrent->contact_info}"  maxlength="{$fldMeta['contact_info']['maxlength']}" {$this->getRequiredAttribute($fldMeta,'contact_info')}></dd>

            <dt><label for="idCDadd_info_url">{$this->__('COM_CONNECTDAILY_URL')}</label></dt>
            <dd><input type="url" name="CDadd_info_url" id="idCDadd_info_url" value="{$oCurrent->add_info_url}" maxlength="{$fldMeta['add_info_url']['maxlength']}" {$this->getRequiredAttribute($fldMeta,'add_info_url')}></dd>
        
            <dt><label for="idCDlong_description">{$this->__('COM_CONNECTDAILY_Description')}</label></dt>
            <dd><textarea name="CDlong_description" id="idCDlong_description" rows="10">{$oCurrent->long_description}</textarea></dd>
EOFFIVE;
        if (!empty($addData->resources)) {
            $result.='<dt>'.$this->__('COM_CONNECTDAILY_Resources').'</dt><dd>'.$this->getResourceSelector($addData->resources,$oCurrent->resource_list).'</dd>';
        }
        if ($addData->use_locations) {
            if ($addData->add_locations || count($addData->locations)>0 ) {
                // Make sure they can add, or there's at least one location available to pick.
                $result.='<dt><label for="idCDlocation_name">'.$this->__('COM_CONNECTDAILY_Location').'</label></dt>'.
                        '<dd><dl><dt>'.$this->__('COM_CONNECTDAILY_Name').'</dt><dd>'.
                        '<input type=hidden name="CDlocation_id" value="'.
                        $oCurrent->location_id.'">';

                if ($addData->add_locations) {
                    $result.='<input type="text" name="CDlocation_name" id="idCDlocation_name" '.
                        'list="idCDLocationList" value="'.htmlentities($oCurrent->location_name).'" '.
                        'placeholder="'.htmlentities($this->__('COM_CONNECTDAILY_SelectOrEnterLocation')).'" '.
                        'maxlength="'.$fldMeta['location_name']['maxlength'].'" '. 
                        $this->getRequiredAttribute($fldMeta,'location_name').
                        '>'.
                        $this->getLocationDataList('idCDLocationList',$addData->locations);
                } else {
                    $result.=$this->getDropdown('CDlocation_name',$addData->locations,$oCurrent->location_id);
                }
                $result.='<dt><label for="idCDlocation_address">'.$this->__('COM_CONNECTDAILY_Address').'</label></dt>'.
                        '<dd><input type="text" name="CDlocation_address" id="idCDlocation_address" value="'.htmlentities($oCurrent->location_address).'" '.
                        'maxlength="'.$fldMeta['location_address']['maxlength'].'" '.
                        ($addData->add_locations ? $this->getRequiredAttribute($fldMeta,'location_address') : ' readonly').
                        '>'.
                        '</dl></dd>';
            }
        }
            /*
            TODO: Resource Mover
            */
        $result.=<<<EOFSIX
            </dl>
        <input name="btnSubmit" type=submit value="{$this->__('COM_CONNECTDAILY_Submit')}">
    </form>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
    CDaily.setupAddEventsForm();
    });
</script>
EOFSIX;
        return $result;
    }

    /**
     * Send the post request back to connect daily. 
     *  
     * @return object 
     *  
     * object->error= error code. 
     * object->error_message = Message. 
     *  
     * if it was a Connect Daily error, then there will be 
     * arrays: 
     *  
     * warnings 
     * conflicts 
     * errors 
     */
    public function processSubmit($fldValues){
        $fldValues['request_number']='PUBLIC_ADD_EVENT';
        /*
            Put the values for the starting and ending date from the
            recurrence_start and _end fields.
        */
        if ($fldValues['rec_type']!=3 && isset($fldValues['recurrence_start'])) {
            $fldValues['starting_date']=$fldValues['recurrence_start'];
        }
        if ($fldValues['rec_type']!=3 && isset($fldValues['recurrence_end'])) {
            $fldValues['ending_date']=$fldValues['recurrence_end'];
        }
        /*
            If the location_id is 0, don't send it.
        */
        if (isset($fldValues['location_id'])&& $fldValues['location_id']===0) {
            unset($fldValues['location_id']);
        }
        /*
            Post the data to the server.
        */
         $result=$this->plugin->makePostRequest($this->plugin->getSettings()->url.'json/postevent.js',$fldValues);
        if ($result->wasSuccess()) {
            return $result->getContentObject();
        } else {
            return $result;
        }
    }

    /**
     * Get any warning messages as formatted html.
     */
    public function getWarnings($result) {
        $s=null;
        if (property_exists($result,'warnings') && sizeof($result->warnings)>0) {
            $s='<div class="CDSubmitResults" id="CDSubmitWarnings"><h4>'.
                $this->__('COM_CONNECTDAILY_Warnings').'</h4><ul class=CDWarnings>';
            foreach ($result->warnings as $warning) {
                $s.='<li>'.$warning.'</li>';
            }
            $s.='</ul></div>';
        }
        return $s;
    }

    /**
     * Get any error messages as formatted html
     */
    public function getErrors($result) {
        $s='<div class="CDSubmitResults" id="CDSubmitErrors"><h4>'.
            $this->__('COM_CONNECTDAILY_Errors').'</h4><ul>';
        $show=false;
        if (property_exists($result,'error_message') && !empty($result->error_message)) {
            $s.='<li>'.$result->error_message;
            $show=true;
        }
        if (property_exists($result,'errors') && sizeof($result->errors)>0) {
            $show=true;
            foreach ($result->errors as $error) {
                $s.='<li>'.$error.'</li>';
            }
            
        }
        $s.='</ul></div>';
        return $show ? $s : null;
    }


    /**
     * Get any conflict messages as formatted html
     */
    public function getConflicts($result) {
        $s=null;
        if (property_exists($result,'conflicts') && sizeof($result->conflicts)>0) {
            $s='<div class="CDSubmitResults" id="CDSubmitConflicts"><h4>'.$this->__('COM_CONNECTDAILY_Conflicts').'</h4><dl class=CDConflicts>';
            foreach ($result->conflicts as $conflict) {
                $s.='<dt>'.$conflict->TypeMessage.'</dt>'.
                    '<dd>'.$conflict->ConflictMessage.'</dd>';
            }
            $s.='</dl></div>';
        }
        return $s;
    }

    /**
     * Return the HTML to display on successful submission.
     */
    public function getSuccessOutput(){
        $out='<div class="CDSubmitResults" id="CDSuccessMessage">'.
            $this->__('COM_CONNECTDAILY_EntryCreated').
            '<br><br>'.
            $this->__('COM_CONNECTDAILY_UnapprovedPublicAddMsg').
            '<br><br><form method=GET>'.
            '<input type="submit" value="'.$this->__('COM_CONNECTDAILY_AddAnotherEvent').'">'.
            '</form></div>';
        return $out;
    }

    /**
     * Merge required fields from the shortcode tag attributes into 
     * our meta data. 
     */
    public function mergeRequiredFields($fieldMeta,$requiredFieldList) {
        if (!empty($requiredFieldList)) {
            $a = preg_split('/[\s,]+/', $requiredFieldList,-1,PREG_SPLIT_NO_EMPTY);
            
            foreach ($a as $fld) {
                
                $fld=trim($fld);
                if (array_key_exists($fld,$fieldMeta)) {
                    $fieldMeta[$fld]['required']=true;
                }
            }
        }
        
        return $fieldMeta;
    }
}
