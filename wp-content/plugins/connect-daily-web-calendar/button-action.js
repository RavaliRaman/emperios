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
 *  
 * This function registers the Connect Daily short-code 
 * insertion button for the editor. The actual dialog is handled 
 * by cdaily_editor_form in cdaily.php 
 *  
 */
(function() {
    tinymce.create('tinymce.plugins.cdaily', {

        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */

        init: function(ed, url) {

            var disabled = false;

            // Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
            ed.addCommand('CDaily_Dlg', function() {
                    if (disabled) {
                        alert('disabled. returning.');
                        return;
                    }

                    // ed.selection.setContent('[cdaily_iframe]'+ed.selection.getContent()+"[/cdaily_iframe]");

                    ed.windowManager.open( {
                        id: 'cdaily-shortcode-dlg', //      id : 'cdaily-dlg',      // file: url+'/Overview.html',
                        width: 480,
                        height: "auto",
                        wpDialog: true,
                        title: 'Connect Daily Web Calendar'
                    }, {
                        plugin_url: url // Plugin absolute URL
                    });
                    // alert('after the dialog!');
                    CDaily.toggleFieldSets();
                });

            // Register example button
            ed.addButton('CDaily', {
                title: 'Insert Connect Daily Web Calendar',
                cmd: 'CDaily_Dlg',
                image: url + '/images/calendar.svg' 
            });
        },
        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo: function() {
            return {
                   longname: 'Connect Daily ShortCode Dialog',
                   author: 'MH Software, Inc.',
                   authorurl: 'http://www.connectdaily.com',
                   infourl: '',
                   version: "1.0"
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('CDaily', tinymce.plugins.cdaily);
})(); 
