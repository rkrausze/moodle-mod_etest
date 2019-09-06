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
 * The mod_etest report viewed event.
 *
 * @package mod_etest
 * @copyright  2016 Rüdiger Krauße
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_etest\event;
defined('MOODLE_INTERNAL') || die();

/**
 * The mod_etest report viewed event class.
 *
 * @package    mod_etest
 * @since      Moodle 2.6
 * @copyright  2016 Rüdiger Krauße
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class protocol_viewed extends \core\event\base {

    /**
     * Init method.
     */
    protected function init() {
        $this->data['crud'] = 'r';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
        $this->data['objecttable'] = 'etest';
    }

    /**
     * Returns localised general event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('protocol', 'mod_etest');
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' has viewed the protocol report for the etest with the course module id
            '$this->contextinstanceid'";
    }

    /**
     * Returns relevant URL.
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/mod/etest/prot/prot.php', array('id' => $this->contextinstanceid));
    }

    /**
     * replace add_to_log() statement.
     *
     * @return array of parameters to be passed to legacy add_to_log() function.
     */
    protected function get_legacy_logdata() {
        $url = new \moodle_url('prot/prot.php', array('id' => $this->contextinstanceid));
        return array($this->courseid, 'etest', 'report', $url->out(), $this->objectid, $this->contextinstanceid);
    }
}
