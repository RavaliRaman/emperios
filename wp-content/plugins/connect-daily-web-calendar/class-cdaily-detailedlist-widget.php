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
 * This class implements a widget for a Detailed list of events.
 *
 * @author gsexton (12/8/2012)
 */
require_once 'detailed-list.php';

class  CDaily_DetailedListWidget extends WP_Widget {

    
    private $plugin=null;

    public function __construct(){
        
        $this->plugin=CDailyWPPlugin::getInstance();
       
       // construct a widget
        $widget_ops=array('classname' => 'cdaily_detailedlistwidget',
                          'description' => __('COM_CONNECTDAILY_IntegrationWizardDetailedList',CDailyPlugin::CAPTION_BUNDLE));
        parent::__construct(false,$name='Connect Daily Detailed List Widget',$widget_ops);
    }



    function widget($args, $instance) {
        // Display the widget on website.
        extract($args);
        $title=apply_filters('widget_title',$instance['title']);
        echo $before_widget;
        if ($title) {
            echo $before_title.$title.$after_title;
        }
        $lister=new CDEventLister($this->plugin);
        echo $lister->detailedList($instance,'cdaily_detailedlist_widget');
        echo $after_widget;
        return;
    }

    function isempty($val,$default) {
        if (isset($val)) {
            if (empty($val)) {
                return $default;
            } else {
                return $val;
            }
        } else {
            return $default;
        }
    }

    function update($new_instance,$old_instance){
        // Save Widget Options
        $instance=$old_instance;
        $instance['title']=strip_tags($new_instance['title']);
        $instance['by_method']=strip_tags($new_instance['by_method']);
        $instance['by_id']=strip_tags($new_instance['by_id']);
        $instance['dayspan']=strip_tags($this->isempty($new_instance['dayspan'],'90'));
        $instance['maxcount']=strip_tags($this->isempty($new_instance['maxcount'],'12'));
        $instance['datefmt']=strip_tags($new_instance['datefmt']);
        if (!isset($new_instance['allow_duplicates'])) {
            $new_instance['allow_duplicates']='1';
        }
        $instance['allow_duplicates'] = strip_tags($new_instance['allow_duplicates']);
        if (!isset($new_instance['show_endtimes'])) {
            $new_instance['show_endtimes']='0';
        }
        $instance['show_endtimes'] = strip_tags($new_instance['show_endtimes']);
        $instance['other_options']=strip_tags($new_instance['other_options']);
        // $this->plugin->debugOut("DetailedListWidget->update() instance=",$instance);
        $this->plugin->markUsed();
        return $instance;
    }

    function form($instance) {
        // Form to display widget settings in WordPress Admin
        extract(shortcode_atts(array(
            "title"         => '',
            "by_id"         => '-1',
            "by_method"     => 'calendar_id',
            "id"            => 'cdaily_detailedlist',
            "dayspan"       => '90',
            "maxcount"      => '12',
            "datefmt"       => 'D, j M Y',
            "allow_duplicates"   => '1',
            "show_endtimes" => '0',
            "other_options"    => ''
        ), $instance));
        if (empty($by_id)) {
            $by_id=-1;
        }
        if (empty($datefmt)) {
            $datefmt='D, j M Y';
        }
        if (empty($maxcount)) {
            $maxcount=12;
        }
        if ($dayspan=='') { // not using empty() because 0 would be OK.
            $dayspan=7;
        }
        ?>
<script type="text/javascript">
jQuery(document).ready(function (){
    var selWidget=document.getElementById("<?php echo $this->get_field_id('by_method'); ?>");
    CDaily.initForDropdownFromMethod(selWidget,<?php echo $by_id; ?>);
});
</script>
<a style="float: right;" tabindex="-1" class="dashicons dashicons-editor-help" title="<?php _e("COM_CONNECTDAILY_Help",CDailyPlugin::CAPTION_BUNDLE);?>" href="<?php echo CDailyPlugin::HELP_PAGE; ?>WPDetailedListOfEventsShortCode.html" target=_blank></a>
                                                                                                                                                                                             <br>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>">
            <?php _e('COM_CONNECTDAILY_Title',CDailyPlugin::CAPTION_BUNDLE); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
name="<?php echo $this->get_field_name('title'); ?>" type="text"
placeholder="<?php echo _e('COM_CONNECTDAILY_OptionalPlaceHolder',CDailyPlugin::CAPTION_BUNDLE); ?>"
value="<?php echo $title; ?>">
</p>
<p>
<label for="<?php echo $this->get_field_id('by_method'); ?>">
        <?php _e('COM_CONNECTDAILY_SHOW_BY',CDailyPlugin::CAPTION_BUNDLE); ?></label>
<br>
        <?php echo $this->plugin->getByMethodDropdown($by_method,$this->get_field_name('by_method'),$this->get_field_id('by_method')); ?>
</p>
<p>
<label for="<?php echo $this->get_field_id('by_id'); ?>">
        <?php _e('COM_CONNECTDAILY_SHOW_FOR',CDailyPlugin::CAPTION_BUNDLE); ?></label>
<br>
<select name="<?php echo $this->get_field_name('by_id'); ?>" id="<?php echo $this->get_field_id('by_id'); ?>">
</select>
</p>
<p>
<label for="<?php echo $this->get_field_id('dayspan'); ?>">
        <?php _e('COM_CONNECTDAILY_MAX_DAYS',CDailyPlugin::CAPTION_BUNDLE); ?></label>
<br>
<input size="6" id="<?php echo $this->get_field_id('dayspan'); ?>"
name="<?php echo $this->get_field_name('dayspan'); ?>" type="number"
min="0" max="365" step="1"
required
value="<?php echo $dayspan; ?>">
</p>
<p>
<label for="<?php echo $this->get_field_id('maxcount'); ?>">
        <?php _e('COM_CONNECTDAILY_MAX_EVENTS',CDailyPlugin::CAPTION_BUNDLE); ?></label>
<br>
<input size="6" id="<?php echo $this->get_field_id('maxcount'); ?>"
name="<?php echo $this->get_field_name('maxcount'); ?>" type="number"
min="1" step="1"
required
value="<?php echo $maxcount; ?>">
</p>
<p>
<label for="<?php echo $this->get_field_id('datefmt'); ?>">
        <?php _e('COM_CONNECTDAILY_DATEFORMAT',CDailyPlugin::CAPTION_BUNDLE); ?></label>
        <a target=_blank class="dashicons dashicons-editor-help" href="<?php echo CDailyPlugin::PHP_TIME_FORMATTING; ?>"></a>
<br>
<input size="8" id="<?php echo $this->get_field_id('datefmt'); ?>"
name="<?php echo $this->get_field_name('datefmt'); ?>" type="text"
value="<?php echo $datefmt; ?>">
</p>
<p>
<label for="<?php echo $this->get_field_id('other_options'); ?>">
        <?php _e('COM_CONNECTDAILY_UncatOptions',CDailyPlugin::CAPTION_BUNDLE); ?></label>
    <a target=_blank class="dashicons dashicons-editor-help" href="<?php echo CDailyPlugin::HELP_PAGE; ?>WPPluginOptions.html"></a>
<br>
<input class="widefat" id="<?php echo $this->get_field_id('other_options'); ?>"
placeholder="<?php echo _e('COM_CONNECTDAILY_OptionalPlaceHolder',CDailyPlugin::CAPTION_BUNDLE); ?>"
name="<?php echo $this->get_field_name('other_options'); ?>" type="text"
value="<?php echo htmlspecialchars($other_options); ?>">
</p>
<p>
<label>
<input type="checkbox" value="1" 
    id="<?php echo $this->get_field_id('show_endtimes'); ?>"
    name="<?php echo $this->get_field_name('show_endtimes'); ?>"
    value="1"
    <?php echo ($show_endtimes=='1' ? 'checked' : ''); ?>
    >
    <?php _e('COM_CONNECTDAILY_SHOWEND',CDailyPlugin::CAPTION_BUNDLE); ?>
</label>
</p>
<p>
<input type="checkbox" id="<?php echo $this->get_field_id('allow_duplicates'); ?>"
name="<?php echo $this->get_field_name('allow_duplicates'); ?>"
value="0" <?php if ($allow_duplicates=="0") { echo " checked"; } ?> >
<label for="<?php echo $this->get_field_id('allow_duplicates'); ?>">
        <?php _e('COM_CONNECTDAILY_SHOW_ONCE',CDailyPlugin::CAPTION_BUNDLE); ?></label>
</p>
        <?php
    }
}
