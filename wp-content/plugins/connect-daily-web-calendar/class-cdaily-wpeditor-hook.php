<?php
/**
  * Copyright 2013-2014, MH Software, Inc.
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
 * This class hooks into the TinyMCE Editor for WordPress to 
 * provide a short-code insertion dialog form.
 */
class CDWPEditorHook {

    private $plugin=null;

    public function __construct($plugin_parent){
        $this->plugin=$plugin_parent;
        add_action('admin_head-post.php', array($this,'editorForm'));
        add_action('admin_head-post-new.php', array($this, 'editorForm'));
        add_action('init', array($this,'addButton'));
    }


    /**
     * This function gets called when we're on the post page, and it
     * writes the HTML dialog/form that we want to show for our
     * shortcode insertion dialog.
     */
    function editorForm() {

        /*
    
        things to do:
    
        check if add events is abled.
    
        */
        $settings = $this->plugin->getSettings();
        $s_url = $settings->url;
        if (empty($s_url)) {
            return;
        }

        $s_dropdown = $this->plugin->getByMethodDropdown('calendar_id', 'cd-list-events-by', 'cd-list-events-by_method');
        $s_dropdown = str_replace('widefat', '', $s_dropdown);
        $locations=false;
        $multiCalendar=true;
        $independentStyles=false;
        if (!$this->plugin->hasUserSeenHint('ShortCodeInsertion')) {

            /*
                The plugin hasn't been used. Display a notice message with an example icon.
            */
            $tutorialTitle=$this->plugin->translate("COM_CONNECTDAILY_WatchTheBlankTutorial");
            $tutorialTitle=str_replace('{0}',$this->plugin->translate("COM_CONNECTDAILY_INSERTCODE"),$tutorialTitle);
            ?>
            <div style="padding: 16px;" class="notice notice-info is-dismissible" id="CDailyToolBarHint">
                <h3>Connect Daily Events Calendar - Hint</h3>
                <span style="max-width: 250px; display: inline-block;">
                To insert a calendar short-code into a page, click on the 
                calendar icon in the editor toolbar. 
                <br><br>
                <a id="cdShortCodeTutorialLink" tabindex="-1"
                        style="float: left; height: 32px; width: 32px;" title="<?php echo $tutorialTitle; ?>"
                        class="dashicons dashicons-video-alt IconLink"
                        href="<?php echo CDailyWPPlugin::TUTORIAL_URL; ?>#t=1m53s"
                        target="_blank">
                    </a>
                    <a tabindex="-1"
                        title="<?php echo $tutorialTitle; ?>"
                        href="<?php echo CDailyWPPlugin::TUTORIAL_URL; ?>#t=1m53s"
                        target="_blank">Watch the Tutorial
                    </a>
                    </span><br>
                       <img style="height: 150px; width: 250px;" src="<?php echo plugins_url('/images/ShortCodeInsertionAnimation.gif',__FILE__); ?>">
                       <br><br>
                       <label><input type="checkbox" onclick="return CDaily.dismissHint('ShortCodeInsertion','#CDailyToolBarHint');">
                        Don't show this hint again.
                        </label>
            </div>
            <?php
        }
        $info=$this->plugin->getLicenseInfo();
        if ($info!=null) {
            $multiCalendar=$info->LicensedCalendars>1;
            $locations=$info->Locations;
            $independentStyles=!$info->TieItemStyleToItemType;
        }
        $tutorialTitle=$this->plugin->translate("COM_CONNECTDAILY_WatchTheBlankTutorial");
        $tutorialTitle=str_replace('{0}',$this->plugin->translate("COM_CONNECTDAILY_INSERTCODE"),$tutorialTitle);
?>
        <div id="cdaily-shortcode-dlg" style="z-index: 170000 !important; display: none;">
            <form id="cdaily-shortcode-form" tabindex="-1">
                <div class="CDailySCDialog">
                    <a id="cdShortCodeHelpLink" tabindex="-1"
                        style="float: right;" title="<?php _e('COM_CONNECTDAILY_Help',CDailyPlugin::CAPTION_BUNDLE);?>"
                        class="IconLink Help"
                        href="<?php echo CDailyPlugin::HELP_PAGE; ?>WPDetailedListOfEventsShortCode.html"
                        target="_blank"></a>
                    <a id="cdShortCodeTutorialLink" tabindex="-1"
                        style="float: right; height: 32px; width: 32px;" title="<?php echo $tutorialTitle; ?>"
                        class="dashicons dashicons-video-alt IconLink"
                        href="<?php echo CDailyWPPlugin::TUTORIAL_URL; ?>#t=1m53s"
                        target="_blank"
                    >
                    </a>
                    
                    
                    <p style="float: left;" class="howto"><?php _e('COM_CONNECTDAILY_INSERT_CALENDAR', CDailyPlugin::CAPTION_BUNDLE); ?></p>
                    <div style="clear: left;">
                        <label for="cd-shortcode-type"><?php _e('COM_CONNECTDAILY_SHORTCODE_TYPE', CDailyPlugin::CAPTION_BUNDLE); ?></label>
                        <select onfocus="CDaily.setupByDD();"
                            id="cd-shortcode-type"
                            onchange="CDaily.toggleFieldSets();">

                            <option value="detailed_list"
                                data-requires="#cd-events #cd-event-list-settings #lbl-cd-show-endtimes"
                                ><?php _e('COM_CONNECTDAILY_IntegrationWizardDetailedList', CDailyPlugin::CAPTION_BUNDLE); ?></option>
                            <option value="simple_list"
                                data-requires="#cd-events #cd-event-list-settings #lbl-cd-show-endtimes #lbl-cd-show-starttimes"
                                ><?php _e('COM_CONNECTDAILY_IntegrationWizardSimpleList', CDailyPlugin::CAPTION_BUNDLE); ?></option>
                            <option value="rcalendar"
                                data-requires="#cd-events #cd-rcalendar-settings"
                                ><?php _e('COM_CONNECTDAILY_ResponsiveCalendar', CDailyPlugin::CAPTION_BUNDLE); ?></option>
                            <option value="filter"
                                data-requires="#cd-filter-options"
                                ><?php _e('COM_CONNECTDAILY_EventsFilter', CDailyPlugin::CAPTION_BUNDLE); ?></option>
                            <option value="minicalendar"
                                data-requires="#cd-events"
                                ><?php _e('COM_CONNECTDAILY_IntegrationWizardMiniCalendar', CDailyPlugin::CAPTION_BUNDLE); ?></option>
                                <option value="add_event"
                                data-requires="#cd-add-options"
                                ><?php _e('COM_CONNECTDAILY_AddEventForm', CDailyPlugin::CAPTION_BUNDLE); ?></option>
                            <option value="ical"
                                data-requires="#cd-events"
                                ><?php _e('COM_CONNECTDAILY_iCalendarLink', CDailyPlugin::CAPTION_BUNDLE); ?></option>
                            <option value="event"
                                data-requires=""
                                >
                                <?php _e('COM_CONNECTDAILY_SingleEvent', CDailyPlugin::CAPTION_BUNDLE); ?>
                                </option>
                            <option value="search"
                                data-requires="#cd-events"
                                >
                                <?php _e('COM_CONNECTDAILY_Search', CDailyPlugin::CAPTION_BUNDLE); ?>
                                </option>
                            <option value="calendar"
                                data-requires="#cd-events #lbl-cd-iframe-view #cd-iframe-settings"
                                ><?php _e('COM_CONNECTDAILY_CalendarIFrame', CDailyPlugin::CAPTION_BUNDLE); ?></option>
                        </select>
                    </div>
        <fieldset class="cdaily-fs" id="cd-events">
        <legend><?php _e('COM_CONNECTDAILY_Events',CDailyPlugin::CAPTION_BUNDLE); ?></legend>
        <label id="lbl-list-events-by" for='cd-list-events-by'>
        <?php _e('COM_CONNECTDAILY_SHOW_BY', CDailyPlugin::CAPTION_BUNDLE); ?></label>
        <br>
        <?php echo $s_dropdown; ?>
        <br>
        <label id="lbl-list-events-for" for="cd-list-events-by_id"><?php _e('COM_CONNECTDAILY_SHOW_FOR', CDailyPlugin::CAPTION_BUNDLE); ?></label>
        <label id="lbl-default-calendar" style="display: none;"><?php _e('COM_CONNECTDAILY_DefaultCalendar', CDailyPlugin::CAPTION_BUNDLE); ?></label>
        <br>

        <select id="cd-list-events-by_id">
            <option>Some Calendar</option>
        </select>
        <br>
        <label id="lbl-cd-iframe-view">
        <?php _e('COM_CONNECTDAILY_CALENDAR_FORMAT', CDailyPlugin::CAPTION_BUNDLE); ?>
        <br>
        <select id="cd-iframe-view">
            <option value="View.html"><?php _e("COM_CONNECTDAILY_DefaultCalendarView", CDailyPlugin::CAPTION_BUNDLE); ?></option>
            <option value="ViewCal.html"><?php _e("COM_CONNECTDAILY_MonthView", CDailyPlugin::CAPTION_BUNDLE); ?></option>
            <option value="ViewWeek.html"><?php _e("COM_CONNECTDAILY_WeekView", CDailyPlugin::CAPTION_BUNDLE); ?></option>
            <option value="ViewDay.html"><?php _e("COM_CONNECTDAILY_DayView", CDailyPlugin::CAPTION_BUNDLE); ?></option>
            <option value="ViewYear.html"><?php _e("COM_CONNECTDAILY_YearView", CDailyPlugin::CAPTION_BUNDLE); ?></option>
            <option value="ViewList.html"><?php _e("COM_CONNECTDAILY_ListView", CDailyPlugin::CAPTION_BUNDLE); ?></option>
        </select>
        </label>
        </fieldset>

        <fieldset style="display: none;" class="cdaily-fs"
            id="cd-rcalendar-settings">

        <label>
        <input type="checkbox" value="0" name="cd-wrap-events"
            id="cd-rcalendar-wrap">
        <?php _e('COM_CONNECTDAILY_WRAPTITLES', CDailyPlugin::CAPTION_BUNDLE); ?>
        </label><br>

        <label>
        <input type="checkbox" value="0" name="cd-enable-dropdown"
            id="cd-rcalendar-enabledropdown">
        <?php _e('COM_CONNECTDAILY_ENABLE_SELECTDD', CDailyPlugin::CAPTION_BUNDLE); ?>
        </label><br>

        <label>
        <input type="checkbox" value="0" name="cd-enable-styles"
            id="cd-rcalendar-enablestyles">
        <?php _e('COM_CONNECTDAILY_ENABLE_STYLES', CDailyPlugin::CAPTION_BUNDLE); ?></label>

        </fieldset>
        <fieldset style="display: none;" class="cdaily-fs"
            id="cd-iframe-settings">

        <legend><?php _e('COM_CONNECTDAILY_IFRAMESIZE', CDailyPlugin::CAPTION_BUNDLE); ?></legend>

        <label><?php _e('COM_CONNECTDAILY_Height', CDailyPlugin::CAPTION_BUNDLE); ?>
        <input type="text" size="8" id="cd-iframe-height"
            name="cd-iframe-height" value="1024px">
        </label>

        <label style="margin-left: 32px;"><?php _e('COM_CONNECTDAILY_Width', CDailyPlugin::CAPTION_BUNDLE); ?>
        <input type="text" size="8" id="cd-iframe-width"
            name="cd-iframe-width" value="100%">
        </label>
        <br>
        </fieldset>
        <fieldset class="cdaily-fs" id="cd-event-list-settings">
        <legend><?php _e('COM_CONNECTDAILY_LIST_SETTINGS', CDailyPlugin::CAPTION_BUNDLE); ?></legend>

        <label><?php _e('COM_CONNECTDAILY_MAX_EVENTS', CDailyPlugin::CAPTION_BUNDLE); ?>
        <input size="4" type="number" min="1" id="cd-max-events"
            name="cd-max-events" value="6"></label><br>

        <label><?php _e('COM_CONNECTDAILY_MAX_DAYS', CDailyPlugin::CAPTION_BUNDLE); ?>
        <input size="4" type="number" min="1" id="cd-max-days"
            name="cd-max-days" value="30"></label><br>
        <br>
        <label>
        <input type="checkbox" value="0" name="cd-allow-duplicates"
            id="cd-allow-duplicates" checked>
        <?php _e('COM_CONNECTDAILY_SHOW_ONCE', CDailyPlugin::CAPTION_BUNDLE); ?></label>
        <br>
        <label id="lbl-cd-show-starttimes">
        <input type="checkbox" value="1" name="cd-show-starttimes"
            id="cd-show-starttimes">
        <?php _e('COM_CONNECTDAILY_SHOWSTART', CDailyPlugin::CAPTION_BUNDLE); ?></label>
        <br>
        <label id="lbl-cd-show-endtimes">
        <input type="checkbox" value="1" name="cd-show-endtimes"
            id="cd-show-endtimes">
        <?php _e('COM_CONNECTDAILY_SHOWEND', CDailyPlugin::CAPTION_BUNDLE); ?></label>
        </fieldset>
        <fieldset class="cdaily-fs" id='cd-add-options'>
        <label>
            <input type="checkbox" value="1" id="cd-allow-recurrence" name="cd-allow-recurrence" checked>
            <?php _e('COM_CONNECTDAILY_AllowRecurrence', CDailyPlugin::CAPTION_BUNDLE); ?>
        </label>
        </fieldset>
        <!--
                Options for the Filter Shortcode.    
        -->
        <fieldset class="cdaily-fs" id="cd-filter-options">
        <label>
            <?php _e("COM_CONNECTDAILY_FilterBy",CDailyPlugin::CAPTION_BUNDLE); ?><br>
            <select id="cd-filter-by-method">
            <option value="item_type_id"><?php _e("COM_CONNECTDAILY_ListByType",CDailyPlugin::CAPTION_BUNDLE); ?></option>
<?php
     if ($independentStyles) {
         ?>
        <option value="style_id"><?php _e("COM_CONNECTDAILY_ListByStyle",CDailyPlugin::CAPTION_BUNDLE); ?></option>
    <?php
     }
?>
<?php
     if ($multiCalendar) {
         ?>
        <option value="calendar_id"><?php _e("COM_CONNECTDAILY_ListByCalendar",CDailyPlugin::CAPTION_BUNDLE); ?></option>
    <?php
     }
?>
<?php
     if ($locations) {
         ?>
        <option value="location_id"><?php _e("COM_CONNECTDAILY_ListByLocation",CDailyPlugin::CAPTION_BUNDLE); ?></option>
    <?php
     }
?>
            </select>
        </label><br>
        <label>
            <?php _e("COM_CONNECTDAILY_Title",CDailyPlugin::CAPTION_BUNDLE); ?><br>
            <input type=text name="cd-filter-title" id="cd-filter-title" value="<?php _e("COM_CONNECTDAILY_Filter",CDailyPlugin::CAPTION_BUNDLE); ?>">
        </label><br>
        <label>
            <?php _e("COM_CONNECTDAILY_CollapseThreshold",CDailyPlugin::CAPTION_BUNDLE); ?><br>
        <input size="4" type="number" min="0" id="cd-collapse-threshold"
            name="cd-collapse-threshold" value="6"></label>
        </label><br>
        <label>
            <?php _e("COM_CONNECTDAILY_CollapseLabel",CDailyPlugin::CAPTION_BUNDLE); ?><br>
            <input type=text name="cd-collapse-label" id="cd-collapse-label" value="(-)">
        </label><br>
        <label>
            <?php _e("COM_CONNECTDAILY_ExpandLabel",CDailyPlugin::CAPTION_BUNDLE); ?><br>
            <input type=text name="cd-expand-label" id="cd-expand-label" value="(+)"><br>
        </label>
        </fieldset>
    </div>
    <div class="submitbox">
        <div id="cdaily-update">
            <input onclick="CDaily.generateShortCode();"
                type="button"
                value="<?php esc_attr_e('Add Short Code',CDailyPlugin::CAPTION_BUNDLE); ?>"
                class="button-primary" id="cdaily-submit"
                name="cdaily-submit">
        </div>
        <div id="cdaily-cancel">
            <a class="submitdelete"
                href="javascript:tinyMCE.activeEditor.windowManager.close();"><?php _e('COM_CONNECTDAILY_Cancel',CDailyPlugin::CAPTION_BUNDLE); ?></a>
        </div>
    </div>
    </form>
</div>
<?php
    }

    /**
     * Init callback hook to register the button.
     */
    public function addButton() {
        $url = $this->plugin->getSettings()->url;
        if (current_user_can('edit_pages') && !empty($url)) {
            add_filter('mce_external_plugins', array($this,'addCDailyPlugin'));
            add_filter('mce_buttons', array($this,'registerButton'));
        }
    }

    /**
     * Register our button with tinymce
     * 
     * @param $buttons 
     */
    function registerButton($buttons) {
        array_push($buttons, "|", "CDaily");
        return $buttons;
    }

    /**
     * Add our javascript file to the tinymce loop to create our 
     * button. 
     * 
     * @param $plugin_array 
     */
    function addCDailyPlugin($plugin_array) {
        $plugin_array['CDaily'] = plugin_dir_url(__FILE__) . 'button-action.js';
        return $plugin_array;
    }
}
