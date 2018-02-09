<?php
/*
Plugin Name: Connect Daily Web Calendar
Plugin URI: http://www.connectdaily.com/wordpress-calendar-plugin/
Description: This plugin integrates Connect Daily Cloud Calendar into WordPress. It provides a responsive full-sized calendar, mini-calendar, responsive detailed list of events,  and simple list of events widgets, and shortcodes.
Version: 1.3.6
License: GPL
Author: MH Software, Inc.
Author URI: http://www.connectdaily.com
*/
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
require_once 'class-cdaily-misc.php';
require_once 'class-cdaily-plugin.php';
require_once 'class-cdaily-base-renderer.php';
require_once 'class-cdaily-wordpress-plugin.php';
require_once 'class-cdaily-simplelist-widget.php';
require_once 'class-cdaily-detailedlist-widget.php';
require_once 'class-cdaily-minicalendar-widget.php';
require_once 'class-cdaily-icalendar-widget.php';
require_once 'class-cdaily-search-widget.php';
require_once 'class-cdaily-wpeditor-hook.php';
require_once 'if-locale-helper.php';
require_once 'class-cdaily-locale-helper.php';
require_once 'cdaily-ajax.php';
require_once 'display-calendar.php';
require_once 'detailed-list.php';
require_once 'class-cdaily-crypto.php';
require_once 'CDailyAddEvent.php';
require_once 'CDailySearch.php';
require_once 'CDailySocialNetworkHelper.php';
require_once 'CDailySSO.php';

$CDPlugin=CDailyWPPlugin::getInstance(); 

register_activation_hook(__FILE__, array($CDPlugin,'install'));
register_deactivation_hook(__FILE__,array($CDPlugin,'deactivate'));
register_uninstall_hook(__FILE__, array('CDailyWPPLugin','uninstall'));
