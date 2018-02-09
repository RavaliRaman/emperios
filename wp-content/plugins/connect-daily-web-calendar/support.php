<?php 
/*
Copyright 2017, MH Software, Inc.

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/
/**
 * This page just contains some basic HTML and information for our plugin's 
 * support page. 
 */
$settings=$this->getSettings(); // Our scope is being included in the CDailyWordPressPlugi class.

$supportInfo=$this->getCMSName()." Version: ".get_bloginfo('version').
    "\nSite URL: " . get_bloginfo('url').
    "\nLanguage: ".$settings->language.
    "\nTime Zone: ".$settings->timezone_string.
    "\n\nCalendar URL: ".$settings->url.
    "\nPlugin Version: ".CDailyPlugin::PLUGIN_NAME . ' v'.CDailyPlugin::VERSION_NUMBER.
    "\n\nPHP Version: " .phpversion().'/'.PHP_OS;

$supportMail='support@mhsoftware.com?Subject='.
    rawurlencode('Connect Daily '.$this->getCMSName().' Plugin').
    "&amp;Body=".
    rawurlencode("\n\n\n".$supportInfo);
/*
    This next major block tries to get the times in Local Time
    for the end user to view.
 
    For people like Australia, things are kind of hinky
    because the end time may be the next day...
*/
$tzDenver=new DateTimeZone('America/Denver');
$tzServer=$tzDenver;
try {
    $tzServer=$settings->timezone_string==='UTC' ? $tzDenver : new DateTimeZone($settings->timezone_string);
} catch (Exception $ex){
    $tzServer=$tzDenver;
}

$date=new CDDateTime();
$dLocal=new CDDateTime();
$dLocal->setTimezone($tzServer);

$date->setTimezone($tzDenver);
while ($date->getDow()==0 || $date->getDow()==7) {
    $date->incrementDays(1);
}
$timestr='<table><caption>Hours ('.$tzServer->getName().')</caption>';

$fmt=$settings->time_format;
if (empty($fmt)) {
    $fmt='g:i a';
}
for ($i=0; $i < 7; $i++) {
    if ($date->getDow()==0 || $date->getDow()==6) {
        $date->incrementDays(1);
        continue;
    }
    $date->setTime(9,0,0);
    $dLocal->setTimestamp($date->getTimestamp());
    $timestr.='<tr><td style="padding-right: 1.5em;">'.$dLocal->format('D').'</td><td>'.$dLocal->format($fmt);
    $date->setTime(17,30,0);
    $dLocal->setTimestamp($date->getTimestamp());
    $timestr.=' - '. $dLocal->format($fmt).'</td></tr>';
    $date->incrementDays(1);
}
$timestr.='</table>';

?>

<div class="CDpostbox" id="CDailyInstructions" style="padding: 1em;">
    <h1>Connect Daily Events Calendar</h1>
    <h3>Contact Support</h3>
    We take support seriously. You can get support for Connect Daily via any of the methods below.
    <dl>
        <dt>Support Forums</dt>
        <dd><a href="https://wordpress.org/support/plugin/connect-daily-web-calendar" target=_blank>https://wordpress.org/support/plugin/connect-daily-web-calendar</a></dd>
        <dt>EMail</dt>
        <dd><a href="mailto:<?php echo $supportMail; ?>">support@mhsoftware.com</a></dd>
        <dt>Telephone</dt>
        <dd><a href="tel:+13034389585">+1 303 438 9585</a>
        <br><br>
        <?php echo $timestr; ?>
        </dd>
    </dl>

        <H3>System Information</h3>
        Please provide this information to support staff when sending 
        an email or posting to the forums.<br><br>
        <form>
            <textarea onclick="this.select();" rows=10 style="width: 100%;" readonly><?php echo $supportInfo; ?></textarea>
        </form>

</div>
<div class="cdRightSide">
    <div class="CDpostbox">
        <h3>Plugin Tutorial</h3>
        <a href="<?php echo CDailyWPPlugin::TUTORIAL_URL.'?autoplay=1'; ?>" target=_blank title="<?php _e('Video Tutorial',CDailyPlugin::CAPTION_BUNDLE); ?>">
        <img id="CDTutorialImage" style="margin: 1em; width: 90%;" src="<?php echo plugins_url("",plugin_basename(__FILE__)); ?>/images/WPPluginTutorial_N.png">
        </a>
    </div>
    <div class="CDpostbox">
        <h3>Documentation</h3>
            <ul>
                <li><a href="<?php echo CDailyPlugin::HELP_PAGE; ?>WordPressCalendarPlugin.html" target=_blank><?php _e('COM_CONNECTDAILY_UserGuide',CDailyPlugin::CAPTION_BUNDLE); ?></a></li>
                <li><a href="<?php echo CDailyPlugin::HELP_PAGE; ?>WordPressCalendarPluginFAQ.html" target=_blank><?php _e('Plugin FAQ',CDailyPlugin::CAPTION_BUNDLE); ?></a></li>
                <li>
                    <a href="<?php echo CDailyPlugin::HELP_BASE; ?>Tutorials.html" target="_blank"><?php _e('COM_CONNECTDAILY_AllTutorials',CDailyPlugin::CAPTION_BUNDLE); ?></a>
                </li>
            </ul>
    </div>
</div>

<script type="text/javascript">
    jQuery('#CDTutorialImage').mouseover(function(){
        jQuery(this).attr('src',jQuery(this).attr('src').replace(/_N\.png/,'_H.png'));
    }).mouseout(function(){
        jQuery(this).attr('src',jQuery(this).attr('src').replace(/_H\.png/,'_N.png'));
    });
    </script>

<?php
