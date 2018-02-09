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

/*
    This file contains misc. classes that are not complex enough to warrant
    their own file.
*/

/** JOOMLA-COMPAT **/
/**
 * This class represents a response to a request for data.
 * 
 * @author gsexton (11/23/2015)
 */
class CDailyDataResponse {
    /**
     * The content of the request. This can be raw data, or if you 
     * manually save, your processed result data. 
     */
    public $content = null;
    /** The result code. 0 or 200 = success.   */
    public $error = 0;
    /** An error message.   */
    public $error_message = null;
    /** True if result came from cache.   */
    public $from_cache = false;
    /**
     * Last-Modified stamp from http response.
     */
    public $last_modified = 0;
    /**
     * The unique caller id for the request. Even though to pieces 
     * of code may be retrieving the same URL, they may be 
     * processing and caching it differently. 
     */
    public $slugname = null;
    /** 
     *  The request URL that was used including all
     *  authentication data.
     */
    public $url = null;
    /**
     * Any field values used in making the request via post.
     */
    public $fields=null;
    /**
     * A temporary variable for holding JSON related errors.
     */
    private $jsonError=null;

    /**
     * Constructor for this. If a JSON decoding error happens, 
     * wasSuccess() will return false, and getJSONError() can be 
     * used to get the JSON decode error. 
     */
    public function __construct($values = null,$fields=null) {
        if (empty($values)) {
            return;
        } else if (gettype($values)=='string') {
            $values=json_decode($values);
            $this->checkJSONError();
        }
        $this->slugname = $values->slugname;
        $this->from_cache = true;
        $this->url = $values->url;
        $this->content = $values->content;
        $this->last_modified = $values->last_modified;
        $this->error = $values->error;
        $this->error_message = $values->error_message;
        $this->fields=$fields;
        // Uncomment the next two lines to force a JSON Error.
        // json_encode(chr(215));
        // $this->checkJSONError();
    }

    /**
     * Return this object encoded as JSON. If an error occurs, then 
     * getJSONError() will return a CDailyJSONError object with the 
     * error information. 
     */
    public function asJSON(){
        $res = json_encode($this,JSON_PRETTY_PRINT);
        $this->checkJSONError();
        return $res;
    }

    /**
     * Decode the content on this object as JSON and return the 
     * result. 
     *  
     * If something goes wrong with the decoding, getJSONError() 
     * will return non-null. 
     *  
     * @see #getJSONError() 
     */
    public function getContentObject(){
        $res=json_decode($this->content);
        $this->checkJSONError();
        return $res;
    }

    /**
     * @return CDailyJSONError
     */
    public function getJSONError(){
        return $this->jsonError;
    }

    /**
     * Call PHP's json_last_error and if something went wrong, 
     * persist the error and message to a CDailyJSONError property 
     * on this. 
     */
    private function checkJSONError(){
        $iErr=json_last_error();
        if ($iErr===JSON_ERROR_NONE) {
            $this->jsonError=null;
        } else {
            $this->jsonError=new CDailyJSONError($iErr);
        }
    }

    /**
     * @return boolean, true if the result was success.
     */
    public function wasSuccess() {
        return $this->jsonError==null && ($this->error == 0 || $this->error == 200);
    }

    public function getErrorText($asComment=true){
        $res='';
        if ($this->jsonError!=null) {
            $this->error=$this->jsonError->error;
            $this->error_message=get_class($this->jsonError).' -> '.$this->jsonError->error_message;
        }
        if ($asComment) {
            $res.="\n<!--\n".
                'PHP Version: '.phpversion()."\n\n".
               CDailyPlugin::PLUGIN_NAME."\n\n".
               "Error: ".$this->error."\n".
               "Message: ".$this->error_message.
               "\n-->\n";
        } else {
            $res.="\n<h4>".CDailyPlugin::PLUGIN_NAME."</h4>".
                "\n<br><b>PHP Version:</b> ".phpversion()."<br><br>".
                "\n<b>Error:</b> ".$this->error."<br>\n".
               "<b>Message:</b> ".$this->error_message."\n<br><br>\n";
        }
        return $res;
    }
}

/**
 * A wrapper for handling JSON Errors.
 * 
 * @author gsexton (5/20/16)
 */
class CDailyJSONError {

    public $error=JSON_ERROR_NONE;
    public $error_message=null;

    public function __construct($iErr) {
        $this->error=$iErr;
        switch ($iErr) {
        case JSON_ERROR_NONE:
            break;
        case JSON_ERROR_DEPTH : 
            $this->error_message='Invalid Depth';
            break;
        case JSON_ERROR_STATE_MISMATCH:
            $this->error_message='State Mismatch';
            break;
        case JSON_ERROR_CTRL_CHAR:
            $this->error_message='Control Character Error, Possibly incorrectly encoded.';
            break;
        case JSON_ERROR_SYNTAX:
            $this->error_message='Syntax Error';
            break;
        case JSON_ERROR_UTF8:
            $this->error_message='Malformed UTF-8 characters, possibly incorrectly encoded';
            break;
        default:
            if ((PHP_MAJOR_VERSION==5 && PHP_MINOR_VERSION>=5) || PHP_MAJOR_VERSION>5) {
                switch ($iErr) {
                case JSON_ERROR_RECURSION:
                    $this->error_message='One or more recursive references in the value to be encoded';
                    break;
                case JSON_ERROR_INF_OR_NAN:
                    $this->error_message='One or more NAN or INF values in the value to be encoded ';
                    break;
                case JSON_ERROR_UNSUPPORTED_TYPE:
                    $this->error_message='A value of a type that cannot be encoded was given';
                    break;
                }
            }
            break;
        }
    }

    public function toString(){
        return 'JSON Error - Error Number: '.$this->error.' Message: '.$this->error_message;
    }
}
