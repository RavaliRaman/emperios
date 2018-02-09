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
/**
 * This class implements a widget for a simple list of events.
 *
 * @author gsexton (12/8/2012)
 */

class  CDaily_iCalendarWidget extends WP_Widget {

    private $plugin=null;

    public function __construct() {
        $this->plugin=CDailyWPPlugin::getInstance();
        // construct a widget
        $widget_ops = array('classname' => 'cdaily_icalendar',
                            'description' => __('iCalendar Link Widget', CDailyPlugin::CAPTION_BUNDLE));
        parent::__construct(false, $name = 'Connect Daily iCalendar Link Widget', $widget_ops);
    }

    function widget($args, $instance) {
        // Display the widget on website.
        extract($args);
        extract($instance);
        
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
        $ical_url=$this->plugin->getAjaxURL("action=cd_icalendar&amp;by_method=$by_method&amp;by_id=$by_id");
        $ical_url="webcal".substr($ical_url,strpos($ical_url,":"));
        $result="<a id=\"$widget_id\" class=CDiCalendarWidget href=\"$ical_url\" ".
            "title=\"".$title."\">";
        if ($title) {
            $result.= $before_title . $title . $after_title;
        }
        $result.='</a>';
        
        echo $result;

        echo $after_widget;

        return;
    }

    function update($new_instance, $old_instance) {
        // Save Widget Options
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['by_method'] = strip_tags($new_instance['by_method']);
        $instance['by_id'] = strip_tags($new_instance['by_id']);
        $instance['other_options'] = strip_tags($new_instance['other_options']);
        $this->plugin->markUsed();
        return $instance;
    }

    function form($instance) {
        // Form to display widget settings in WordPress Admin
        extract(shortcode_atts(array(
                                   "title"         => 'iCalendar',
                                   "by_id"         => '-1',
                                   "by_method"     => 'calendar_id',
                                   "id"            => 'cdaily_icalendar',
                                   "other_options" => ''
                                   ), $instance));
       if (empty($by_id)) {
            $by_id=-1;
        }

?>
<script type="text/javascript">
jQuery(document).ready(function (){
    var selWidget=document.getElementById("<?php echo $this->get_field_id('by_method'); ?>");
    CDaily.initForDropdownFromMethod(selWidget,<?php echo $by_id; ?>);
});

</script>

</script>
        <a style="float: right;" tabindex="-1" class="IconLink HelpSmall"
            title="<?php _e("COM_CONNECTDAILY_Help",CDailyPlugin::CAPTION_BUNDLE);?>"
            href="<?php echo CDailyPlugin::HELP_PAGE; ?>iCalExporter.htm"
            target="_blank"></a><br>

        <p>
        <label for="<?php echo $this->get_field_id('title'); ?>">
        <?php _e('COM_CONNECTDAILY_Title', CDailyPlugin::CAPTION_BUNDLE); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
            placeholder="<?php echo _e('COM_CONNECTDAILY_OptionalPlaceHolder',CDailyPlugin::CAPTION_BUNDLE); ?>"
            name="<?php echo $this->get_field_name('title'); ?>" type="text"
            value="<?php echo $title; ?>">
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('by_method'); ?>">
        <?php _e('Create iCalendar File By', CDailyPlugin::CAPTION_BUNDLE); ?></label>
        <br>
        <?php echo $this->plugin->getByMethodDropdown($by_method, $this->get_field_name('by_method'), $this->get_field_id('by_method')); ?>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('by_id'); ?>">
        <?php _e('COM_CONNECTDAILY_SHOW_FOR', CDailyPlugin::CAPTION_BUNDLE); ?></label>
        <br>
        <select name="<?php echo $this->get_field_name('by_id'); ?>"
            id="<?php echo $this->get_field_id('by_id'); ?>">
        </select>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('other_options'); ?>">
        <?php _e('COM_CONNECTDAILY_UncatOptions', CDailyPlugin::CAPTION_BUNDLE); ?></label>
        <a target=_blank class="dashicons dashicons-editor-help" href="<?php echo CDailyPlugin::HELP_PAGE; ?>WPPluginOptions.html"></a>
        <br>
        <input class="widefat"
            id="<?php echo $this->get_field_id('other_options'); ?>"
            placeholder="<?php echo _e('COM_CONNECTDAILY_OptionalPlaceHolder',CDailyPlugin::CAPTION_BUNDLE); ?>"
            name="<?php echo $this->get_field_name('other_options'); ?>"
            type="text" value="<?php echo htmlspecialchars($other_options); ?>">
        </p>
<?php
    }
}
