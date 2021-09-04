<?php
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

defined('MOODLE_INTERNAL') || die();

/**
 * Plugin for embed ClickView video in TinyMCE (Moodle-specific modified version).
 *
 * @package     tinymce_clickview
 * @copyright   2021 ClickView Pty. Limited <info@clickview.com.au>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tinymce_clickview extends editor_tinymce_plugin {
    /**
     * Used to update the params for initialization.
     *
     * @param array $params the params to be updated
     * @param context $context
     * @param array|null $options optional params
     * @throws dml_exception
     * @throws moodle_exception
     */
    protected function update_init_params(array &$params, context $context,
            array $options = null) {

        $params['lang'] = get_html_lang();
        $params['iframe'] = $this->get_iframe_html();
        $params['eventsapi'] = get_config('local_clickview', 'eventsapi');

        if ($row = $this->find_button($params, 'managefiles')) {
            // Add button after 'managefiles'.
            $this->add_button_after($params, $row, 'clickview', 'managefiles');
        } else {
            // Add this button in the end of the first row (by default 'managefiles' button should be in the first row).
            $this->add_button_after($params, 1, 'clickview');
        }

        // Add JS file, which uses default name.
        $this->add_js_plugin($params);
    }

    /**
     * Returns the ClickView iframe wrapper.
     * TODO: Could be moved to local_clickview, so it can be used from all plugins.
     *
     * @return string
     * @throws dml_exception
     * @throws moodle_exception
     */
    private function get_iframe_html(): string {
        $config = get_config('local_clickview');

        $params = [
                'consumerKey' => $config->consumerkey,
                'singleSelectMode' => 'true'
        ];

        if (!empty($schoolid = $config->schoolid)) {
            $params['schoolId'] = $schoolid;
        }

        $url = new moodle_url($config->hostlocation . $config->iframeurl, $params);

        return '<iframe id="clickview_iframe" src="' . $url . '" width="800" height="494" frameborder="0"></iframe>';
    }
}
