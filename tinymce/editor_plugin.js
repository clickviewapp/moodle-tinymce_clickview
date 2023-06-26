// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/*
 * @package    tinymce_clickview
 * @copyright  2021 ClickView Pty. Limited <info@clickview.com.au>
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* global tinymce */
/* eslint no-undef: "error" */

(function() {
    tinymce.create('tinymce.plugins.ClickView', {
        init: function(ed, url) {
            ed.addCommand('mceclickview', function() {
                ed.windowManager.open({
                    file: url + '/clickview.htm',
                    width: 816,
                    height: 510,
                    inline: 1
                }, {
                    plugin_url: url, // eslint-disable-line camelcase
                });
            });

            ed.addButton('clickview', {
                title: 'clickview.desc',
                image: url + '/img/icon.png',
                cmd: 'mceclickview'
            });
        },

        getInfo: function() {
            return {
                longname: 'Embed ClickView Video',
                author: '2021 ClickView Pty. Limited <info@clickview.com.au>',
                version: '1.0'
            };
        }
    });

    tinymce.PluginManager.add('clickview', tinymce.plugins.ClickView);
})();
