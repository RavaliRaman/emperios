<?php
/**
  * Copyright 2017, MH Software, Inc.
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
 * This class contains some things for simplifying using social 
 * network sharing services. 
 *
 * @author George Sexton
 */
class CDailySocialNetworkHelper {

    private $socialData;

    public function __construct($data) {
        $this->socialData=$data;
    }

    public function isEnabled(){
        return $this->socialData->enabled;
    }

    public function getSingleItemLink($url,$title="") {
        $s=$this->socialData->ItemLink;
        $s=str_replace('{0}',$url,$s);
        $s=str_replace('{1}',$title,$s);
        return $s;
	}

	public function getSingleItemPageLevelCode() {
		return $this->socialData->ItemLinkPageLevelCode;
	}

    public function getPageLevelCodeURL(){
        $a=array();
        if (preg_match('/(\/\/.*)["\']/', $this->socialData->ItemLinkPageLevelCode, $a)==1) {
            $result=$a[1];
        } else {
            $result=null;
        }
        return $result;
    }

    /**
     * Retrieve the HTML Code for insertion for the View Item page for social network. 
     *  
     * @param url The title to write the link for. 
     * @param title The Event Title. 
     *  
     * @return String 
     */
    public function getPageLink($url,$title) {
        $s=$this->socialData->PageLink;
        $s=str_replace('{0}',$url,$s);
        $s=str_replace('{1}',$title,$s);
        return $s;
    }
}
