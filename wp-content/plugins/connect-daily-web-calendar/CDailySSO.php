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
/** JOOMLA-COMPAT **/
/** 
  * This class implements Single Signon between Connect Daily 
  * and a CMS system. 
  *  
 */
class CDailySSO  {

    const ERROR_NOKEY=-101;
    const SSO_LOGIN='SSOLogin.html';

    private $plugin;
    private $crypto;

    /**
     * Construct a new SSO object. 
     *  
     * @param $plugin CDailyPlugin Reference to current plugin 
     *                object.
     */
    public function __construct($plugin) {
        $this->plugin=$plugin;
        $this->crypto=new CDaily_Crypto();
    }

    /**
     * Initiate the conversation between the CMS and Connect Daily. 
     *  
     * as a precondition, the CMS specific could MUST ensure that 
     * the request is from a valid user. 
     *  
     * @return The URL for the browser to go to. If SSO was 
     *         successful, it will be a SSO Signin URL with the
     *         secret appended. If there's a failure, then the
     *         normal login page URL will be returned.
     *  
     * @throws CDailySSOException , CDailySSONotAvailableException 
     */
    public function processClientSSORequest(){

        if (!$this->crypto->isAvailable()) {
            throw new CDailySSONotAvailableException('COM_CONNECTDAILY_NOCRYPTO',-2);
        } 
        $settings=$this->plugin->getSettings();
        if (!property_exists($settings,'username') || empty($settings->username)) {
            throw new CDailySSONotAvailableException('COM_CONNECTDAILY_NOUSERNAME',-3);
        }
        /*
            Generate a secret.
        */
        $secret=CDaily_Crypto::generatePassword(16);

        /*
            Encrypt the secret+username with the Private Key.
        */
        $encrypted='';
        if ($this->crypto->encryptData($secret.':'.$settings->username,$encrypted)) {
            /*
                Send the secret to Connect Daily.
            */
            $this->requestSSOLogin($encrypted);
            return '{ "type" : "redirect", "url" : '.
                json_encode($settings->url.
                            self::SSO_LOGIN.
                            '?target=EditItem.html&secret='.
                            urlencode($secret)).'}';

        } 
        throw new CDailySSOException("COM_CONNECTDAILY_ENCRYPTFAIL",-3);
    }

    public function getStandardLogin(){
        $settings=$this->plugin->getSettings();
        $url=$settings->url.'login.html';
        if (isset($settings->username) && isset($settings->password)) {
            $url.='?txtUserID='.urlencode($settings->username)
                .'&_txtPassword='.urlencode($settings->password);
        }
        return '{ "type" : "redirect", "url" : '.json_encode($url).'}';
    }

    /**
     * Attempt to install the public key.
     */
    private function tryPubKeyInstall($settings){
        if (isset($settings->url) && isset($settings->username) && isset($settings->password)) {
            $fields=array(
                'pubkey' => $this->crypto->getPublicKey(),
                'username' => $settings->username,
                'password' => $settings->password,
                'site_url' => $this->plugin->getSiteUrl(),
                'action' => 'InstallPubKey'
                );
            $result=$this->plugin->makePostRequest($settings->url.self::SSO_LOGIN,$fields);
            if ($result->wasSuccess()) {
                $data=$result->getContentObject();
                if ($data->error===0) {
                    return true;
                } 
            } 
        }
        return false;
    }

    /**
     * Request SSO Login from Connect Daily. 
     *  
     * @throws CDailySSOException 
     */
    private function requestSSOLogin($encryptedSecret,$recurse=false){
        $settings=$this->plugin->getSettings();
        $fields=array(
            "encryptedSecret" => $encryptedSecret,
            "action" => "SSOLogin2",
            "target" => "EditItem.html"
            );
        $result=$this->plugin->makePostRequest($settings->url.self::SSO_LOGIN,$fields,false);
        $data=null;
        if ($result->wasSuccess()) {
            $data=$result->getContentObject();
            if ($data->error===self::ERROR_NOKEY && !$recurse) {
                /*
                    Try to install the public key.
                */
                if ($this->tryPubKeyInstall($settings)) {
                    /*
                        OK, the public key installed. Try requesting SSO Login again.
                    */
                    return $this->requestSSOLogin($encryptedSecret,true);
                } else {
                    throw new CDailySSOException($data->error_message,$data->error);
                }
            } else if ($data->error!=0) {
                throw new CDailySSOException($data->error_message,$data->error);
            } 
        } else {
            throw new CDailySSOException($result->error_message,$result->error);
        }
        return $data;
    }

}

class CDailySSOException extends Exception {
    public function _construct($caption, $code=0,Exception $previous = null) {
        parent::__construct($caption,$code,$previous);
    }
}

class CDailySSONotAvailableException extends CDailySSOException {
}
