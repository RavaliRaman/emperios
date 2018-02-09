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
/** JOOMLA-COMPAT **/
/**
 * This is a base-class for the Connect Daily plugin system. it 
 * provides the basic functionality. Specific plugin 
 * implementations should sub-class this class and implement the 
 * environment specific functions required. 
 * <br><br> 
 * The class is implemented as a singleton to allow other code 
 * to access it without using global and from a static context. 
 * 
 * @author gsexton (11/25/2015)
 */
class CDailyPlugin {

    private $debugLogging = false;
    private $lastError = null;
    private $idCounter=0;
    private $miscCache = array();

    /**
     * The singleton instance.
     */
    private static $instance=null;

    /*
        Constants
    */
    const CACHE_DISABLE_PERIOD_SECONDS = 3600;
    const CACHE_ENABLE = true;
    const CACHE_PERIOD_SECONDS = 3600;
    const CACHE_URL_FIELDNAME="CacheInvalidateURL";
    const CAPTION_BUNDLE='connect-daily-web-calendar';
    const CAPTION_PREFIX='COM_CONNECTDAILY_';
    const HELP_BASE="http://www.mhsoftware.com/caldemo/manual/en/";
    const HELP_PAGE="http://www.mhsoftware.com/caldemo/manual/en/pageFinder.html?page=";
    const MAP_PROVIDER_URL="https://maps.google.com/?q=";
    /** 
     * Minimum Supported Version of PHP. 
     *  
     * Version support history:
     *  
     *      Originally, 5.3 or higher because we needed DateTime
     *      class support.
     *  
     *      2016-05-23 Bumped requirement to 5.4.4 because 5.3.x's
     *      Unicode handling in json_encode() is broken and it was
     *      stopping the cache subsystem from working.
     */
    const MIN_PHP_VERSION='5.4.4';
    const PHP_RELEASE_DATE='June 2012';
    const PHP_TIME_FORMATTING="//php.net/manual/en/function.date.php";
    const PLUGIN_NAME='Connect-Daily-Plugin';
    const PROVISIONING_URL='https://trialsignup.mhsoftware.com/AutoHost.html';
    const REQUEST_TIMEOUT=30;
    const SHORT_NAME = 'cdaily';
    const SUPPORT_URL= 'http://www.connectdaily.com/support/';
    const VERSION_NUMBER="1.3.6";

    protected function __construct() {
    }

    /**
     * Add a forward-slash to a URL path if it doesn't already end 
     * in one. 
     *  
     * @return string 
     */
    public function addfs($urlpath) {
        if ($urlpath==null) {
            return null;
        }
        if (strrpos($urlpath, '/') != (strlen($urlpath)-1)) {
            $urlpath .= '/';
        }
        return $urlpath;
    }


    /**
     * Change the Connect Daily Account's password or rename the 
     * account. 
     *  
     * This can do some maybe unexpected things: 
     *  
     * 1) if newusername!=oldusername and newusername doesn't exist, 
     * then the account oldusername is renamed to newusername. 
     * 
     *  
     * @return Object with minimum properties of error and 
     *         error_message. If successful, the return from
     *         JSONRequest including user_id and etoken. If an error
     *         happens as part of the password change, the result
     *         from Connect Daily will be in $result->error and
     *         $result->error_message.
     */
    public function changeUserPassword($oldusername,$oldpassword,$newusername,$newpassword){
        $time=strval(time());
        $request=array(
            "request_number" => "CHANGE_PASSWORD",
            "username" => $oldusername,
            "password" => $oldpassword,
            "new_username" => $newusername,
            "new_password" => $newpassword,
            "timestamp" => $time,
            "site_url" => $this->getSiteUrl()
            );

        $url=$this->getPostDefaults("json/change_password.js");
        $crypto=new CDaily_Crypto();
        if ($crypto->isAvailable()) {
            /* If we've got crypto, submit our signed site_url for validation. */
            
            $sig='';
            $sigData=$this->getSiteUrl().$time;
            if ($crypto->signData($sigData,$sig)){
                $request['sig']=bin2hex($sig);
            }
        }
        $result=$this->makePostRequest($url,$request);
        if ($result->wasSuccess()) {
            $obj=$result->getContentObject();
            return $obj;
        }
        return $result;
    }

    /** 
     * clear the last error variable
     *  
     * @return string - the value present prior to clear.
     */
    public function clearLastError() {
        $s = $this->lastError;
        $this->lastError = null;
        return $s;
    }

    /**
     * Take an array of fields. If other_options is present, 
     * split them into their components and add them. 
     *  
     * @return array The augmented args. 
     */
    public function convertOtherOptions(&$args) {
        if (!array_key_exists('other_options',$args) || empty($args['other_options'])) {
            return $args;
        }
        $opts=$args['other_options'];
        unset($args['other_options']);
        $matches=array();
        preg_match_all('/([^\\s]*)=[\'"]?([^\'"]*)[\'"]?/',$opts,$matches);
        $names=$matches[1];
        $values=$matches[2];
        for ($i=0; $i < count($names); $i++) {
            $key=$names[$i];
            $value=$values[$i];
            $cStart=substr($value,0,1);
            $cEnd=substr($value,strlen($value)-1);
            if (($cStart=='"' && $cEnd=='"') || 
                ($cStart=="'" && $cEnd=="'")) {
                $value=substr($value,1,strlen($value)-2);
            }
            $args[trim($key)] = trim($value);
        }
        return $args;
    }

    public function createNonce($nonce_data){
        $time = time();
        $nonce=hash('sha256',$time . $nonce_data) . "-" . $time;
        return $nonce;
    }

    public function deactivate() {
        $this->purgeTransients(true,true);
    }

    /**
     * Write the content of $data to stderr, which PHP sends to 
     * Apache's error log file. 
     * 
     * @param p1, value to dump. 
     * @param p2, optional second value to dump. 
     */
    public function debugOut($p1,$p2=null) {
        if ($this->debugLogging) {
            $s=$this->debugParamToString($p1);
            if ($p2!=null) {
                $s.="\n".$this->debugParamToString($p2);
            }
            file_put_contents('php://stderr', print_r('[' . $this->getTimestamp() . "] " . self::PLUGIN_NAME . " - Debug: " . $s . "\n", true));
        }
    }

    /**
     * Convert a PHP variable to a string representation. Handles 
     * objects and associative arrays. 
     */
    private function debugParamToString($data,$indentText=''){
        $s='';
        $type=gettype($data);
        switch ($type) {
        case 'object':
            $s='Class Name= '.get_class($data).' Data= '.json_encode($data,JSON_PRETTY_PRINT);
            $iErr=json_last_error();
            if ($iErr!=JSON_ERROR_NONE) {
                $err=new CDailyJSONError($iErr);
                $s.="\n\n".$err->error_message;
            }
            break;
        case 'boolean':
            $s=$data ? 'true' : 'false';
        case 'array':
            foreach ($data as $key => $value){
                switch (gettype($value)) {
                case 'array':
                    $value="[".$this->debugParamToString($value,$indentText."\t")."\n".$indentText.']';
                    break;
                case 'object':
                    $value=$this->debugParamToString($value,$indentText."\t");
                    break;
                case 'boolean':
                    $value=$value ? 'true' : 'false';
                    break;
                }
                $s .= "\n".$indentText.'[' . $key . ']=' . $value;
            }
            break;
        default:
            $s.=$data;
            break;
        }
        return $s;
    }

    /**
     * Disable the cache system temporarily. This also has the 
     * side-effect of clearing the cache. 
     */
    public function disableCache($save_settings=true) {
        $settings = $this->getSettings();
        $settings->disable_timestamp = time() + self::CACHE_DISABLE_PERIOD_SECONDS;
        $this->purgeTransients(true);
        if ($save_settings) {
            $this->saveSettings($settings);
        }
    }

    /**
     * Retrieve information or data from the system cache. 
     *  
     * @return CDailyDataResponse if data exists in cache, null 
     *         otherwise.
     */
    public function fetchDataFromCache($slugname, $url,$fields=null) {
        return null;
    }


    /**
     * Retrieve the Security token for export from Connect Daily. 
     *  
     * If no username/password are present on settings, then this 
     * returns null. 
     */
    public function fetchSecurityToken($settings) {
        /*
            Clear the error. makePostRequest() does this, but we might
            return before it's called...
        */
        $this->clearLastError();
        // wipe the existing token to force username & password
        $settings->token = false;
        if (property_exists($settings,'user_id')) {
            unset($settings->user_id);
        }
        if (property_exists($settings,'etoken')) {
            unset($settings->etoken);
        }
        
        if (empty($settings->username) || empty($settings->password)) {
            // If there's no username and password, call isPublicAddEnabled() which
            // will validate the URL. If the URL is bad, getLastError() will
            // return the result.
            $this->isPublicAddEnabled();
            return null;
        }
        $time=strval(time());
        $params=array(
            'username' => $settings->username,
            'password' => $settings->password,
            'request_number' => 'VERIFY_PW',
            'timestamp' => $time,
            CDailyPlugin::CACHE_URL_FIELDNAME => $this->getAjaxURL('action=cd_clearcache&format=raw',true),
            'site_url' => $this->getSiteUrl()
            );
        $url=$settings->url.'json/text.js';
        $crypto=new CDaily_Crypto();
        if ($crypto->isAvailable()) {
            /* If we've got crypto, submit our signed site_url for validation. */
            
            $sig='';
            
            $sigData=$this->getSiteUrl().$time;
            if ($crypto->signData($sigData,$sig)){
                $params['sig']=bin2hex($sig);
            }
        }

        $reqData = $this->makePostRequest($url,$params);
        
        $token = null;
        if ($reqData->wasSuccess()) {
            $data = $reqData->getContentObject();
            if ($data->error==0) {
                $this->addServerTimeZone($settings,$data);
                if (property_exists($data, 'etoken')) {
                    $token = "&user_id=$data->user_id&etoken=$data->etoken";
                    $settings->token = $token;
                    $settings->user_id=$data->user_id;
                    $settings->etoken=$data->etoken;
                }
            } else {
                $this->logError("An error happened retrieving a security token. The message was: "+$data->error_message);
            }
        }
        return $token;
    }

    /**
     * Add the server's time zone to our settings object. If it's 
     * not present in data, set the value to the WordPress one.
     * 
     * @param $settings 
     * @param $data 
     * 
     * @return true if a change occurred.
     */
    public function addServerTimeZone($settings, $data){
        $current=property_exists($settings,'server_timezone') ? $settings->server_timezone : null;
        if (property_exists($data,"time_zone")) {
            $settings->server_timezone=$data->time_zone;
        } else {
            $settings->server_timezone=$this->getTimezone();
        }
        return $current!=$settings->server_timezone;
    }

    /**
     * Return the URL javascript calling this plugin should use for 
     * making AJAX requests. 
     */
    public function getAjaxURL($addlParms,$absolute=false){
        return null;
    }

    /**
     * This function populates the by_method dropdown for the the
     * widget.
     */
    function getByMethodDropdown($current_value, $name, $id) {
        $reqData = $this->getPostData("by-method-dropdown", 'json/list.js',array('request_number' => 'VIEWABLE_TYPES'));

        $result = '<select class="widefat" onchange="return CDaily.initForDropdownFromMethod(this);" name="' . $name . '" id="' . $id . '">';

        if ($reqData->wasSuccess()) {
            $items = $reqData->getContentObject()->items;
            foreach ($items as $itemtype) {
                $result .= '<option value="' . $itemtype->type_string . '"';
                if ($current_value == $itemtype->type_string) {
                    $result .= ' selected';
                }
                $result .= '>' . esc_html($itemtype->type_label) . '</option>';
            }
        }
        $result .= '</select>';
        return $result;
    }

    /**
     * Return our current user. 
     *  
     * At minimum, the returned object will have: 
     *  
     * user_name 
     * user_fullname 
     * user_email 
     * 
     * @return mixed 
     */
    public function getCurrentUser() {
        throw new Exception('unimplemented method, ->getCurrentUser()');
    }

    /**
     * Retrieve data from the connect daily system. 
     *  
     * @param $slugname The Unique ID of the caller. 
     * @param $url the URL for the request. 
     * @param $autosave - default true, auto-save the result in 
     *                  local cache.
     *  
     * @return CDailyDataResponse 
     */
    public function getData($slugname, $url, $autosave = true) {
        $this->logError("Call to deprecated method getData($slugname,$url,$autosave)");
        if (empty($this->getSettings()->url)) {
            $res = new CDailyDataResponse;
            $res->error = -2;
            $res->error_message = __('Connect Daily has not been configured. Please visit the Connect Daily | Settings page and configure it.',CDailyPlugin::CAPTION_BUNDLE);
            return $res;
        }
        $url = $this->wrapURLInDefaults($url);
        $res = null;
        $cache = $this->isCacheEnabled();
        if ($cache) {
            $res = $this->fetchDataFromCache($slugname, $url);
        }
        if (empty($res)) {
            $res = $this->makeGetRequest($url);
            $res->slugname = $slugname;
            if ($autosave && $cache && $res->wasSuccess()) {
                $this->saveDataToCache($res);
            }
        } else {
            $res->from_cache = true;
        }

        return $res;
    }

    /**
     * Retrieve data from the connect daily system. 
     *  
     * @param $slugname The Unique ID of the caller. 
     * @param $url the URL for the request. 
     * @param $autosave - default true, auto-save the result in 
     *                  local cache.
     *  
     * @return CDailyDataResponse 
     */
    public function getPostData($slugname, $url, $fields=null, $autosave = true) {
        if (empty($this->getSettings()->url)) {
            $res = new CDailyDataResponse;
            $res->error = -2;
            $res->error_message = $this->translate('Connect Daily has not been configured. Please visit the Connect Daily | Settings page and configure it.');
            return $res;
        }
        if (!is_array($fields)) {
            $fields=array();
        }
        $url=$this->getPostDefaults($url,$fields);
        $res = null;
        $cache = $this->isCacheEnabled();
        if ($cache) {
            $res = $this->fetchDataFromCache($slugname, $url,$fields);
        }
        if (empty($res)) {
            $res = $this->makePostRequest($url,$fields);
            $res->slugname = $slugname;
            if ($autosave && $cache && $res->wasSuccess()) {
                $this->saveDataToCache($res);
            }
        } else {
            $res->from_cache = true;
        }

        return $res;
    }
    /**
     * Return the key name used for the caching sub-system.
     */
    protected function getKeyName($slug, $url,$fields=null) {
        // md5 returns a 32 char hash, +7 gives 39 characters which is within
        // the allowed value for transient keys.
        if ($slug === null) {
            $slug = '';
        }
        if ($url === null) {
            $url = '';
        }
        $str=$slug.$url;
        if (is_array($fields) && sizeof($fields)>0) {
            ksort($fields);
            foreach ($fields as $fldName => $value) {
                $str.='~'.$fldName.'='.$value;
            }
        }
        return self::SHORT_NAME . '-' . md5($str);
    }

    /**
     * Return the specified icon name with the complete path 
     * prepended. 
     */
    public function getIconURL($iconName) {
        return $iconName;
    }

    /** 
     * Return the singleton instance. 
     *  
     * @return CDailyPlugin
     */
    public static function getInstance(){
        return self::$instance;
    }

    /** 
     * Return the last message logged through logError ()
     * or null if no errors have been logged during the 
     * current request.
     *  
     * @return string
     */
    public function getLastError() {
        return $this->lastError;
    }

    public function getMapProviderURL(){
        return self::MAP_PROVIDER_URL;
    }

    /**
     * Get the defaults for a post request. 
     *  
     * @param $url the URL fragment. 
     * @param $fields Optional array to receive the authentication 
     *                data.
     *  
     * @return The absolute URL for the request. 
     */
    protected function getPostDefaults($url,&$fields=null){
        $settings=$this->getSettings();
        $url=$settings->url.$url;
        if (is_array($fields)) {
            if (property_exists($settings,'user_id') && property_exists($settings,'etoken')) {
                $fields['user_id']=$settings->user_id;
                $fields['etoken']=$settings->etoken;
            } else if (property_exists($settings,'token') && !empty($settings->token)) {
                $auth=$settings->token;
                if (substr($auth,0,1)=='&') {
                    $auth=substr($auth,1);
                }
                $args=explode('&',$auth);
                foreach ($args as $setting) {
                    $field=explode('=',$setting);
                    $fields[$field[0]]=$field[1];
                }
            } else {
                if (property_exists($settings,'username') && !empty($settings->username) &&
                    property_exists($settings,'password') && !empty($settings->password)
                    ) {
                    $fields['username']=$settings->username;
                    $fields['password']=$settings->password;
                }
            }
        }
        return $url;
    }


    /**
     * Return the JSON text containing settings used to 
     * provision a calendar. 
     */
    protected function getProvisioningValues($postvars){
        $settings = $this->getSettings();
        $u = $this->getCurrentUser();
        $crypto = new CDaily_Crypto();
        if ($crypto->isAvailable()) {
            $password=CDaily_Crypto::generatePassword(8,false);
        } else {
            $password=$this->createNonce('cdNewUserPassword');
            if (strlen($password)>10) {
                $password=substr($password,-10);
            }
        }


        $reqData = '{ "organization_name" : ' . json_encode(empty($postvars['organization_name']) ? $this->getSiteName() : $postvars['organization_name']) .
            ', "site_url" : ' . json_encode(empty($postvars['site_url']) ? $this->getSiteUrl() : $postvars['site_url']) .
            ', "timezone" : ' . json_encode($this->getTimezone()) .
            ', "site_language" : ' . json_encode($settings->language) .
            ', "public_key" : ' . ($crypto->isAvailable() ? json_encode($crypto->getPublicKey()) : "null" ) .
            ', "provision_publicadd" : ' . ($postvars['provision_publicadd'] ? "1" : "0") .
            ', "provision_resources" : ' . ($postvars['provision_resources'] ? "1" : "0") .
            ', "user_name" : ' . json_encode($u->user_name) .
            ', "user_fullname" : ' . json_encode($u->user_fullname) .
            ', "user_email" : ' . json_encode(empty($u->user_email) ? $this->getSiteEmail() : $u->user_email) .
            ', "password" : ' . json_encode($password) . 
            '}';
        
        return $reqData;
    }

    /**
     * Return an object with all of our settings as member 
     * properties. 
     *  
     * @return mixed 
     */
    public function getSettings() {
        throw new Exception('unimplemented function getSettings()!');
    }

    /**
     * Return the site description. 
     *  
     * @return string 
     */
    public function getSiteDescription() {
        return 'Unknown';
    }

    /** 
     * return the system site default email address. 
     * @return string
     */
    public function getSiteEmail() {
        throw new Exception('unimplemented method, ->getSiteEmail()');
    }

    /**
     * Return the site's name. 
     *  
     * @return string 
     */
    public function getSiteName() {
        return 'Unknown';
    }

    /**
     * Return the Site's Web Address. 
     *  
     * @return string 
     */
    public function getSiteUrl() {
        throw new Exception('unimplmented function, ->getSiteUrl()');
    }


    private function getTimestamp() {
        $t = new DateTime();
        $t->setTimezone(new DateTimeZone($this->getTimezone()));
        return $t->format('Y-m-d H:i:s O');
    }

    /**
     * Return the Timezone ID as a string for the plugin/container. 
     * If the value is not set, GMT is returned. 
     *  
     * @return string 
     */
    public function getTimezone() {
        $settings = $this->getSettings();
        if (property_exists($settings, 'timezone_string') && !empty($settings->timezone_string)) {
            $res = $settings->timezone_string;
        } else {
            $res = 'GMT';
        }
        return $res;
    }

    /**
     * Split a version number into an array of ints. 
     *  
     * @param $version 
     * 
     * @return array at minimum, a three value array with each 
     *         component of the version number as an integer value.
     */
    protected function getVersionArray($version){
        $res=array(0,0,0);
        $a=explode('.',$version);
        $res[0]=intval($a[0]);
        if (sizeof($a)>1) {
            $res[1]=intval($a[1]);
        }
        if (sizeof($a)>2) {
            $res[2]=intval($a[2]);
        }
        return $res;
    }

    public function install() {
    }

    public function isCacheEnabled() {
        $settings=$this->getSettings();
        return self::CACHE_ENABLE && 
            time() >= (property_exists($settings,'disable_timestamp') ? $this->getSettings()->disable_timestamp : 0);
    }

    /**
     * Return true if the user name or password has changed.
     * 
     * @param $settings 
     * @param $username 
     * @param $password 
     */
    function isPasswordChange($settings,$username,$password){
        if (empty($username)==false && empty($password)==null &&
            !empty($settings->username) && 
            ($settings->username!=$username || $settings->password!=$password)
            ) {
            return true;
        }
        return false;
    }

    public function isPublicAddEnabled() {
        $res = $this->getPostData('login-status', 'json/text.js',array('request_number' => 'LOGIN_STATUS'), false);
        if ($res->wasSuccess()) {
            $data = $res->getContentObject();
            if (!$res->from_cache) {
                $this->saveDataToCache($res, 300);
                $settings = $this->getSettings();
                $doSave=$this->addServerTimeZone($settings,$data);
                if ($settings->resource_management != $data->ResourceManagement) {
                    $settings->resource_management = $data->ResourceManagement;
                    $doSave=true;
                }
                if ($doSave) {
                    $this->saveSettings($settings);
                }
            }
            return $data->public_add;
        }
        return false;
    }


    /**
     * Return true if this installation of the plugin is used. 
     *  
     * @return boolean 
     */
    public function isUsed() {
        return $this->getSettings()->used;
    }


    /**
     * A logging path for run-time errors.
     * 
     * @param $data 
     */
    public function logError($msg) {
        $this->lastError = $msg;
        file_put_contents('php://stderr', print_r('[' . $this->getTimestamp() . "] " . self::PLUGIN_NAME . " - Error: " . $msg . "\n", true));
    }

    /**
     * Make a get request to Connect Daily for information or data.
     */
    public function makeGetRequest($url) {
        $msg = "Call to unimplemented function ->makeGetRequest($url).";
        $this->logError($msg);
        throw new Exception($msg);
    }

    /**
     * Make a POST request to Connect Daily for information or data. 
     * @param $url - The URL for the post request. 
     * @param $fields - Associative array of fieldnames and values. 
     */
    public function makePostRequest($url,$fields=null,$options=null) {
        $msg = "Call to unimplemented function ->makePostRequest($url,$fields,$options).";
        $this->logError($msg);
        throw new Exception($msg);
    }

    /**
     * mark the installation of the plugin as used. 
     * @return void 
     */
    public function markUsed() {
        $settings = $this->getSettings();
        if (!$settings->used) {
            $settings->used = true;
            $this->saveSettings($settings);
        }
    }


    /**
     * Return true if the PHP version meets our minimum 
     * requirements. 
     *  
     * @return boolean 
     */
    public function phpVersionCheck() {
        return version_compare(phpversion(),self::MIN_PHP_VERSION)>=0;
    }

    /**
     * Create a back-end calendar system.
     * 
     * @param $orgname String the Organization name 
     * @param $siteurl The URL of this CMS site. 
     * @param $provisionResources If true, provision example 
     *                            resources.
     * @param $provisionPublicAdd If true, provision and enable 
     *                            public add.
     * @param $email The Email address for the account. 
     *  
     * @return array. array[error]=0 for OK, array[error]!=0 for 
     *         error condition.
     *      array['body'] is valid when there's no error and returns
     *      the JSON result from the host creation.
     */
    public function provisionCalendarSystem($orgname, $siteurl, $provisionResources=false, $provisionPublicAdd=false,$email=false) {
        $settings=$this->getSettings();
        $reqData=$this->getProvisioningValues(array('organization_name' => $orgname, 'site_url' => $siteurl,'provision_resources' => $provisionResources, 'provision_publicadd' => $provisionPublicAdd,'user_email' => $email));
        $fields=array(
            'json_data' => $reqData
            );

        $response=$this->makePostRequest(self::PROVISIONING_URL,$fields,array('timeout' => 45));

        $result=array(
            'error' => 0,
            'error_message' => '',
            'body' => null
            );

        if ($response->wasSuccess()) {
            $data=$response->getContentObject();
            if (property_exists($data,'error') && $data->error!=0) {
                $result['error']=$data->error;
                $result['error_message']=$data->error_message;
            } else {
                $sURL = $this->addfs($data->url);
                $result['cdaily_url'] = $sURL;
                $settings->url = $sURL;
                
                /*
                    I think it's better to have these set from the creation.
                */
                $settings->username=$data->user_name;
                $oRequest=json_decode($reqData);
                $settings->password=$oRequest->password;
                /*
                    Save our settings values.
                */
                $this->saveSettings($settings);
            }
        } else {
            $result['error']=1;
            $result['error_message']=$response->content;
        }
        return $result;
    }

    public function purgeTransients($all = false, $includeHints = false) {
    }

    /**
     * save the data response to our cache system. This needs to be 
     * overwritten by the CMS specific plugin class. 
     *  
     *  @param res - CDailyDataResponse
     *  @param $expiresPeriod - Period in seconds after which to
     *                        expire entry. Default
     *                        CACHE_PERIOD_SECONDS.
     *  
     * @return true if successful, false otherwise. 
     */
    public function saveDataToCache($data, $expiresPeriod = self::CACHE_PERIOD_SECONDS) {
        return false;
    }


    /**
     * function to be called when a page is saved. 
     *  
     * @return void 
     */
    public function saveHook() {
    }

    /**
     * Serialize out the current settings values. 
     *  
     * @return void 
     */
    public function saveSettings($values) {
        throw new Exception('unimplemented function saveSettings($values)');
    }

    /**
     * If the url is in mhsoftware.com, force it to https, and add a 
     * trailing forward slash if necessary. 
     *  
     * @return string 
     */
    public function secureURLIfPossible($url) {
        if (empty($url)) {
            return $url;
        }

        if (strpos($url,'://')===false) {
            $url='http://'.$url;
        }
        
        if (stripos($url, "mhsoftware.com/") > 0 && substr(strtolower($url), 0, 5) === 'http:') {
            $url = 'https' . substr($url, 4);
        }
        return $this->addfs($url);
    }

    /**
     * This method is for sub-classes to set their singleton 
     * instance back on the parent. That way classes that don't care 
     * about implementation can call CDailyPlugin->getInstance(). 
     */
    protected static function setInstance($inst){
        self::$instance=$inst;
    }

    /**
     * Given a translation string, return the translated value. 
     * @param $mnemonic string 
     * @param $context string - The context for the translator to 
     *                 use.
     * @return string 
     */
    public function translate($mnemonic,$context=null){
        return $mnemonic;
    }

    /**
     * This function is called when our version number stored as our 
     * settings is not consistent with our current version. 
     */
    protected function upgradeSettings($settings){
        /*
        $current=$this->getVersionArray($settings->version);
        $new=$this->getVersionArray(static::VERSION_NUMBER);
        // OK, now do the actual work. 
        */ 
    }

    /**
     * Take a basic request url, e.g. json/calendar_id/2.js?a=b and 
     * add the URL, and authentication values if available. 
     *  
     * @return string 
     */
    private function wrapURLInDefaults($url,$noauth=false) {
        $settings = $this->getSettings();
        $url = $settings->url . $url;
        if ($noauth) {
            return $url;
        }
        $auth = $settings->token;
        if (empty($auth)) {
            $auth = $settings->username;
            $pass = $settings->password;
            if (empty($auth) || empty($pass)) {
                $auth = null;
            } else {
                $auth = "username=$auth&password=$pass";
            }
        } else if (substr($auth, 0, 1) == '&') {
            $auth = substr($auth, 1);
        }
        if (empty($auth)) {
            //$this->debugOut("no authentication data found.");
            return $url;
        }

        $len = strlen($url);
        $c = null;
        if ($len > 0) {
            $c = substr($url, $len - 1);     // The last character.
        }
        if (strpos($url, "?") == false && !empty($url)) {
            $url .= '?' . $auth;
        } else {
            if ($c == '?' || $c == '&') {
                // the target URL ends in a ? or &
                $url .= $auth;
            } else {
                $url .= '&' . $auth;
            }
        }
        //$this->debugOut("->wrapURLInDefaults() return $url");
        return $url;
    }

    /**
     * Write javascript with our required captions. Each CMS plugin 
     * needs to override this method to use it's unique i18n 
     * methods. Alternatively at some point we have to write our 
     * own. 
     */
    public function getRequiredCaptions($a){
        $res='<script type="text/javascript">CDaily.addCaptions({"captions" : [';
        foreach ($a as $caption){
            $res.='{"caption" : "'.self::CAPTION_PREFIX.$caption.'", "value" : '.json_encode($caption).'},';
        }
        $res.='{"caption" : "UNUSED","value" : null}]});</script>';
        return $res;
    }

    /**
     * Return an incrementing integer, starting with one that is 
     * unique for THIS instantantion of the plugin instance. 
     *  
     * @return int 
     */
    public function getNextID(){
        return ++$this->idCounter;
    }

    public function getDatePicker($name,$id=null,$value=''){
        if ($id==null) {
            $id='id'.$name;
        }
        if (!property_exists($this,'datePlaceHolder')) {
            $dt=new CDDateTime();
            $dt->setDate(2016,11,22);
            $s=$dt->format($this->getSettings()->date_format);
            $s=str_replace('2016','yyyy',$s);
            $s=str_replace('22','dd',$s);
            $s=str_replace('11','mm',$s);
            $this->{'datePlaceHolder'}=$s;
        }
        return '<input type="date" value="'.$value.'" name="'.$name.'" '.
            'id="'.$id.'" '.
            'placeholder="'.$this->datePlaceHolder.'">';
    }

    public function getNotices(){
        return new CDailyNotices($this);
    }

    /**
     * Return the proper name of this content management system.
     * 
     * @return String
     */
    public function getCMSName(){
        return "uknown. Ovverride value!";
    }

    public function isConfigured(){
        $inc_url_value=$this->getSettings()->url;
        $signup_done=!empty($inc_url_value) && strpos($inc_url_value,'/wpdemo/')===false;
        return $signup_done;
    }

    /**
     * Convert a locale string in the format ll_CC[.charSetInfo] to 
     * BCP 47 which is ll-CC. 
     *  
     * @param $language 
     */
    public static function convertToBCP47($language) {
        if (!empty($language)) {
            if (strpos($language,'_') > 0 ) {
                $language=preg_replace('/[_]{1}/','-',$language);
            }
            if (strpos($language,'.') > 0 ) {
                $language=substr($language,0,strpos($language,'.'));
            }
        }
        return $language;
    }

    /**
     * Retrieve a helper object for social network sharing of 
     * events. 
     * 
     * @return CDailySocialNetworkHelper if successful and enabled, 
     *         null otherwise.
     */
    public function getSocialNetworkHelper(){
        if (!array_key_exists("Social",$this->miscCache)) {
            $reqData=$this->getPostData('social-network-data','json/info.js',array('request_number' => 'SHARING_DATA'),false);
            if ($reqData->wasSuccess()) {
                $info=$reqData->getContentObject();
                if ($reqData->getJSONError()===null && $info->enabled) {
                    $this->miscCache["Social"] = new CDailySocialNetworkHelper($info);
                }
                $this->saveDataToCache($reqData,4*self::CACHE_PERIOD_SECONDS);
            }
        }
        return array_key_exists('Social',$this->miscCache) ? $this->miscCache["Social"] : null;
    }

    public function getLicenseInfo(){
        if (!array_key_exists("LicenseInfo",$this->miscCache)) {
            $liReq = $this->getPostData('license-info', 'json/licenseInfo.js', 
                                        array('request_number' => 'LICENSE_INFO',
                                              static::CACHE_URL_FIELDNAME => $this->getAjaxURL('action=cd_clearcache&format=raw',true)
                                              )
                                        );
            if ($liReq->wasSuccess()){
                $this->miscCache["LicenseInfo"] = $liReq->getContentObject();
            }
        }
        return $this->miscCache["LicenseInfo"];
    }

    /**
     * Return true if the user has seen the specified hint. This 
     * needs implemented at the specific plugin level to handle the 
     * storage. 
     *  
     * @param $hintName The name of the hint to check.
     */
    public function hasUserSeenHint($hintName){
        return false;
    }

    /**
     * Mark that a user has seen a specific hint.
     * 
     * @param $hintName 
     * 
     * @return void
     */
    public function markHintSeen($hintName){
       return;
    }

    /**
     * Check preconditions to see if a specific hint should be 
     * display. For example, AddEvents is appropriate after a 
     * shortcode or widget has been installed. 
     *  
     * @param $hintName THe name of the hint to check. 
     */
    private function checkHintPreconditions($hintName){
        $res=true;
        switch ($hintName) {
        case 'AddEvents':
            $res=$this->isUsed();
            break;
        case 'SolicitReview':
            $liReq = $this->getLicenseInfo();
            if ($liReq!=null) {
                $lm = $liReq->LicenseModel;
                $lFeatures=$liReq->LicensedFeatures;
                if ($liReq->Trial || ($lFeatures===null && $lm==='com.mhsoftware.cdaily.support.licensing.ComponentLicensingModel')) {
                    $res=false;
                }
            } else {
                $res=false;
            }
        }
        return $res;
    }

    /**
     * Given an array of hint names, return the set the user hasn't 
     * seen yet. 
     *  
     * If a hint is unseen, it call checkHintPreconditions to see if 
     * it's appropriate to show. 
     *  
     * @param $aCandidates 
     * 
     * @return array
     */
    public function getUnseenHints($aCandidates) {
        $res=array();
        foreach ($aCandidates as $hintName){
            if (!$this->hasUserSeenHint($hintName) && $this->checkHintPreconditions($hintName)) {
                $res[]=$hintName;
            }
        }
        return $res;
    }


}   // Class CDailyPlugin

/**
 * This class is used to encapsulate a notice system to let 
 * operators know about problems. 
 */
class CDailyNotices {

    private $notices;

    public function __construct($plugin){

        $sCMS=preg_replace("/[^A-Z]+/",'',strtoupper($plugin->getCMSName()));
        $this->notices=array();
        if (!$plugin->phpVersionCheck() ) {
            $msg=$plugin->translate('COM_CONNECTDAILY_PHP_BADVER');
            $msg=sprintf($msg,phpversion(),CDailyPlugin::MIN_PHP_VERSION,CDailyPlugin::PHP_RELEASE_DATE,CDailyPlugin::MIN_PHP_VERSION);
            $this->addNotice('any',$msg);
            return;
        }
        $settings=$plugin->getSettings();
        if (empty($settings->timezone_string)) {
            $msg=sprintf($plugin->translate('COM_CONNECTDAILY_NO_TIMEZONE')."<br><br>".$plugin->translate('COM_CONNECTDAILY_TZ_CHANGE_'.$sCMS),$plugin->getCMSName());
            $this->addNotice('any',$msg);
        } else if (!$plugin->isUsed() || !$plugin->isConfigured()) {
            if ($settings->timezone_string=="GMT" || $settings->timezone_string=="UTC") {
                $this->addNotice('any',$plugin->translate('COM_CONNECTDAILY_TZ_GMT')."<br><br>".$plugin->translate('COM_CONNECTDAILY_TZ_CHANGE_'.$sCMS));
            }
        }


        if (property_exists($settings,"error")) {
            // If there's some sort of error recorded in the configuration.
            //
            // Say in Joomla, someone drops the settings table...
            //
            $this->addNotice('any',$settings->error);
        } else if ($plugin->isConfigured()) {
            if (property_exists($settings,"server_timezone") && $settings->server_timezone!=$plugin->getTimeZone()) {
                $msg=$plugin->translate("COM_CONNECTDAILY_TIMEZONE_MISMATCH")."<br><br>".$plugin->translate('COM_CONNECTDAILY_TZ_CHANGE_CLOUD').' '.
                    $plugin->translate('COM_CONNECTDAILY_TZ_CHANGE_'.$sCMS);
                $msg=sprintf($msg,$settings->server_timezone,$plugin->getCMSName(),$plugin->getTimeZone());
                $this->addNotice("any",$msg);
            }
            
            if (!$plugin->isUsed()) {
                $this->addNotice('any',$plugin->translate('COM_CONNECTDAILY_NOT_USED'));
            }
        } else {
            $this->addNotice('overview',$plugin->translate('COM_CONNECTDAILY_NOT_CONFIGURED'));
        }
    }

    /**
     * Add a notice to the appropriate section messages.
     */
    private function addNotice($section,$msg){
        if (array_key_exists($section,$this->notices)) {
            $this->notices[$section]=array_merge($this->notices[$section],array($msg));
        } else {
            $this->notices[$section]=array($msg);
        }
    }

    /**
     * Return notices. If $class is null, all notices are returned. 
     * Otherwise, only notices in the specific class/section are 
     * returned. Currently supported values for class are overview 
     * and settings. 
     */
    public function getMessages($class=null){
        $result=array();
        if ($class!=null && $class!='any' && array_key_exists('any',$this->notices)) {
            $result=$this->notices['any'];
        }
        foreach ($this->notices as $key => $value) {
            if ($class==null || $class==$key) {
                $result=array_merge($result,$value);
            }
        }
        return $result;
    }

    public function getMessageCount($class=null){
        return count($this->getMessages($class));
    }
}   // Class CDailyNotices
