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

require_once 'class-timedata.php';
require_once 'class-cdaily-eventsrenderer.php';

/**
 * This file implements the detailed list of events short code. It also
 * provides methods used by the Simple List widget and mini-calendar
 * widget.
 */
class CDEventLister {

    private $plugin;
    private $renderer;
    
    public function __construct($plugin_parent){
        $this->plugin=$plugin_parent;
        $this->renderer=new CDailyEventsRenderer($this->plugin);
    }


    /**
     * Shortcode implementation for Detailed list of Events.
     *
     * @param $atts
     * @param $content - Unused - default null.
     */
    public function detailedList($atts, $content = null, $tag=null) {
        if (isset($atts['id'])) {
            return $this->renderer->renderDetailedList($atts, $atts['id']);
        } else {
            return $this->renderer->renderDetailedList($atts);
        }
    }

    public function simpleList($atts, $content = null, $tag=null) {
        if (!isset($atts['other_options'])) {
            $atts['other_options'] = false;
        }
        if (!isset($atts['datefmt'])) {
            $atts['datefmt'] = false;
        }
        if (isset($atts['id'])) {
            return $this->renderer->renderSimpleList($atts, $atts['id']);
        } else {
            return $this->renderer->renderSimpleList($atts);
        }
    }


}
