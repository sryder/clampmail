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
 * @package   block_clampmail
 * @copyright 2013 Collaborative Liberal Arts Moodle Project
 * @copyright 2012 Louisiana State University (original Quickmail block)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->libdir . '/formslib.php');

class signature_form extends moodleform {
    public function definition() {
        global $USER;

        $mform =& $this->_form;

        $mform->addElement('hidden', 'courseid', '');
        $mform->setType('courseid', PARAM_INT);
        $mform->addElement('hidden', 'id', '');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'userid', $USER->id);
        $mform->setType('userid', PARAM_INT);

        $mform->addElement('text', 'title', clampmail::_s('title'));
        $mform->setType('title', PARAM_TEXT);
        $mform->addRule('title', get_string('maximumchars', '', 125), 'maxlength', 125, 'client');
        $mform->addElement('editor', 'signature_editor', clampmail::_s('sig'),
            null, $this->_customdata['signature_options']);
        $mform->setType('signature_editor', PARAM_RAW);
        $mform->addElement('checkbox', 'default_flag', clampmail::_s('default_flag'));

        $buttons = array(
            $mform->createElement('submit', 'save', get_string('savechanges')),
            $mform->createElement('submit', 'delete', get_string('delete')),
            $mform->createElement('cancel')
        );

        $mform->addGroup($buttons, 'buttons', clampmail::_s('actions'), array(' '), false);
        $mform->addRule('title', null, 'required', null, 'client');
    }
}
