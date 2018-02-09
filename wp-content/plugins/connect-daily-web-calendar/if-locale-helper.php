<?php
/**
  * Copyright 2015, MH Software, Inc.
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
 * An interface for a locale helper class.
 * 
 * @author gsexton (4/1/16)
 */
interface CDailyLocaleHelper {

    /**
     * Return the Locale Object as a JSON String 
     *  
     * @return String 
     */
	public function getLocaleAsJSON();


    /**
     * Return a locale object. It has the following members: 
     *  
     *  
     * @return mixed 
     *  
     * MonthNames[] - Array of full month names. 
     * AbbrMonthNames[] Array of 3 char abbreviated month names. 
     * DayNames[] - Array of full day names. 
     * AbbrbDayNames[] - Array of 3 char short day names. 
     * DayInitials[] - Array of initials for each short day name. 
     * FirstDayOfWeek - int 0=Sunday, 6=Saturday. 
     */
    public function getLocale();
}
