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

if (url = tinyMCEPopup.getParam('eventsapi')) {
    document.write('<script type="text/javascript" src="' + tinyMCEPopup.editor.documentBaseURI.toAbsolute(url) + '"></script>');
}

function tinymce_clickview_init() {
	document.documentElement.lang = tinyMCEPopup.getParam('lang');
	document.getElementById('clickview_iframe_wrapper').innerHTML = tinyMCEPopup.getParam('iframe');

	var pluginFrame = document.getElementById('clickview_iframe'),
		eventsApi = new CVEventsApi(pluginFrame.contentWindow);

	eventsApi.on('cv-lms-addvideo', function (event, detail) {
		tinyMCEPopup.editor.execCommand('mceInsertRawHTML', false, detail.embedHtml);
		tinyMCEPopup.close();
	}, true);
}

tinyMCEPopup.onInit.add(tinymce_clickview_init);