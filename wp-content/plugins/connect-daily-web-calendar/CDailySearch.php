<?php
/**
  * Copyright 2017, MH Software, Inc.
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

# require_once 'class-cdaily-datetime.php';
/** 
 * This class implements the calendar search shortcode/widget
 *  
 */
class CDailySearch  {

    const SEARCH_FIELD_NAME="CDSearchText";

    /** CDailyPlugin   */
    private $plugin;

    public function __construct($plugin) {
        $this->plugin = $plugin;
    }

    /**
     * Render the form for a search input against the calendar. 
     *  
     * @param $args The Plugin and request arguments. 
     * @param $target the URL to the target page for the form. 
     *  
     * @return String the rendered HTML form for searching the 
     *         calendar.
     */
    public function renderSearchInput($args, $target = null) {
        $ph=(isset($args['placeholder']) ? $args['placeholder'] : $this->plugin->translate('COM_CONNECTDAILY_SearchCalendar'));
        $result = '<form class="search-form" role="search" method="POST" action="' . $target . '">' .
            '<input type="search" class="search-field" name="'.static::SEARCH_FIELD_NAME.'" placeholder="' . $ph . '" '.
            " style=\"background-image: url('".$this->plugin->getIconURL('COM_CONNECTDAILY_SEARCHICON')."');\"".
            '>' .
            '</form>';
        return $result;
    }

    /**
     * Actually execute the event search. 
     * 
     * @author gsexton (6/27/17)
     * 
     * @param $args The search text should be a key value pair where 
     *              the key name is CDSearchText
     * @param $detailed if True, return results in detailed form, 
     *                  otherwise in simple list form.
     * @return String
     */
    public function executeSearch($args,$detailed=true) {
        if (!array_key_exists(static::SEARCH_FIELD_NAME,$args) || empty($args[static::SEARCH_FIELD_NAME])) {
            return '';
        }
        $args = $this->plugin->convertOtherOptions($args);
        $aDefaults=array('show_resources' => 0, 'dayspan' => 60, 'allow_duplicates' => 1, 'maxcount' => 100, 'is_search' => true, 'id' => 'cdaily_search');
        foreach ($aDefaults as $key => $value) {
            if (!array_key_exists($key,$args)) {
                $args[$key]=$value;
            }
        }
        $renderer = new CDailyEventsRenderer($this->plugin);
        if ($detailed) {
            $res = $renderer->renderDetailedList($args, $args['id']);
        } else {
            $args['show_starttimes']=1;
            $res = $renderer->renderSimpleList($args,$args['id']);
        }
        return $res;
    }
}
