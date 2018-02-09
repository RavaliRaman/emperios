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

require_once('if-locale-helper.php');
require_once('class-cdaily-wordpress-plugin.php');

class CDailyWordPressLocaleHelper implements CDailyLocaleHelper {

    /**
     * localizationData looks like:
     *
     * data {
     *
     * MonthNames array 0..11 of string
     * AbbrMonthNames array 0..11 of string
     * DayNames array 0..6 of string
     * AbbrDayNames array 0..6 of string DayInitials array 0..6 of
     * String FirstDayOfWeek integer - [0]-[6] }
     */
    public function getLocaleAsJSON(){
        $locale=new WP_Locale();
        $result='{ "MonthNames" : [';
        $abbr=" \"AbbrMonthNames\" : [";
        for ($i=1; $i<13; $i++) {
            $key=($i<10 ? '0' : '').$i;
            $value=$locale->month[$key];
            $result.='"'.$value.'"'.($i==12 ? '' : ',');
            $abbr.='"'.$locale->month_abbrev[$value].'"'.($i==12 ? '' : ',');
        }
        $result.="], \n".$abbr."],\n";
        $result.=' "DayNames" : [';
        $abbr=' "AbbrDayNames" : [';
        $init=' "DayInitials" : [';
        for ($i=0; $i<7; $i++) {
            $value=$locale->weekday[$i];
            $result.='"'.$value.'"'.($i<6 ? ',' : '');
            $abbr.='"'.$locale->weekday_abbrev[$value].'"'.($i<6 ? ',' : '');
            $init.='"'.$locale->weekday_initial[$value].'"'.($i<6 ? ',' : '');
        }
        $result.="],\n$abbr],\n$init],\n";
        $result.=" \"FirstDayOfWeek\" : ".CDailyWPPlugin::getInstance()->getSettings()->start_of_week;
        $result.="\n}";
        return $result;
    }

    public function getLocale() {
        return json_decode($this->getLocaleAsJSON());
    }

}
