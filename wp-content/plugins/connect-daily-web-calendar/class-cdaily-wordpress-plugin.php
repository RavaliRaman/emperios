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
 * This is a WordPress specific implementation of the 
 * CDailyPlugin class. It basically provides those services that 
 * the plugin needs like making get requests, or serializing 
 * cached data. 
 * <br><br> 
 * It's implemented as a singleton to allow access to the 
 * instance without using global or another hack. 
 * 
 * @author gsexton (11/27/2015)
 */
class CDailyWPPlugin extends CDailyPlugin {

    
    private $ajax=null;
    private $calMaker=null;
    private $editor=null;
    /** CDailyLocaleHelper   */
    private $lh=null;
    private $lister=null;
    private $settings = null;
    private $pluginFileName=null;
    protected $name = 'Connect-Daily-Web-Calendar';
    const PURGE_CRONJOB = 'cdaily_purge';
    const TUTORIAL_URL = '//vimeo.com/202461612';

    protected function __construct() {
        parent::__construct();

        $settings = $this->getSettings();
        $this->initFileName();
        
        if ($this->phpVersionCheck() && !empty($settings->url)) {
            $this->ajax=new CDWPAjaxHandler($this);
            $this->lister=new CDEventLister($this);
            $this->calMaker=new CDCalendarWriter($this);
            $this->registerShortCodes();
            if (is_admin()) {
                $this->editor=new CDWPEditorHook($this);
            }
        }
        /*
            Load our captions and set the hook for caption locales.
         
            @see pluginLocaleHook($locale)
        */
        add_action('plugin_locale', array($this, 'pluginLocaleHook'));
        add_action('plugins_loaded',array($this,'pluginLoadedHook'));
        $captionPath=dirname(plugin_basename(__FILE__)).'/captions/';
        load_plugin_textdomain(self::CAPTION_BUNDLE,false,$captionPath);    
    }

    public function pluginLoadedHook(){
        $settings=$this->getSettings();
        $this->registerActions(!empty($settings->url),$settings->used);
    }

    /**
     * OK, this is kind of a major kluge here. 
     *  
     * WordPress will ALWAYS tack on the locale to the file, AND it 
     * will not fallback to a base file name if the locale specific 
     * variant is not found. Practically speaking, what this means 
     * is that we have to examine the requested locale, and if it's 
     * not supported, return the locale of en_US to give them 
     * English. 
     *  
     * In a way this is OK, because if we're not exactly supported, 
     * we can implement our own fallback. Say de_CH isn't directly 
     * supported, we can pick off the country code, and then return 
     * 'de_DE'. 
     */
    public function pluginLocaleHook($locale){
        $baseFileName=WP_PLUGIN_DIR.'/'.dirname(plugin_basename(__FILE__)).'/captions/'.self::CAPTION_BUNDLE.'-';
        $fileName=$baseFileName.$locale.'.mo';
        if (file_exists($fileName)) {
            return $locale;
        }
        // OK, we didn't find it. Let's try to find a language match:
        $lang=substr($locale,0,2);
        switch ($lang) {
        case 'de':
            return 'de_DE';
            break;
        case 'fr':
            return 'fr_FR';
            break;
        case 'es':
            return 'es_ES';
            break;
        }
        return 'en_US';
    }

    /**
     * Enqueue the per-item style, or by event type style sheet.
     */
    public function addEventStyles(){
       wp_register_style('cdaily-style-helper', $this->getAjaxURL('action=cd_csshelper'),array(),CDailyPlugin::VERSION_NUMBER);
       wp_enqueue_style('cdaily-style-helper');
    }

    public function addPluginStylesheet() {
        /** Enqueue plugin style-file */
        wp_register_style('cdaily-style', plugins_url('cdaily.css', __FILE__),array(),CDailyPlugin::VERSION_NUMBER);
        wp_enqueue_style('cdaily-style');
        wp_register_script('cdaily-plugin-js', plugins_url('cdaily-plugin.js', __FILE__), array(
            'json2',
            'jquery',
            'wpdialogs'),
             CDailyPlugin::VERSION_NUMBER);
        $aLocalized=array(
            'ajaxURL' => admin_url('admin-ajax.php')
            );

        /*
            the behavior of this was not really what I expected. What the
            call really does is create an object variable name cd_scriptvars
            where each member of the array is a member of the object.
        */
        wp_localize_script('cdaily-plugin-js','cd_scriptvars',$aLocalized);
        wp_enqueue_script('cdaily-plugin-js');
        wp_enqueue_style("wp-jquery-ui-dialog");
        $social=$this->getSocialNetworkHelper();
        if ($social!=null) {
            wp_register_script('cdaily-social-network',$social->getPageLevelCodeURL(),array(),null,true);
            wp_enqueue_script('cdaily-social-network');
        }
    }


    /**
     * Older versions had a lot of different options stored. They're 
     * now all stored in one variable. This eliminates the old 
     * single-values. 
     */
    private function convertSettings($settings) {
        $s = get_option('cdaily_url');
        if ($s != null) {
            $settings->url = $s;
        }
        $s = get_option('cdaily_skip_resource_types');
        if ($s != null) {
            $settings->skip_resource_types = $s;
        }
        $s = get_option('cdaily_username');
        if ($s != null) {
            $settings->username = $s;
        }
        $s = get_option('cdaily_password');
        if ($s != null) {
            $settings->password = $s;
        }
        $s = get_option('cdaily_token');
        if ($s != null) {
            $settings->token = $s;
        }
        $s = get_option('cdaily_used');
        if ($s != null) {
            $settings->used = true;
        }
        $s = get_option('cdaily_keypair');
        if ($s != null) {
            $settings->{"keypair"}
                = $s;
        }
        $s = get_option('cdaily_resource_management', false);
        $settings->resource_management = $s;
        $settings->{"version"}=static::VERSION_NUMBER;
        $settings->converted = true;
        $this->saveSettings($settings);
        $a = explode(',', 'cdaily_url,cdaily_username,cdaily_password,cdaily_token,cdaily_skip_resource_types,cdaily_used,cdaily_resource_management,cdaily_keypair,cdaily_disable_timestamp');
        foreach ($a as $key) {
            delete_option($key);
        }
    }

    

    /**
     * called by admin_menu hook
     */
    public function createMenuItems() {

        $CDPlugin=$this;
        /*
            Get a count of notices so we can display that in our menu bar.
        */
        $notices=$CDPlugin->getNotices();
        $aSettings=$notices->getMessages("settings");
        $aOverview=$notices->getMessages("overview");
        $count = $notices->getMessageCount();
        if (empty($count)) {
            $aOverview=$this->getUnseenHints(array('AddEvents','SolicitReview'));
            $count=sizeof($aOverview);
        }
        
        $totalNotices=$count==0 ? '' : " <span class=\"update-plugins count-$count\"><span class=\"plugin-count\" aria-hidden=\"true\">$count</span></span>";
        $settingsNotices=empty($aSettings) ? '' : ' <span class="update-plugins count-1"><span class="plugin-count" aria-hidden="true">1</span></span>';
        $overViewNotices=empty($aOverview) ? '' : ' <span class="update-plugins count-1"><span class="plugin-count" aria-hidden="true">1</span></span>';

        // Create a new menu page specifically for this plugin
        add_menu_page(__('Connect Daily Overview',CDailyPlugin::CAPTION_BUNDLE), 'Connect Daily '.$totalNotices, 'manage_options', 'cdaily-menu', array($this,'overviewPage'),'dashicons-calendar-alt');
        // Add a new submenu under Settings:
        add_submenu_page('cdaily-menu', __('Connect Daily Overview',CDailyPlugin::CAPTION_BUNDLE), __('COM_CONNECTDAILY_Overview',CDailyPlugin::CAPTION_BUNDLE).$overViewNotices, 'manage_options', 'cdaily-menu', array($this,'overviewPage'));
        add_submenu_page('cdaily-menu', __('Connect Daily Settings',CDailyPlugin::CAPTION_BUNDLE), __('COM_CONNECTDAILY_Settings',CDailyPlugin::CAPTION_BUNDLE).$settingsNotices, 'manage_options', 'cdaily-settings', array($this,'settingsForm'));
        add_submenu_page('cdaily-menu', __('Connect Daily Style',CDailyPlugin::CAPTION_BUNDLE), __('COM_CONNECTDAILY_Style',CDailyPlugin::CAPTION_BUNDLE), 'manage_options', 'cdaily-settings-style', array($this,'editStyleForm'));
        //
        // The page on-load fires and changes the url to our login routine here.
        //
        if ($this->isConfigured()) {
            add_submenu_page('cdaily-menu', 
                             __('Connect Daily Login',CDailyPlugin::CAPTION_BUNDLE), 
                             __('COM_CONNECTDAILY_AddEvents',CDailyPlugin::CAPTION_BUNDLE), 
                             'edit_posts', 'cdaily-sslogin', 'cdaily_login');
        }
        add_submenu_page('cdaily-menu', __('COM_CONNECTDAILY_Support',CDailyPlugin::CAPTION_BUNDLE), __('COM_CONNECTDAILY_Support',CDailyPlugin::CAPTION_BUNDLE), 'manage_options', 'cdaily-settings-support', array($this,'showSupportForm'));
    }

    /**
     * Display the calendar creation fieldset.
     */
    private function createForm(){
        $user=$this->getCurrentUser();
        $sMail=empty($user->user_email) ? $this->getSiteEmail() : $user->user_email;

        ?>
    <script type="text/javascript">
    CDaily["showSpinner"]=function(sSelector){
	var btn=document.getElementById(sSelector);
	btn.disabled=true;
        jQuery("#idCDProvisioningSpinner").addClass("is-active");
	btn.form.submit();
        return true;
    };
   
    </script>

    <fieldset ID="fldSetCreateNewCalendar">
        <legend class="cdaily">
            <?php _e("Create a new Connect Daily Calendar", CDailyPlugin::CAPTION_BUNDLE); ?>
        </legend>
        <dl>
            <dt>
                <label for="idCDOrgName">
                    <?php _e("COM_CONNECTDAILY_OrgName", CDailyPlugin::CAPTION_BUNDLE); ?>
                </label>
            </dt>
            <dd>
                <input ID=idCDOrgName type="text" size="50" value="<?php esc_attr_e($this->getSiteName()); ?>" name="organization_name" required>
            </dd>
            <dt>
                <label for="idCDSiteURL">
                <?php _e("Site URL", CDailyPlugin::CAPTION_BUNDLE); ?>
                </label>
            </dt>
            <dd>
                <input id="idCDSiteURL" name="site_url" type="url" size="50" value="<?php esc_attr_e($this->getSiteUrl()); ?>" required>
            </dd>
            <dt>
                <label for="idCDEMail">Email Address</label>
            </dt>
            <dd>
                <input id=idCDEMail type=email name=provision_email value="<?php echo $sMail; ?>" >
            </dd>
            <dt><?php _e("COM_CONNECTDAILY_ScheduleYourResources",CDailyPlugin::CAPTION_BUNDLE); ?></dt>
            <dd>
                <table>
                    <tr>
                        <td style="vertical-align: top; width: 32px;">
                            <input id="idCDProvisionExampleResourceManagement" type="checkbox" name="provision_resources" value="1">
                        </td>
                        <td style="max-width: 60ex;">
                            <label for="idCDProvisionExampleResourceManagement">
                            <?php _e("COM_CONNECTDAILY_PROVISIONEXAMPLERESOURCEMANAGEMENT",CDailyPlugin::CAPTION_BUNDLE); ?>
                            </label>
                        </td>
                    </tr>
                </table>
            </dd>
            <dt><?php _e("COM_CONNECTDAILY_PROVISIONPUBLICADD",CDailyPlugin::CAPTION_BUNDLE); ?></dt>
            <dd>
                <table>
                    <tr>
                        <td style="vertical-align: top; width: 32px;">
                            <input id="idCDProvisionPublicAdd" type="checkbox" name="provision_publicadd" value="1">
                        </td>
                        <td style="max-width: 60ex;">
                            <label for="idCDProvisionPublicAdd">
                            <?php _e("COM_CONNECTDAILY_PROVISIONPUBLICADD_DETAIL",CDailyPlugin::CAPTION_BUNDLE); ?>
                            </label>
                        </td>
                    </tr>
                </table>
            </dd>
    <!--
            <dt>
                <label for="idCDNewUserName">
                <?php _e("User Name (optional)", CDailyPlugin::CAPTION_BUNDLE); ?>
                </label>
            </dt>
            <dd>
                <input ID="idCDNewUserName" type="text" size=20 value="<?php echo $user->user_name?>" readonly>
            </dd>
            <dt>
                <label for="idCDNewUserPassword">
                <?php _e("Password (optional)", CDailyPlugin::CAPTION_BUNDLE); ?>
                </label>
            </dt>
            <dd>
                <input ID="idCDNewUserPassword" type="password" size=20 value="" name=cdNewUserPassword>
            </dd>
            <dt>
            <label for="idCDNewUserConfirmPassword">
                <?php _e("COM_CONNECTDAILY_ConfirmPassword", CDailyPlugin::CAPTION_BUNDLE); ?>
            </label>
            </dt>
            <dd>
                <input ID="idCDNewUserConfirmPassword" type="password" size=20 value="" name=cdNewUserConfirmPassword>
            </dd>
    -->
            <!--
            <dt>
            <?php _e("Terms and Conditions", CDailyPlugin::CAPTION_BUNDLE); ?>
            </dt>
            
            <dd>            
            <label>
                I accept the <a onclick="return CDaily.showTerms(event);">terms and conditions</a> surrounding the use of Connect Daily web calendar.
            </label>
            </dd>
            -->
        <dd>
        <input ID=idCDTC type="hidden" name="chkCDTermsAndConditions" value="1">
        <p class="submit">
            <span style="float: left;" id="idCDProvisioningSpinner" class="spinner"></span>
        <input type="button" id="IDCDCreateCalendar" onclick="return CDaily.showSpinner('IDCDCreateCalendar');" class="button-primary" value="<?php esc_attr_e('COM_CONNECTDAILY_CreateCalendar',CDailyPlugin::CAPTION_BUNDLE); ?>" <?php echo $this->phpVersionCheck() ? '' : 'disabled="disabled"'; ?>/>
            
        </p>
            
        </dd>
        </dl>
        </fieldset>
      <?php
    }

    /**
     * This function provides an editor form for the plugin's style 
     * sheet. 
     */
    public function editStyleForm() {
        // Check that the user has the correct capability
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
        // Read in existing option value from database
        $css_filename = dirname(__FILE__) . "/cdaily.css";
        $cdaily_css   = trim(file_get_contents($css_filename));
        // See if the user has posted us some information
        // by checking the hidden field sent in the form.
        if (isset($_POST['form_submit']) && $_POST['form_submit'] == 'Y') {
            // Read the submitted value
            $cdaily_css = stripslashes($_POST['cdaily_css']);
            file_put_contents($css_filename, $cdaily_css);
            // Put an settings updated message on the screen
        ?>
        <div class="updated">
            <p>
            <strong><?php _e('COM_CONNECTDAILY_SaveOK', CDailyPlugin::CAPTION_BUNDLE); ?></strong>
            </p>
        </div>
        <?php
        }
        // Now display the settings editing screen
        echo '<div class="wrap">';
        echo '<div class="icon32" id="icon-options-general"><br></div>';
        // header
        echo "<h2>" . __('Connect Daily Style Sheet', CDailyPlugin::CAPTION_BUNDLE) . "</h2>";
        // settings form

        ?>
        <form name="form1" method="post" action="">
            <input type="hidden"    name="form_submit"  value="Y">
            <label for="StyleTextArea">CSS</label> File: <?php echo $css_filename; ?>
            <br>
            <br>
            <textarea style="float: left; " id="StyleTextArea" name="cdaily_css"><?php echo esc_html($cdaily_css); ?></textarea>
        
            <div style="margin-top: 0; margin-left: 2em;" class="CDpostbox cdRightSide" id="CDailyInstructions">
                <h3 style="margin-bottom: 0; padding-bottom: 0;">Instructions</h3>
                <p style="padding: 1em; padding-top: 0; ">
                Use this page to edit the CSS for the Connect Daily plugin. This
                sheet does not affect the display of the regular, large-format calendars
                included via IFRAME. To change the style for the large-format calendars, login
                and use the Change Colors page.
                </p>
            </div>
            <p style="clear: both;" class="submit">
                <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('COM_CONNECTDAILY_SaveChanges',CDailyPlugin::CAPTION_BUNDLE); ?>" />
            </p>
        </form>
        <?php

    }

    public function createNonce($nonce_data){
        return wp_create_nonce($nonce_data);
    }

    /**
     * Retrieve information or data from the system cache. 
     *  
     * @return CDailyDataResponse if successful, null if not or 
     *         caching is disabled.
     */
    public function fetchDataFromCache($slugname, $url,$fields=null) {
        if (!$this->isCacheEnabled()) {
            return null;
        }
        $key_value = $this->getKeyName($slugname, $url,$fields);
        $cached_data = get_transient($key_value);
        if (empty($cached_data)) {
            return null;
        }
        // $this->debugOut("fetchDataFromCache - cached data=",$cached_data);
        $res = new CDailyDataResponse($cached_data);
        if ($res->getJSONError()!=null) {
            $this->logError($res->getJSONError()->toString());
        }
        return $res;
    }

    /**
     * Return the URL javascript calling this plugin should use for 
     * making AJAX requests. 
     */
    public function getAjaxURL($addlParms=null,$absolute=false){
        $result= admin_url('admin-ajax.php?action=cdaily');
        if ($addlParms!=null) {
            // the format is ?action=cdaily&subaction=....
            $result.='&sub'.$addlParms;
        }
        return $result;
    }

    public function getCurrentUser() {
        //
        // wp_get_current_user doesn't seem to load until AFTER the plugin. So, 
        // if you try to call this method too soon, it will bomb.
        //
        $wp = wp_get_current_user();
        $res=new stdClass();
        $res->{"user_name"}=$wp->user_login;
        $res->{"user_email"}=$wp->user_email;
        $res->{"user_fullname"}=$wp->display_name;
        return $res;
    }

    /**
     * Return the URL to a specified Icon. 
     *  
     * @param $iconID String the Mnemonic value for the icon in the 
     *                captions file.
     *  
     * @return The fully qualified path to the icon. 
     */
    public function getIconURL($iconID) {
        return plugins_url('images/'.$this->translate($iconID), __FILE__);
    }

    /**
     * Retrieve our singleton instance. 
     *  
     * @return CDailyWPPlugin 
     */
    public static function getInstance(){
        $o=parent::getInstance();
        if ($o==null) {
            $o=new CDailyWPPlugin();
            self::setInstance($o);
        }
        return $o;
    }

    /**
     * @return CDailyLocaleHelper
     */
    public function getLocaleHelper(){
        if ($this->lh==null) {
            $this->lh=new CDailyWordPressLocaleHelper();
        }
        return $this->lh;
    }
   /**
    * Return previously stored data using the nonce key. 
    *  
    * Retrieving the value is a one-time operation, deleting the 
    * value from the transient table. 
    */
    public function getNonceTransient($nonce) {
        $data = get_transient("cdnonce_" . $nonce);
        if ($data === false) {
            return false;
        }
        delete_transient("cdnonce_" . $nonce);
        return $data;
    }

    public function getRequiredCaptions($a){
        $res='<script type="text/javascript">CDaily.addCaptions({"captions" : [';
        foreach ($a as $caption){
            $res.='{"caption" : "'.self::CAPTION_PREFIX.$caption.'", "value" : '.json_encode(__(self::CAPTION_PREFIX.$caption,CDailyPlugin::CAPTION_BUNDLE)).'},';
        }
        $res.='{"caption" : "UNUSED","value" : null}]});</script>';
        return $res;
    }

    public function getSiteDescription() {
        return get_bloginfo('description');
    }

    public function getSiteEmail() {
        return get_bloginfo('admin_email');
    }

    public function getSiteName() {
        $value=get_bloginfo('name');
        if (empty($value)) {
            $value=gethostname();
        }
        return $value;
    }
    /**
     * Retrieve the settings object. Defined values are: 
     *  
     * url - char
     * skip_resource_types - char
     * used - boolean 
     * username - char 
     * password - char 
     * token - char 
     * disable_timestamp - int (or long) 
     * converted - boolean - internal use only. 
     * keypair 
     */
    public function getSettings() {
        if (empty($this->settings)) {
            $s = get_option('cdaily_settings', '{"url" : "", "skip_resource_types" : "","used" : false,"username" : "","password" : "",'.
                            '"disable_timestamp" : '.( time() + 2 * self::CACHE_DISABLE_PERIOD_SECONDS ).
                            ',"converted" : false,"token" : ""}');
            $this->settings = json_decode($s);
            if (!$this->settings->converted) {
                $this->convertSettings($this->settings);
            }
            $this->settings->{"time_format"} = get_option('time_format');
            $this->settings->{"date_format"} = get_option('date_format');
            $tz = get_option('timezone_string');
            if (empty($tz)) {
                $tz = 'GMT';
            }
            if (!property_exists($this->settings,"datetime_format") || empty($this->settings->datetime_format)) {
                $this->settings->{"datetime_format"}
                    = get_option("datetime_format", $this->settings->date_format . ' ' . $this->settings->time_format);
            }
            if (empty($this->settings->skip_resource_types)) {
                $this->settings->skip_resource_types = "";
            }
            $this->settings->{"timezone_string"} = $tz;
            $s = get_option('start_of_week', '1');
            $this->settings->{"start_of_week"} = intval($s);
            $this->settings->{"language"} = str_replace('-', '_', get_bloginfo('language'));
            if (property_exists($this->settings,"version")) {
                    if ($this->settings->version!=static::VERSION_NUMBER) {
                        $this->upgradeSettings($this->settings);
                    }
                } else {
                $this->settings->{"version"}=static::VERSION_NUMBER;
            }
        }
        return $this->settings;
    }

    public function getSiteUrl() {
        return $this->addfs(site_url());
    }

    public static function getUserAgent(){
        return 'WordPress/'.get_bloginfo('version').
            '; '.self::PLUGIN_NAME.' v'.self::VERSION_NUMBER.
            '; PHP v'.phpversion().'/'.PHP_OS.
            '; '.get_bloginfo('url');
    }

    /**
     * Initialize the plugin main file name for use by other 
     * elements. 
     */
    private function initFileName(){
        $pluginFileName=plugin_basename(__FILE__);
        $c=DIRECTORY_SEPARATOR;
        if (strrpos($pluginFileName,$c)>0) {
            $pluginFileName=substr($pluginFileName,0,strrpos($pluginFileName,$c)+1).'cdaily.php';
        }
        $this->pluginFileName=$pluginFileName;
    }

    public function install() {
        add_option('activation_redirect', true);
        wp_schedule_event(time(), 'hourly', self::PURGE_CRONJOB);
    }

    public function loadAdminCSS() {
        $settings = $this->getSettings();
        $plugin_path = plugins_url('', __FILE__);
        /*
            Get our type data for the various dropdowns.
        */
        $calendar_url = $settings->url;
        $typeData = '';
        if (!empty($calendar_url)) {
            $reqData = $this->getPostData('type-data', 'json/list.js',array('request_number' => 'VIEWABLE_TYPES'));
            if ($reqData->wasSuccess()) {
                $typeData = $reqData->content;
            }
            // This can error out, but we don't want it saved...
            $this->clearLastError();
        }
        if (empty($typeData)) {
            $typeData = "{}";
        }
?>
<script type="text/javascript">
CDaily["ajaxURL"]=ajaxurl;
CDaily["typeData"]=<?php echo $typeData; ?>;
CDaily["pluginPath"]="<?php echo $plugin_path; ?>";
CDaily["hostURL"]="<?php echo $calendar_url; ?>";
</script>
<?php
    }

    public function loadAdminScripts() {
        wp_register_script('cdaily-admin', plugins_url('cdaily-admin.js', __FILE__), array(
                               'json2',
                               'jquery',
                               'wpdialogs'
                               ),
                           CDailyPlugin::VERSION_NUMBER
                           );
        wp_enqueue_script('cdaily-admin');
        wp_register_style('cdaily-admin-css', plugins_url('cdaily-admin.css', __FILE__),array(),CDailyPlugin::VERSION_NUMBER);
        wp_enqueue_style('cdaily-admin-css');
        wp_enqueue_style("wp-jquery-ui-dialog");
    }

    /**
     * Make a POST request back to Connect Daily, returning a 
     * CDailyDataResponse object with the results. 
     *  
     * @param $url - the fully qualified absolute URL for the 
     *              request.
     * @param $fields - Optional, the Form fields to send in the 
     *                POST request.
     * @param $options - Optional request options. For WP, anything 
     * in this array is added tot he options passed to 
     * wp_remote_post. 
     *  
     * @return CDailyDataResponse - If the request is successful, 
     *         the CDailyDataResponse->error value will be 0.
     *  
     * If there's an error, CDailyDataRponse->error will be 
     * non-zero and CDailyDataResponse->error_message will have the 
     * error message. Note that this is only the HTTP level error. 
     * Content may return it's own error message. 
     */
    public function makePostRequest($url,$fields=null,$options=null){
        $this->clearLastError();
        $res = new CDailyDataResponse();
        $res->url = $url;
        $res->fields=$fields;

        $args=array(
          'method' => 'POST',
          'timeout' => self::REQUEST_TIMEOUT,
          'redirection' => 0,
          'blocking' => true,
          'headers' => array("Accept-Language" => self::convertToBCP47($this->getSettings()->language),
                             "User-Agent" => self::getUserAgent()
                             ),
          'cookies' => array(),
          'sslverify' => false,
          'decompress' => true);

        if (isset($_SERVER['REMOTE_ADDR'])) {
            $args['headers']["X-Forwarded-For"] = $_SERVER['REMOTE_ADDR'];
        }
        if ($options!=null) {
            foreach ($options as $key => $default) {
                if ($default===null) {
                     if (array_key_exists($key,$args)) {
                        unset($args[$key]);
                     }
                } else {
                    $args[$key]=$default;
                }
            }
        }
        if ($fields!=null) {
            /*
                Somehow, users are quoting arguments using smart quotes. 
            */
            $sqStart=json_decode('"\u201c"');
            $sqEnd=json_decode('"\u201d"');
            foreach ($fields as $key => $value){
                if (mb_strlen($value)>2 && mb_substr($value,0,1)==$sqStart && mb_substr($value,-1,1)==$sqEnd) {
                    $fields[$key]=mb_substr($value,1,mb_strlen($value)-2);
                }
            }
            $args['body']=$fields;
        }
        // $this->debugOut("makePostRequest() $url, args=",$args);
        $response = wp_remote_post($url, $args);
        
        if (is_wp_error($response) || $response["response"]["code"] != "200") {
            if (is_wp_error($response)) {
                $res->error = -1;
                $msg = " API Level Error: " . $response->get_error_message();
                //$this->debugOut("response=",$response);
            } else {
                $res->error = intval($response['response']['code']);
                // $this->debugOut("$CDWPPlugin->makeGetRequest() response=",$response);
                if ($response['response']['code'] == '302') {
                    $msg = __('302 - Redirect. The request was redirected. This may be because SSL is required. Set the URL to HTTPS and re-test.',CDailyPlugin::CAPTION_BUNDLE);
                } else if ($response['response']['code'] == '403') {
                    $msg = __("403 - Access Denied. This is usually caused by an invalid user name or password, or anonymous access is disabled and you are not supplying a username/password.",CDailyPlugin::CAPTION_BUNDLE);
                } else if ($response['response']['code'] == '404') {
                    $msg = __("The object (calendar, resource, etc) is not valid. Check your shortcode or plugin parameters.",CDailyPlugin::CAPTION_BUNDLE);
                } else {
                    $msg = $response["response"]["code"] . " Message: " . $response["response"]["message"];
                }
            }
            
            $res->error_message = __('An error happened retrieving data from the calendar URL. The error was:',CDailyPlugin::CAPTION_BUNDLE).$msg.__('The URL was: ',CDailyPlugin::CAPTION_BUNDLE).$url;
            $this->logError($res->error_message);
            return $res;
        } else {
            // $this->debugOut(get_class($this)."->makePostRequest() response=",$response);
            if (isset($response['headers']['last-modified'])) {
                $tstamp = $response['headers']['last-modified'];
                $datetime = DateTime::createFromFormat(DateTime::RFC2822, $tstamp);
                if ($datetime instanceof DateTime) {
                    // Under some circumstances, this was failing. Check $datetime is valid.
                    $res->last_modified = $datetime->getTimestamp();
                } else {
                    $this->logError("Attempt to parse last-modified header failed. Value=" . $tstamp);
                }
            }
        }
        // $this->debugOut("Response: ",$res);
        $res->content = $response['body'];
        return $res;
    }

    /**
     * Make a get request to Connect Daily for information or data.
     */
    public function makeGetRequest($url) {
        $this->clearLastError();
        $res = new CDailyDataResponse();
        $res->url = $url;
        $response = wp_remote_get($url, array(
                                      'timeout' => self::REQUEST_TIMEOUT,
                                      'redirection' => 0,
                                      'headers' => array("Accept-Language" => self::convertToBCP47($this->getSettings()->language),
                                                         "User-Agent" => self::getUserAgent()
                                                         ),
                                      'decompress' => true));

        if (is_wp_error($response) || $response["response"]["code"] != "200") {
            if (is_wp_error($response)) {
                $res->error = -1;
                $msg = " API Level Error: " . $response->get_error_message();
                //$this->debugOut("response=",$response);
            } else {
                $res->error = intval($response['response']['code']);
                // $this->debugOut("$CDWPPlugin->makeGetRequest() response=",$response);
                if ($response['response']['code'] == '302') {
                    $msg = __('302 - Redirect. The request was redirected. This may be because SSL is required. Set the URL to HTTPS and re-test.',CDailyPlugin::CAPTION_BUNDLE);
                } else if ($response['response']['code'] == '403') {
                    $msg = __("403 - Access Denied. This is usually caused by an invalid user name or password, or anonymous access is disabled and you are not supplying a username/password.",CDailyPlugin::CAPTION_BUNDLE);
                } else if ($response['response']['code'] == '404') {
                    $msg = __("The object (calendar, resource, etc) is not valid. Check your shortcode or plugin parameters.",CDailyPlugin::CAPTION_BUNDLE);
                } else {
                    $msg = $response["response"]["code"] . " Message: " . $response["response"]["message"];
                }
            }
            
            $res->error_message = __('An error happened retrieving data from the calendar URL. The error was:',CDailyPlugin::CAPTION_BUNDLE).$msg.__('The URL was: ',CDailyPlugin::CAPTION_BUNDLE).$url;
            $this->logError($res->error_message);
            return $res;
        } else {
            // $this->debugOut("CDWPPlugin->makeGetRequest() response=",$response);
            if (isset($response['headers']['last-modified'])) {
                $tstamp = $response['headers']['last-modified'];
                $datetime = DateTime::createFromFormat(DateTime::RFC2822, $tstamp);
                if ($datetime instanceof DateTime) {
                    // Under some circumstances, this was failing. Check $datetime is valid.
                    $res->last_modified = $datetime->getTimestamp();
                } else {
                    $this->logError("Attempt to parse last-modified header failed. Value=" . $tstamp);
                }
            }
        }
        $res->content = $response['body'];
        return $res;
    }

    public function cdStatusBanner($fromPage = null,$globalDashboard=false ){
        $aNotices=$this->getNotices()->getMessages($fromPage);
        $count=sizeof($aNotices);
        if ($count==0) {
            /*
                  Let's see if there are hints we should display.
             
                  We only want hints when we are not on the dashboard.
            */
            if ($globalDashboard || !$this->isUsed()) {
                return;
            }
            $aHints=$this->getUnseenHints(array("AddEvents",'SolicitReview'));
            $count=sizeof($aHints);
            if ($count>0) {
                // We only want the first.
                $hintName=$aHints[0];
                $hintContent=str_replace("{0}",plugins_url('/',__FILE__),$this->translate("COM_CONNECTDAILY_HINT_".$hintName));
                $hintContent=str_replace("{1}",static::TUTORIAL_URL,$hintContent);

                $display='<div id="CDailyToolBarHint" class="notice notice-info is-dismissible"><h3>Connect Daily Events Calendar - '.
                    $this->translate("Hint").'</h3>'.
                    $hintContent.
                    '<br><br><label>'.
                    "<input type=\"checkbox\" onclick=\"return CDaily.dismissHint('".$hintName."','#CDailyToolBarHint');\">".
                    $this->translate("COM_CONNECTDAILY_DismissHintLabel").'</label><br><br>'.
                    '</div>';
                echo $display;
            }
        } else {
            /*
                These are warning notices.
            */
            $display='<div class="notice notice-warning is-dismissible"><h3>Connect Daily Events Calendar - '.
                $this->translate("COM_CONNECTDAILY_Alerts").'</h3><ul class="ul-disc">';
            
            foreach ($aNotices as $msg) {
                $display.='<li>'.$msg.'</li>';
            }
            
            $display.='</ul></div>';
            echo $display;
        }
    }

    /**
     * Display the overview page.
     */
    public function overviewPage() {
        $CDPlugin=$this;            // The HTML that's included references this variable.
        $CDPlugin->cdStatusBanner();
        include 'overview.html';
        include 'links-and-other-div.html';
    }

    /**
     * This adds some action links to our plugin entry on the 
     * plugins page. E.G. settings and support
     */
    public function pluginLinks($links,$file){
        if ($file==$this->pluginFileName) {
            array_unshift($links, 
                          '<a href="' . admin_url('/admin.php?page=cdaily-settings').'">'.__('COM_CONNECTDAILY_Settings',CDailyPlugin::CAPTION_BUNDLE).'</a>',
                          '<a href="' . admin_url('/admin.php?page=cdaily-settings-support').'">'.__('COM_CONNECTDAILY_Support',CDailyPlugin::CAPTION_BUNDLE).'</a>'
                          );
        }
        return $links;
    }


    function pluginRedirect() {
        if (get_option('activation_redirect', false)) {
            delete_option('activation_redirect');
            $admin_url = admin_url();
            wp_redirect($admin_url . 'admin.php?page=cdaily-settings');
        }
    } 

    /**
     * Purge our transients from the wp_options table. 
     *  
     * @param $all If true, purge all entries. If false, purge 
     *             expired entries.
     *  
     * * @param $includeHints If true, purge hint seen entries.  
     *  
     * @return String the purge results.
     */
    public function purgeTransients($all = false,$includeHints=false) {
        global $wpdb, $_wp_using_ext_object_cache;
        if ($_wp_using_ext_object_cache) {
            return "purgeTransients($all), exiting because _wp_using_ext_object_cache!";
        }
        $time = time();
        $iCount=0;
        $iDeleted = 0;

        if ($all) {         
            $time += 86400;
            /*
                I'm going all-in here to delete all of the transients. We had someone whose
                _transient_timeout_ record went away, leaving the cache data. In essence,
                this created a cache record that would never expire. This is kind of a safety
                to make sure when it says all, it means all... 
            */ 
            $iDeleted=$wpdb->query("DELETE FROM {$wpdb->options} WHERE ".
                         "option_name LIKE '_transient_timeout_cdaily%' OR ".
                         "option_name LIKE '_transient_cdaily%' OR ".
                         "option_name LIKE '_transient_timeout_cdnonce%' OR ".
                         "option_name LIKE '_transient_cdnonce%'"
                         );
            $iCount=$iDeleted;
        }
        
        $expired  = $wpdb->get_col("SELECT option_name FROM {$wpdb->options} ".
                                   "WHERE (option_name LIKE '_transient_timeout_cdaily%' ".
                                   "OR option_name LIKE '_transient_timeout_cdnonce%') ".
                                   "AND option_value < {$time};");
        foreach ($expired as $transient) {
            $iCount++;
            $key = str_replace('_transient_timeout_', '', $transient);
            if (delete_transient($key)) {
                $iDeleted++;
            }
        }

        if ($includeHints) {
            // Purge Hint Seen Entries.
            $wpdb->query("DELETE FROM $wpdb->usermeta WHERE meta_key LIKE '%".self::PLUGIN_NAME."%'");
        }

        return "purgeTransients($all,$includeHints) deleted: $iDeleted of $iCount transients.";
    }


    /**
     * This method hooks into save of a page, and if a plugin is 
     * used, it calls markUsed(). 
     *  
     * @return void 
     */
    public function saveHook() {
        parent::saveHook();
        if (isset($_POST['content'])) {
            if (strpos($_POST['content'], '[cdaily_') === false) {
                // it doesnt exist
            } else {
                $this->markUsed();
            }
        }
    }

    public function saveSettings($values) {
        // $this->debugOut("saveSettings() - values=",$values);
        $values->url = $this->secureURLIfPossible($values->url);
        foreach ($values as $key => &$value ) {
            if (gettype($value)=='string') {
                $value=trim($value);
                if (empty($value)) {
                    $value=null;
                }
            }
        }
        $this->settings = $values;
        update_option('cdaily_settings', json_encode($this->settings), true);
    }

    public function searchShortCode($atts, $content = null, $tag = null){
        $aParameters = $atts;
        $aRequest=$_SERVER['REQUEST_METHOD']=='GET' ? $_GET : $_POST;
        foreach (array(
            'other_options',
            'dayspan',
            'placeholder'
            ) as $key) {
            if (array_key_exists($key,$aRequest) && isset($aRequest[$key])) {
                $aParameters[$key]=$aRequest[$key];
            }
        }
        if (array_key_exists(CDailySearch::SEARCH_FIELD_NAME,$aRequest) && !empty($aRequest[CDailySearch::SEARCH_FIELD_NAME])) {
            $aParameters[CDailySearch::SEARCH_FIELD_NAME]=stripslashes($aRequest[CDailySearch::SEARCH_FIELD_NAME]);
        }
        
        $renderer=new CDailySearch($this);
        
        $res=$renderer->renderSearchInput($aParameters,$_SERVER['REQUEST_URI']);
        if (array_key_exists(CDailySearch::SEARCH_FIELD_NAME,$aRequest)) {
            $res.=$renderer->executeSearch($aParameters);
        }
        return $res;
    }

    /**
     * Store some data in the transient table, and generate a nonce 
     * that can be used to access it. 
     *  
     * @param $transient_data - the data to store.
     * @param $expires - The expiration time for the data. Default 
     *                 600 seconds.
     */
    public function setNonceTransient($transient_data, $expires = 600) {
        $time = time();
        $nonce = wp_create_nonce($time . $transient_data) . "-" . $time;
        set_transient("cdnonce_" . $nonce, $transient_data, $expires);
        return $nonce;
    }


    /**
     * Display the settings form for the plugin.
     * 
     * @author gsexton (11/25/2015)
     */
    function settingsForm() {
        $CDPlugin=$this;        // The HTML that's included references this variable also.
        $settings=$CDPlugin->getSettings();

        // Check that the user has the correct capability
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        // See if the user has posted us some information
        // by checking the hidden field sent in the form.
        $wasError=false;
        $message=null;
        
        if (isset($_POST['form_submit']) && $_POST['form_submit'] == 'Y') {
            // Read the submitted value
            $message="Settings saved."; 
            $calendar_choice=isset($_POST['rgCalendarChoice']) ? $_POST['rgCalendarChoice'] : 'use_existing';
            
            if ($calendar_choice=="use_existing") {
                $settings->datetime_format = stripslashes($_POST['datetime_format']);
                if (isset($_POST['cdaily_skip_resource_types'])) {
                    $settings->skip_resource_types = stripslashes($_POST['cdaily_skip_resource_types']);
                } else {
                    $settings->skip_resource_types='';
                }
                $currentURL=$settings->url;
                $settings->url = $this->secureURLIfPossible($_POST['cdaily_url']);
                if (isset($_POST['cdaily_disable_cache']) && "1" == $_POST["cdaily_disable_cache"]) {
                    $this->disableCache(false);
                }

                $username=trim(stripslashes($_POST['cdaily_username']));
                $password=trim(stripslashes($_POST['cdaily_password']));
                $changepw=false;
                if ($currentURL==$settings->url && $this->isPasswordChange($settings,$username,$password)) {
                    $result=$this->changeUserPassword($settings->username,$settings->password,$username,$password);
                    if ($result->error==0) {
                        $settings->username = $username;
                        $settings->password = $password;
                        $settings->token='&user_id='.$result->user_id.'&etoken='.$result->etoken;
                        $changepw=true;
                    } else {
                        $message=$result->error_message;
                    }
                } else {
                    $settings->username = $username;
                    $settings->password = $password;
                }
                $this->saveSettings($settings);
                $this->purgeTransients(true);

                // Save the submitted value in the database
                if (!$changepw) {
                    // Just a note, result will be null if there is no username/password.
                    $result=$this->fetchSecurityToken($settings);
                    if ($result==null) {
                        $message=$this->getLastError();
                    }
                    // We want to save on failure so that a bad token is removed...
                    $this->saveSettings($settings);
                }

                if ($result==null) {
                    $wasError=true;
                    $message=$this->getLastError();
                }
            } else if ($calendar_choice=="create") {
                $result=$this->provisionCalendarSystem(stripslashes($_POST['organization_name']),
                                                       $_POST['site_url'],
                                                       array_key_exists('provision_resources',$_POST) ? '1'===$_POST['provision_resources'] : false,
                                                       array_key_exists('provision_publicadd',$_POST) ? '1'===$_POST['provision_publicadd'] : false,
                                                       array_key_exists('provision_email',$_POST) ? $_POST['provision_email'] : 'user@example.com');
                if ($result['error']==0) {
                    $message='Calendar created. Click on Add Events to create calendar entries.';
                    $settings->url=$result['cdaily_url'];
                } else {
                    $wasError=true;
                    $message=$result['error_message'];
                }
            }
            // On the first pass through, the variable is set before the create runs.
            // This overrides the value set earlier in the request chain.
            echo '<script type="text/javascript">CDaily["hostURL"]="'.$settings->url.'";</script>';
            // Force a re-read because the save routine tries to force the URL to https.
            $settings=$this->getSettings();
        }
        // Put a settings updated message on the screen 
        if (!empty($message)) { 
            echo '<div class="'.($wasError ? "error cdaily-error" : "updated").' notice is-dismissible"><p><strong>'.__($message, CDailyPlugin::CAPTION_BUNDLE).'</strong></p></div>'; 
        }
        $CDPlugin->cdStatusBanner("settings");
        $tValue=$settings->url;
        $is_configured=!empty($tValue);
        // Now display the settings editing screen
        echo '<div class="wrap">';
        
        // header
        echo "<h2>" . __('COM_CONNECTDAILY_Settings', CDailyPlugin::CAPTION_BUNDLE) . "</h2>";

        // settings form
        
    ?>

    <div style="float: left; width: 80ex;">
    <form ID="cdSettingsForm" name="cdForm" method="post" onsubmit="return CDaily.validate_settings_form();" action="">
        <input type="hidden" name="form_submit"  value="Y">
        <input type="hidden" name="cd_configured" value="<?php echo $is_configured ? 'Y' : 'N'?>">
        <p>
        <?php
             if (!$is_configured) {
        ?>
        Use this form to setup your Connect Daily calendar. You can link to an existing Connect Daily calendar system or create a new one. We have a 
            <a href="<?php _e($CDPlugin::TUTORIAL_URL); ?>#t=1m17s" target=_blank>tutorial you can watch</a>.
        <fieldset style = "margin-bottom: 2em;" >
        <label>
        <input onclick="return CDaily.toggleSettingsFieldSets();" type="radio" ID=idCreateNewCalendar name="rgCalendarChoice" value="create" checked>
        <?php _e("Create a new Connect Daily Calendar system.", CDailyPlugin::CAPTION_BUNDLE); ?>
        </label>
        <br>

        <label>
        <input onclick="return CDaily.toggleSettingsFieldSets();" type="radio" ID=idConnectToExisting name="rgCalendarChoice" value="use_existing">
        <?php _e("Use an existing Connect Daily Calendar system.", CDailyPlugin::CAPTION_BUNDLE); ?>
        </label>
        
        </fieldset>
        <?php
             $this->createForm();
         }   // is_configured.
         ?>
        <fieldset ID="fldSetConnectExistingCalendar" style="display: <?php echo $is_configured ? 'block;' : 'none;'?>">
            <dl>
                <dt>
                    <label for="IDCDailyURL">
                    <?php _e("Connect Daily Calendar URL", CDailyPlugin::CAPTION_BUNDLE); ?>
                    </label>

                <dd>
                <input ID="IDCDailyURL" 
                    placeholder="<?php esc_attr_e("Enter the URL to your Connect Daily Calendar", CDailyPlugin::CAPTION_BUNDLE); ?>" 
                    type="url" 
                    name="cdaily_url" 
                    value="<?php echo $settings->url; ?>" 
                    onChange="return CDaily.cdaily_url_onChange(this);"
                    size="50">
                <dt>
                    <label for="IDCDailyUserName"><?php _e("COM_CONNECTDAILY_UserName", CDailyPlugin::CAPTION_BUNDLE); ?></label>

                <dd>
                <input ID="IDCDailyUserName" placeholder="<?php esc_attr_e("COM_CONNECTDAILY_OptionalPlaceHolder", CDailyPlugin::CAPTION_BUNDLE); ?>" type="text" name="cdaily_username" value="<?php echo $settings->username; ?>" size="20">
                <dt>
                    <label for="IDCDailyPassword"><?php _e("COM_CONNECTDAILY_Password", CDailyPlugin::CAPTION_BUNDLE); ?></label>
                <dd>
                <input ID="IDCDailyPassword" placeholder="<?php esc_attr_e("COM_CONNECTDAILY_OptionalPlaceHolder", CDailyPlugin::CAPTION_BUNDLE); ?>" type="text" name="cdaily_password" value="<?php echo $settings->password; ?>" size="20">
                </dl>
                <dl>
            <dt>
                <label for="IDCDailyDateTimeFormat">
                <?php _e("Date-Time Format", CDailyPlugin::CAPTION_BUNDLE); ?>
                </label>

            <dd>
            <input id="IDCDailyDateTimeFormat" placeholder="<?php esc_attr_e("Date-Time Format", CDailyPlugin::CAPTION_BUNDLE); ?>" type="text" name="datetime_format" value="<?php echo $settings->datetime_format; ?>" size="20">
            <a target=_BLANK href="http://codex.wordpress.org/Formatting_Date_and_Time"><?php _e("Documentation on date and time formatting",CDailyPlugin::CAPTION_BUNDLE); ?></a>.

            </dd>
                <?php
                if ($settings->resource_management) {
                ?>
                    <dt><label for="IDCDailySkipResourceTypes"><?php _e( "Skip Resource Types", CDailyPlugin::CAPTION_BUNDLE); ?></label></dt>
                    <dd>
                            <input id="IDCDailySkipResourceTypes" type="text" style="width: 60ex;" name="cdaily_skip_resource_types" value="<?php echo esc_attr($settings->skip_resource_types); ?>"
                                placeholder="<?php esc_attr_e("COM_CONNECTDAILY_OptionalPlaceHolder", CDailyPlugin::CAPTION_BUNDLE); ?>" 
                            >
                    </dd>
                <?php
                }
                ?>
            <dt><?php _e("Disable Caching", CDailyPlugin::CAPTION_BUNDLE); ?></dt>
            <dd>
            <input type="checkbox" value="1" ID="cdailyDisableCache" name="cdaily_disable_cache">
            <label for="cdailyDisableCache">Disable result caching for <?php echo CDailyPlugin::CACHE_DISABLE_PERIOD_SECONDS; ?>

            seconds.
            Caching is currently <strong><?php echo ($this->isCacheEnabled() ? "enabled" : "disabled"); ?></strong>.</label></dd>
        </dl>
        <p class="submit">
        <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('COM_CONNECTDAILY_SaveChanges',CDailyPlugin::CAPTION_BUNDLE); ?>" <?php echo $this->phpVersionCheck() ? '' : 'disabled="disabled"'; ?>/>
        </p>

        </fieldset>
        </form>
        <div class="CDpostbox"  id="CDailyHostedTerms" style="padding: 1em; max-width: 70ex; display: none;">
            <?php include 'terms.html'; ?>
        </div>
        <div class="CDpostbox" ID="CDailyCreateInstructions" style="padding: 1em; max-width: 70ex; display: <?php echo $is_configured ? 'none;' : 'block;'?>">
            <h3>Instructions</h3>
            Use this form to create a new cloud-based calendar.
            <br><br>
            If you already have a Connect Daily calendar, check the radio group option <em>Use an existing Connect Daily Calendar System</em>.
            <br><br>
            The <b>Email Address</b> is used to send system messages, along with tips on using Connect Daily. If you don't supply an Email address,
            you won't be able to reset the password on your cloud calendar.
            <br><br>
            You can learn more about Connect Daily&apos;s cloud based calendar 
                <a href="http://www.connectdaily.com/wordpress-calendar-plugin/" target=_blank>
                here</a>.

        </div>

        
            <?php include 'SettingsInstructions.html'; ?>
</div>
               
               <?php include 'links-and-other-div.html'; ?>
    <?php

    }

    /**
     * If there are Connect Daily notices, add an icon to the 
     * top-level admin bar directing users to it. 
     */
    public function adminBarNotices(){
        global $wp_admin_bar;
        $notices=$this->getNotices();
        $count=$notices->getMessageCount();
        $myTitle=$this->translate("Connect Daily Settings");
        $target="cdaily-settings";
        $type='Issue Detected';
        if (empty($count)) {
            /*
                We have no alerts. Let's see if there are hints. If there are hints,
                we want to add an entry for the Overview page.
            */

            $aHints=$this->getUnseenHints(array("AddEvents",'SolicitReview'));
            $count=count($aHints);
            if ($count > 0) {
                $count=1;
                $myTitle='Connect Daily '.$this->translate("COM_CONNECTDAILY_Overview");
                $target="cdaily-menu";
                $type='Hint Found';
            }
        }
        if (!empty($count)) {
            $title = '<div id="cdaily-ab-icon" class="ab-item dashicons-calendar-alt">' .
                    " <span id=CDNoticeCount class=\"wp-ui-notification CDUINotice\">$count</span>".
                    '<span class="screen-reader-text">' . __( 'COM_CONNECTDAILY_Calendar', CDailyPlugin::CAPTION_BUNDLE ) . '</span></div>';
                    
                $wp_admin_bar->add_node( array(
                            'id'     => 'wpcdaily-notifications',
                            'title'  => $title,
                            'meta' => array('title'=> 'Connect Daily Events Calendar')
                            ));
                $wp_admin_bar->add_node( array(
                    'parent' => 'wpcdaily-notifications',
                    'id' => 'wpcdaily-menupad',
                    'title' => $myTitle.' <span id=CDIssueCount class="wp-ui-notification">'.$count.'</span>',
                    'href'   => 'admin.php?page='.$target,
                    'meta' => array("title"=>"$count ".$type)
                    ));
        }
        
    }

    /**
     * This is a callback to show our status banner on the dashboard 
     * page. 
     */
    public function showStatusBanner(){
        $this->cdStatusBanner(null,true);
    }

    private function registerActions($configured,$used) {
        
        if (is_admin()) {

            add_action('admin_menu', array($this, 'createMenuItems'));

            $notices=$this->getNotices();
            $count=$notices->getMessageCount()>0;
            if (empty($count)) {
                $count=sizeof($this->getUnseenHints(array('AddEvents','SolicitReview')));
            }
            if (! empty($count)) {
                // If there are Connect Daily notices, hook the admin menu bar and dashboard.
                add_action( 'admin_bar_menu', array( $this, 'adminBarNotices' ), 96 );
                add_action('wp_dashboard_setup',array($this,'showStatusBanner'));
            }

            add_action('admin_enqueue_scripts', array($this, 'loadAdminScripts'));
            add_action('admin_head', array($this, 'loadAdminCSS'));
            add_action('admin_init', array($this,'pluginRedirect'));

            /*
                If any of these WordPress options are modified, we
                want to call our hook, primarily so we can clear our
                cache.
            */
            $a=array('timezone_string','time_format','start_of_week','date_format');
            foreach ($a as $opt) {
                add_action('pre_update_option_'.$opt,array($this,'settingsChangeHook'),100,2);
            }
        }
        add_action('wp_enqueue_scripts', array($this,'addPluginStylesheet'));
        add_action(self::PURGE_CRONJOB, array($this, 'purgeTransients'));
        add_filter('plugin_action_links',array($this,'pluginLinks'),10,2);
        if ($configured) {
           // add the filter to allow the shortcode to run in our widgets
            add_filter('widget_text', 'do_shortcode');
            add_action('widgets_init', array($this, 'registerWidgets'));
            if (!$used) {
                // if we're not marked as used, hook the save so we can
                // set used if needed. If we're already marked used,
                // we don't need to set the hook.
                add_action('save_post', array($this, 'saveHook'));
            }
        }
    }

    private function registerShortCodes(){
        add_shortcode('cdaily_detailedlist', array($this->lister,'detailedList'));
        add_shortcode('cdaily_simplelist', array($this->lister,'simpleList'));
        add_shortcode('cdaily_monthview',array($this,'wpRenderMonth'));
        add_shortcode('cdaily_minicalendar',array($this,'wpRenderMiniCalendar'));
        add_shortcode('cdaily_icalendar',array($this->calMaker,'renderiCal'));
        add_shortcode('cdaily_filter',array($this->calMaker,'renderEventsFilter'));
        add_shortcode('cdaily_iframe', array($this->calMaker,'iFrameTag'));
        add_shortcode('cdaily_addevent', array($this,'addEventTag'));
        add_shortcode('cdaily_search',array($this,'searchShortCode'));
        add_shortcode('cdaily_event',array($this,'showSingleEvent'));
    }

    /**
     * Implement the cdaily_event shortcode which lists a single 
     * event. The cal_item_id of the event can be specified on the 
     * URL as cal_item_id, or on the shortcode as the 'by_id' 
     * argument. 
     */
    public function showSingleEvent($atts = array(), $content = null, $tag = null){
        $res='';
        if (array_key_exists('cal_item_id',$_REQUEST)){
            $atts['by_id']=$_REQUEST['cal_item_id'];
        }
        if (array_key_exists('by_id',$atts)) {
            $atts['by_method']='cal_item_id';
            if (!array_key_exists('id',$atts)) {
                $atts['id']='IDcdSingleItemList';
            }
            $res = $this->lister->detailedList($atts,$content,$tag);
        }
        return $res;
    }

    /**
     * Generate the responsive add event screen.
     */
    public function addEventTag($atts, $content = null) {
        $addEvent=new CDailyAddEvent($this);
        $a=array();
        $output='';
        $bShowForm=true;
        $bRequiredPresent=true;
        /*
            If this is a post, submit the form.
        */
        if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['CDcalendar_id'])) {

            $bShowForm=false;
            $fl=$addEvent->getFieldsList();
            if (isset($atts['required_fields'])) {
                /* 
                    There's a required_fields attribute set on the shortcode.
                 
                    Merge those into our field meta array for testing presence.
                */
                $fl=$addEvent->mergeRequiredFields($fl,$atts['required_fields']);
            }

            foreach ($fl as $field => $options){
                $fldName='CD'.$field;
                
                if (!isset($_POST[$fldName])) {
                    if ($options['required']===true) {
                        $bRequiredPresent=false;
                    }
                    continue;
                }
                
                $val='';
                switch ($options['type']) {
                case 'intset':
                    $val='';
                    $intvalues=$_POST[$fldName];
                    if (gettype($intvalues)=='array') {
                        foreach ($intvalues as $intvalue ) {    
                            $val.=intval($intvalue,10).',';
                        }
                    } else {
                        if (!empty($intvalues)) {
                            $val=$intvalues;
                        }
                    }
                    $val=trim($val,',');
                    break;
                case 'int':
                    $val=0;
                    if (!empty($_POST[$fldName])) {
                        $val=intval($_POST[$fldName],10);
                    }
                    break;
                default:
                    $val=trim(stripslashes($_POST[$fldName]));
                    break;
                }
                $a[$field]=$val;
            }
            if ($bRequiredPresent) {
                $result = $addEvent->processSubmit($a);
                $s=$addEvent->getErrors($result);
                if ($s!=null) {
                    $bShowForm=true;
                    $output.='<div class="error cdaily-error">'.$s.'</div>';
                }
                $s=$addEvent->getConflicts($result);
                if ($s!=null) {
                    $bShowForm=true;
                    $output.='<div class="error cdaily-error">'.$s.'</div>';
                }

                $s=$addEvent->getWarnings($result);
                if ($s!=null) {
                    $output.='<div class="error cdaily-error">'.$s.'</div>';
                }
            } else {
                $bShowForm=true;
                $output.='<div class="error cdaily-error">'.$this->translate('COM_CONNECTDAILY_ReqFldNotSupplied').'</div>';
            }
        }

        if ($bShowForm) {
            $output.=$addEvent->addEventForm($atts,$a);
        } else {
            $output.='<div class="success">'.$addEvent->getSuccessOutput().'</div>';
        }

        return $output;
    } 

    public function registerWidgets() {
        register_widget('CDaily_DetailedListWidget');
        register_widget('CDaily_iCalendarWidget');
        register_widget('CDaily_MiniCalendarWidget');
        register_widget('CDaily_SimpleListWidget');
        register_widget('CDaily_SearchWidget');
    }

    /**
     * Save the data response to our cache system. This needs to be 
     * overwritten by the CMS specific plugin class. 
     *  
     * @param $data CDailyDataResponse 
     * @param $expiresPeriod period to retain data for. 
     *  
     * @return boolean true if successful, false otherwise. 
     */
    public function saveDataToCache($data, $expiresPeriod = self::CACHE_PERIOD_SECONDS) {
        $res = false;
        if ($this->isCacheEnabled()) {
            $key_value = $this->getKeyName($data->slugname, $data->url,$data->fields);
            $saveData=$data->asJSON();
            if ($data->getJSONError()!=null) {
                $this->logError($data->getJSONError()->toString());
            }
            $res = set_transient($key_value, $saveData , $expiresPeriod);
        }
        return $res;
    }

    /**
     * This is a change hook that we register. Say someone goes to 
     * the WordPress settings page and changes the time zone, we 
     * want to dump our cached data to force a refresh with the new 
     * time zone. 
     */
    public function settingsChangeHook($newvalue,$oldvalue){
        // $this->debugOut("settingsChangeHook('$newvalue','$oldvalue') fired!");
        if ($newvalue!=$oldvalue) {
            // $this->debugOut('firing purgeTransients(true)');
            $this->purgeTransients(true);
        }
        return $newvalue;
    }

    public function translate($mnemonic,$context=null){
        
        if (empty($context)) {
            $s=__($mnemonic, CDailyPlugin::CAPTION_BUNDLE);
        } else {
            $s=_x($mnemonic,$context, CDailyPlugin::CAPTION_BUNDLE);
        }
        switch($mnemonic){
        case 'COM_CONNECTDAILY_NOT_CONFIGURED':
            $s=sprintf($s, admin_url('admin.php?page=cdaily-settings'),self::TUTORIAL_URL.'#t=1m24s');
            break;
        case 'COM_CONNECTDAILY_NOT_USED':
            $s=sprintf($s,admin_url('widgets.php'),self::TUTORIAL_URL.'#t=4m35s',self::TUTORIAL_URL.'#t=1m53s');
            break;
        }

        return $s;
    }

    public static function uninstall() {
        unregister_widget('CDaily_DetailedListWidget');
        unregister_widget('CDaily_iCalendarWidget');
        unregister_widget('CDaily_MiniCalendarWidget');
        unregister_widget('CDaily_SimpleListWidget');

        $timestamp = wp_next_scheduled(self::PURGE_CRONJOB);
        if ($timestamp) {
            wp_unschedule_event($timestamp, self::PURGE_CRONJOB);
        }
    }

    protected function upgradeSettings($settings){
        parent::upgradeSettings($settings);
        $current=$this->getVersionArray($settings->version);
        $new=$this->getVersionArray(static::VERSION_NUMBER);
        // OK, now do the actual work. I'm picturing a big set of
        // nested switch statements.

        $settings->version=static::VERSION_NUMBER;
    }

    private $dpEnqueued=false;
    public function getDatePicker($name,$id=null,$value=''){
        if (!$this->dpEnqueued) {
            // wp_enqueue_script('jquery-ui-datepicker');
            //  This is funky. WordPress includes the javascript for the datepicker, but
            //  it doesn't include the css required to make it work.
            // wp_enqueue_style("wp-jquery-ui-dialog");
            // wp_enqueue_style('jquery-dp-style',"//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css");
            $this->dpEnqueued=true;
        }
        return parent::getDatePicker($name,$id,$value);
    }

    /**
     * Render a mini calendar as a short code.
     */
    public function wpRenderMiniCalendar($atts, $content = null, $tag = null) {

        $aParameters = $atts;

        foreach (array(
            'other_options',
            'offset',
            'year',
            'month'
            ) as $key) {
            if (isset($_GET[$key])) {
                $aParameters[$key]=$_GET[$key];
            }
        }
        $renderer=new CDCalendarWriter($this);
        return $renderer->renderMiniCalendar($aParameters);
    }

    /**
     * render the short code. Called by the wordpress code, and 
     * directly when this page is invoked. 
     */
    public function wpRenderMonth($atts, $content = null, $tag = null, $bare_calendar = false) {
        $aParameters = $atts;

        foreach (array(
            'other_options',
            'offset',
            'year',
            'month'
            ) as $key) {
            if (isset($_GET[$key])) {
                $aParameters[$key]=$_GET[$key];
            }
        }
        $renderer=new CDCalendarWriter($this);
        return $renderer->renderMonth($aParameters,$bare_calendar);
    }

    public function getCMSName(){
        return "WordPress";
    }

    public function showSupportForm(){
        include('support.php');
    }

    public function hasUserSeenHint($hintName){
        $hintsSeen=get_user_option(self::PLUGIN_NAME.'-Hints');
        if (empty($hintsSeen)) {
            return false;
        }
        return in_array($hintName,$hintsSeen,true);
    }

    /**
     * Mark that a user has seen a specific hint.
     * 
     * @param $hintName 
     * 
     * @return void
     */
    public function markHintSeen($hintName){
        $hintsSeen=get_user_option(self::PLUGIN_NAME.'-Hints');
        if (empty($hintsSeen)) {
            $hintsSeen=array();
        }
        if (!in_array($hintName,$hintsSeen,true)) {
            $hintsSeen[]=$hintName;
            update_user_option(get_current_user_id(),self::PLUGIN_NAME.'-Hints',$hintsSeen);
        }
        return;
    }
}
