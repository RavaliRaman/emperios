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
 * This class provides a wrapper around Crypto methods used By
 * Connect Daily.
 *
 * @author George Sexton
 */
class CDaily_Crypto {

    private $keyPair = null;
    private $available = null;

    const CDAILY_KEY_LENGTH = 2048;
    const CDAILY_SIGNATURE_ALGORITHM = "sha256";

    public function __construct() {
        if (extension_loaded('openssl')) {
            if ($this->getKeyPair() === false) {
                $this->available = false;
            } else {
                $this->available = true;
            }
        } else {
            $this->available = false;
        }
    }

    /**
     * Encrypt data using our private key. 
     *  
     * @param $data string Data to encrypt. 
     * @param $encDataOut By reference variable to receive the 
     *                    encrypted output. Data will be hex
     *                    encoded as a string.
     *  
     * @return true if successful, false otherwise. 
     */
    public function encryptData($data,&$encDataOut) {
        $tmp='';
        /**
         * During development, I hit some padding errors, but they 
         * weren't caused by padding, but by an invalid public key. If 
         * you hit padding errors, make sure the public key in Connect 
         * Daily, and in the CMS match up. 
         */
        $res=openssl_private_encrypt($data,$tmp,$this->getPrivateKey(),OPENSSL_PKCS1_PADDING);
        if ($res) {
            $encDataOut=bin2hex($tmp);
        }
        return $res;
    }

    /**
     * Generate a new public and private key pair. 
     *  
     * @return The generated public/private key pair. 
     */
    private function generateKeyPair() {
        $config = array(
            "digest_alg" => self::CDAILY_SIGNATURE_ALGORITHM,
            "private_key_bits" => self::CDAILY_KEY_LENGTH,
            "private_key_type" => OPENSSL_KEYTYPE_RSA
            );
        return openssl_pkey_new($config);
    }

    /**
     * Return the private/public keypair as PEM. If they don't 
     * exist, generate them and save them in the plugin settings. 
     *  
     * if keypair generation fails, the function returns false. 
     */
    private function getKeyPair() {
        if ($this->keyPair == null) {
            $CDPlugin = CDailyPlugin::getInstance();
            $settings = $CDPlugin->getSettings();
            if (!property_exists($settings, 'keypair')) {
                $pair = $this->generateKeyPair();
                /*
                    Although theoretically, the code should not call
                    this if openssl is not available, what I'm seeing
                    is that on Microsoft IIS, PHP is showing OpenSSL
                    available, but the keypair generation appears to be
                    failing.
                 
                    This could be because the specific server doesn't
                    support the desired signature algorithm.
                */
                if ($pair === false) {
                    $this->keyPair = null;
                    return false;
                }
                $str = "";
                openssl_pkey_export($pair, $str);
                $settings->{"keypair"} = $str;
                $CDPlugin->saveSettings($settings);
            }
            $this->keyPair = $settings->keypair;
        }
        return $this->keyPair;
    }

    /**
     * return the private key.
     */
    private function getPrivateKey() {
        $res = openssl_pkey_get_private($this->getKeyPair());
        return $res;
    }

    /**
     * get the public key (in PEM format) for the private key. This 
     * call will automatically generate the keypair if they don't 
     * already exist. 
     */
    public function getPublicKey() {
        $pubKey = openssl_pkey_get_details($this->getPrivateKey());
        return $pubKey["key"];
    }

    /**
     * Sign some data using the installation's private key. 
     * <br><br> The signed data is returned as binary If you're 
     * going to pass the data around using an http request, you may 
     * need to encode it using bin2hex(). 
     *  
     * @see openssl_sign 
     *  
     * @param $data the Data to create a signature for. 
     * @param $signature the BY REFERENCE variable to receive the 
     *                   signature.
     * @return boolean  True on success.
     */
    public function signData($data, &$signature) {
        if (!$this->available) {
            return false;
        }
        $pkey = $this->getPrivateKey();
        return openssl_sign($data, $signature, $pkey, self::CDAILY_SIGNATURE_ALGORITHM);
    }

    public function getSignatureAlgorithm() {
        return self::CDAILY_SIGNATURE_ALGORITHM;
    }

    /**
     * Generate a random password to use for login. 
     *  
     * @param $length the desired password length. Default 8
     * @param $limitAlphaNumeric - Limit the password to 
     *                           [0-9A-Za-z].
     * @return string 
     */
    public static function generatePassword($length = 8, $limitAlphaNumeric = false) {
        $candidateChars = '01234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$^&*()_+=-{}[],.?';
        $bytes = openssl_random_pseudo_bytes($length);
        if ($limitAlphaNumeric) {
            // Looking at candidateChars, limit to 0-9A-Za-z
            $chars = 62;
        } else {
            $chars = strlen($candidateChars);
        }
        $result = '';
        for ($i = 0; $i < strlen($bytes); $i++) {
            $c = substr($bytes, $i, 1);
            $result .= substr($candidateChars, ord($c) % $chars, 1);
        }
        return $result;
    }

    /**
     * Return true if crypto functions are available.
     */
    public function isAvailable() {
        return $this->available;
    }
}
