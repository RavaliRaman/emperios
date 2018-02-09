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
require_once 'class-cdaily-datetime.php';
/**
 * This class implements an object for caching time formats and
 * keeps track of the last formatted time string displayed.
 *
 * @author gsexton (12/8/2012)
 */
class Time_Data {
    public $last_time='~';
    public $single_date;
    public $time_format;
    public $date_format;
    public $datetime_format;
    public $time_zone;
    public $time_continuation_separator=" - ";

    const MILLIS_SECOND=1000;
    const SECONDS_DAY=86400;
    const SECONDS_HOUR=3600;

    /**
     * Construct a Time_Data object.
     *
     * @author gsexton (12/8/2012)
     *
     * @param $single_date
     */
    public function __construct($single_date=false,$argDefaults=false){
        $pi=CDailyPlugin::getInstance();
        $settings=$pi->getSettings();
        $this->single_date=$single_date;
        $this->time_format=$settings->time_format;
        $this->date_format=$settings->date_format;
        $this->datetime_format=$settings->datetime_format;
        $this->time_zone=new DateTimeZone($pi->getTimezone());
        if (!empty($argDefaults)) {
            foreach ($argDefaults as $key => $value){
                if (property_exists($this,$key)) {
                    $this->{$key}=$value;
                }
            }
        }
    }

    /**
     * @return CDDateTime
     */
    public function getDateTime($timestamp=false){
        $dt=new CDDateTime('now',$this->time_zone);
        if (!empty($timestamp)) {
            $dt->setTimestamp($timestamp);
        }
        return $dt;
    }

    public function get_formatted_timestamp($timestamp=false) {

        return $this->getDateTime($timestamp)->format($this->datetime_format);
    }
}
