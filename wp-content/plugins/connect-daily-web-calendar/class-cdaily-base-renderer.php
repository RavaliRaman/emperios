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
 * This class contains useful methods for sub-classes that 
 * render events. 
 * @author George Sexton
 */
class CDailyBaseRenderer {

    /**
     * @var CDailyPlugin
     */
    protected $plugin;
    protected $shareHelper;

    public function __construct($plugin) {
        $this->plugin = $plugin;
        $this->shareHelper=$plugin->getSocialNetworkHelper();
    }

    /**
     * Given two times in epoch format, convert them to local time 
     * and return true if the t2 is midnight localtime immediately 
     * following t1. 
     *  
     * @return true if the time represented by t2 is midnight 
     *         immediately following t1. False otherwise.
     */
    private function isMidnightAfter($t1,$t2,$time_data){
        $d2=CDDateTime::getInstance($t2,$time_data->time_zone);
        if ($d2->getSecondsSinceMidnight()===0) {
            $d1=CDDateTime::getInstance($t1,$time_data->time_zone);
            $diff=$d1->diff($d2);
            return $diff->s <= 86400;
        }
        return false;
    }
    /**
     * Return the ending time for display.
     */
    protected function get_end_time($item,$time_data){
        $format='';
        if ($item->ending_time==null) {
            if (!$this->isMidnightAfter($item->occurrenceStart/1000,$item->occurrenceEnd/1000,$time_data)) {
                $format=$time_data->date_format;
            }
        } else if ($item->occurrenceStartDate===$item->occurrenceEndDate) {
            $format = $time_data->time_format;
        } else {
            $format = $time_data->datetime_format;
        }
        if (empty($format)) {
            return '';
        }
        $dt = $time_data->getDateTime($item->occurrenceEnd / Time_Data::MILLIS_SECOND); 
        return $time_data->time_continuation_separator . $dt->format($format);
    }

    /**
     * This code tests to see if two numeric ranges overlap. Its 
     * pretty subtle, but it works. Look at MHS.jar's java 
     * implementation for an explanation of how it works. 
     * 
     * 
     * @param $a1 - two element array representing the first range.
     * @param $a2 - two element array representing the second range.
     */
    public function doesRangeOverlap($a1, $a2) {

        if ($a1[0] == $a2[0]) {
            return true;
        } else if ($a1[0] > $a2[0]) {
            $aTemp = $a1;
            $a1 = $a2;
            $a2 = $aTemp;
        }
        return ($a1[1] > $a2[0]);
    }

    public function setShareHelper($helper){
        $this->shareHelper=$helper;
    }
}
