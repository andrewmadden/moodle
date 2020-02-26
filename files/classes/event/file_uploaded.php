<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Event when a file is uploaded via core_files_upload external function.
 *
 * @package    core_files
 * @category   event
 * @author     Andrew Madden <andrewmadden@catalyst-au.net>
 * @copyright  2020 Catalyst IT
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_files\event;

defined('MOODLE_INTERNAL') || die();

class file_uploaded extends \core\event\base {

    public static function create_strict(string $contextid, string $component, string $filearea, string $itemid,
                                            string $filepath, string $filename, string $url) {
        global $USER;

        // Extra event data.
        $other = [
            'contextid' => $contextid,
            'component' => $component,
            'filearea' => $filearea,
            'itemid' => $itemid,
            'filepath' => $filepath,
            'filename' => $filename,
            'url' => $url,
        ];

        return self::create([
            'userid' => $USER->id,
            'other' => $other,
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function init() {
        $this->context = \context_system::instance();
        $this->data['crud'] = 'w';
        $this->data['edulevel'] = self::LEVEL_OTHER;
    }

    /**
     * @inheritDoc
     */
    public static function get_name() {
        return get_string('uploadedfile');
    }

    /**
     * @inheritDoc
     */
    public function get_description() {
        $a = [
            'component' => $this->data['options']['component'],
            'filearea' => $this->data['options']['filearea'],
            'itemid' => $this->data['options']['itemid'],
            'filename' => $this->data['options']['filename'],
            'url' => $this->data['options']['url'],
        ];
        return get_string('uploadedfiledetails', 'core', $a);
    }
}
