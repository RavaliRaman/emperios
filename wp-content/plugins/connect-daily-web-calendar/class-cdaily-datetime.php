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
 * This class extends PHP::DateTime and adds some basic 
 * functionality to it. 
 *  
 * It also overrides format() to use the wordpress date_i18n() 
 * function for formatting. 
 */
class CDDateTime extends DateTime {

    public static function toRFC2822($timeValue) {
        return gmdate(DateTime::RFC2822, $timeValue) . ' GMT';
    }

    /**
     * Return the year of this date object as an integer.
     * 
     */
    public function getYear() {
        return intval($this->format('Y'));
    }

    public function getMonth() {
        return intval($this->format('n'));
    }

    public function getDay() {
        return intval($this->format('j'));
    }
    
    public function getHour(){
        return intval($this->format('H'));
    }
    public function getMinutes(){
        return intval($this->format('i'));
    }
    public function getSeconds(){
        return intval($this->format('s'));
    }
    public function getSecondsSinceMidnight(){
        return $this->getHour()*3600+$this->getMinutes()*60+$this->getSeconds();
    }

    /**
     * Given a GMT unix timestamp, return an instance of a 
     * CDDateTime. 
     *  
     * @param $gmt_timestamp The Unix format timestamp (Seconds 
     *                       since epoch).
     * @param $tz The timestamp for the constructed result. Default: 
     *            GMT.
     *  
     * @return CDDateTime The constructed CDDateTime value. 
     */
    public static function getInstance($gmt_timestamp, $tz){
        $res=new CDDateTime();
        $res->setTimezone(new DateTimeZone("GMT"));
        $res->setTimestamp($gmt_timestamp);
        $res->setTimezone($tz);
        return $res;
    }

    /**
     * Increment the month by the specified offset number of months.
     * If the day is invalid for the month (e.g. 1995-02-31, then 
     * the day element will be set to the last day of the month. 
     *  
     * @param $offset 
     *  
     * @return reference to object. 
     *  
     */
    public function goMonth($offset) {
        $yr = $this->getYear();
        $mo = $this->getMonth();
        $da = $this->getDay();

        if ($offset >= 0) {
            $yr += (int)$offset / 12;
            $mo += $offset % 12;
            if ($mo > 12) {
                $yr += 1;
                $mo = $mo % 12;
            }
        } else {
            $offset *= -1;
            while ($offset > 12) {
                $yr--;
                $offset -= 12;
            }
            $mo -= $offset % 12;
            if ($mo < 1) {
                $mo += 12;
                $yr -= 1;
            }
        }
        if ($da > CDDateTime::daysPerMonth($yr, $mo)) {
            $da = CDDateTime::daysPerMonth($yr, $mo);
        }
        $this->setDate($yr, $mo, $da);

        return $this;
    }


    public static function isleapYear($yr) {
        if ($yr % 4 == 0) {
            if ($yr % 400 == 0) {
                return 1;
            } else if ($yr % 100 == 0) {
                return 0;
            } else {
                return 1;
            }
        }
        return 0;
    }

    public static function daysPerMonth($year, $month) {
        $iResult = 0;
        switch ($month) {
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            $iResult = 31;
            break;
        case 2:
            $iResult = 28 + CDDateTime::isleapYear($year);
            break;
        case 4:
        case 6:
        case 9:
        case 11 :
            $iResult = 30;
            break;
        default:
            break;
        }
        return $iResult;
    }

    /**
     * return the day of the week, where 0=sunday, and 6=saturday.
     * 
     */
    public function getDow() {
        return intval($this->format('w'));
    }

    /**
     * Return the julian date (not day number) for this object.
     * 
     * 
     * @return int 
     */
    public function getJulianDate() {
        $dEpoch = new DateTime();
        $dEpoch->setDate(1970, 1, 1);
        $dEpoch->setTime(0, 0, 0);
        $dInterval = $this->diff($dEpoch);
        return $dInterval->days + 2440588;
    }

    public function incrementDays($numDays = 1) {
        if ($numDays < 0) {
            $numDays *= -1;
            $iv = new DateInterval('P' . $numDays . 'D');
            return $this->sub($iv);
        } else {
            $iv = new DateInterval('P' . $numDays . 'D');
            return $this->add($iv);
        }
    }

    public function __clone() {
    }

    public function __toString() {
        return $this->format('Y-m-d H:i:s');
    }

    public function format($formatStr) {
        // date_i18n gets its locale data from wp, and doesn't use the requests accept-language header.
        if (defined('_JEXEC')) {
            /*
                This is the Joomla Path
            */
            $d=new JDate(self::toRFC2822($this->getTimestamp()+$this->getOffset()));
            return $d->format($formatStr);
        } else {
            /*
                The WordPress path
             
                2016-08-26
             
                Sometimes people change the timezone in wp-config.php. 
		We need to only add the offset if the timezone is UTC.
            */
            $gTZ=date_default_timezone_get();
            if ($gTZ==='UTC') {
                return date_i18n($formatStr, $this->getTimestamp() + $this->getOffset());
            } else {
                return date_i18n($formatStr, $this->getTimestamp());
            }
        }
    }
}
